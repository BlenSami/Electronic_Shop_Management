<?php
session_start();
include 'db_connect.php';
include 'header.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}


$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM user WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$user = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="login.css">
    <title>Welcome</title>
</head>
<body>
    <h2 align="center">Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h2>

    <table align='center'>
        <tr>
            <td>
               <fieldset>
               <legend><b>Dashboard</b></legend>  

                <?php echo "<a href='profile.php'><b>Go to Profile</b></a>"?><br><br>
                <?php echo "<a href='update_password.php'><b>Update Password</b></a>"?><br><br>
                <?php echo "<a href='./view/addEmployee.php'><b>Add Employee</b></a>"?><br><br>
                <?php echo "<a href='./view/emplyeeList.php'><b>Employee List</b></a>"?><br><br>

                </fieldset>
            </td>
         </tr>
    </table>
    
</body>
</html>
<?php
include 'footer.php';
?>
