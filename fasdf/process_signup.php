<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
    include 'db_connect.php';

    $errors = [];
    

    $input = [];

    if (empty($_POST['fullName'])) {
        $errors['fullName'] = "Please fill up your Name";
    } else {
        setcookie('fullName', '', time() - 3600);
        $input['fullName'] = $_POST['fullName'];
    }
    
    
    if (empty($_POST['username'])) {
        $errors['username'] = "Please fill up your Username";
    } else {
        setcookie('username', '', time() - 3600);
        $input['username'] = $_POST['username'];
    }

    
    if (empty($_POST['password'])) {
        $errors['password'] = "Please fill up your Password";
    } else {
        
        $input['password'] = $_POST['password'];
    }
    if (empty($_POST['confirmPassword'])) {
        $errors['confirmPassword'] = "Please confirm your Password";
    } else if ($_POST['password'] !== $_POST['confirmPassword']) {
        $errors['confirmPassword'] = "Passwords do not match";
    }

    if (empty($_POST['email'])) {
        $errors['email'] = "Please fill up your Email";
    } else {
        setcookie('email', '', time() - 3600);
        $input['email'] = $_POST['email'];
    }

    
    if (empty($_POST['address'])) {
        $errors['address'] = "Please fill up your Address";
    } else {
        setcookie('address', '', time() - 3600);
        $input['address'] = $_POST['address'];
    }

   
    if (empty($_POST['contact'])) {
        $errors['contact'] = "Please fill up your Contact Number";
    } else {
        setcookie('contact', '', time() - 3600);
        $input['contact'] = $_POST['contact'];
    }
    if (empty($_POST['securityQuestion'])) {
        $errors['securityQuestion'] = "Please select a security question";
    } else {
        $input['securityQuestion'] = $_POST['securityQuestion'];
    }
    if (empty($_POST['securityAnswer'])) {
        $errors['securityAnswer'] = "Please give an answer according to your question";
    } else {
        $input['securityAnswer'] = $_POST['securityAnswer'];
    }
    
    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        $_SESSION['input'] = $input;
        header("Location: signup.php");
        exit;
    } else {
        
        $username = mysqli_real_escape_string($conn, $input['username']);
        $password = mysqli_real_escape_string($conn, password_hash($input['password'], PASSWORD_DEFAULT));
        $email = mysqli_real_escape_string($conn, $input['email']);
        $fullName = mysqli_real_escape_string($conn, $input['fullName']);
        $address = mysqli_real_escape_string($conn, $input['address']);
        $contact = mysqli_real_escape_string($conn, $input['contact']);
        $securityQuestion = $_POST['securityQuestion'];
        $securityAnswer = password_hash($_POST['securityAnswer'], PASSWORD_DEFAULT);

        
         $stmt = $conn->prepare( "INSERT INTO user (username, password, email, fullName, address, contact, securityQuestion, securityAnswer) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");


         $stmt->bind_param( "ssssssss", $username, $password, $email, $fullName, $address, $contact, $securityQuestion, $securityAnswer);
        

         if ($stmt->execute()) {
          header("Location: login.php");
              exit;
}       else {
        echo "Error: " . mysqli_stmt_error($stmt);
}


          $stmt->close();


       $stmt->close();   
    }
} 

}
   
if(isset($_POST['save_draft'])){
        $currentTime=time();
        setcookie('fullName',$_POST['fullName'],time()+(86400*30));
        setcookie('address',$_POST['address'],time()+(86400*30));
        setcookie('contact',$_POST['contact'],time()+(86400*30));
        setcookie('username',$_POST['username'],time()+(86400*30));
        setcookie('email',$_POST['email'],time()+(86400*30));
        setcookie('last_modified', $currentTime, $currentTime + (86400 * 30)); 
	    header("Location:signup.php");
    }

?>
