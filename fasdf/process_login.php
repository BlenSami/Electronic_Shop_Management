<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    $input = [];

    
    if (empty($_POST['username'])) {
        $errors['username'] = "Please fill up your Username";
    } else {
        $input['username'] = $_POST['username'];
    }

    
    if (empty($_POST['password'])) {
        $errors['password'] = "Please fill up your Password";
    } else {
        $input['password'] = $_POST['password'];
    }

    if (count($errors) === 0) {
        $username = mysqli_real_escape_string($conn, $input['username']);
        $password = $input['password'];
          $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
          $stmt->bind_param("s", $username);
          $stmt->execute();
          $result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        $_SESSION['user_id'] = $row['id'];
        header('Location: welcome.php');
        exit;
    }
}        
       
        $errors['login'] = 'Incorrect username or password';
    }
   
    $_SESSION['errors'] = $errors;
    $_SESSION['input'] = $input;
    header("Location: login.php");
    exit;
}
mysqli_close($conn);
?>
