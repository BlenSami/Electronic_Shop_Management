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
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="login.css">
    <title>Update Profile</title>
</head>
<body>
    <h1 align='center'>Update Profile</h1>
    <form action="process_update_profile.php" method="post" novalidate>
    <table align='center'>
        <tr>
            <td>
               <fieldset>
                <legend><b>Profile</b></legend>  
                
        <label for="address"><b>Address:</b></label>
        <textarea name="address"><?php echo $user['address']; ?></textarea><br><br>
        <?php if (isset($_SESSION['errors']['address'])) echo "<p>{$_SESSION['errors']['address']}</p>"; ?>
        <br>
        <label for="contact"><b>Contact Number:</b></label>
        <input type="text" name="contact" value="<?php echo $user['contact']; ?>">
        <?php if (isset($_SESSION['errors']['contact'])) echo "<p>{$_SESSION['errors']['contact']}</p>"; ?><br><br>
        <br>
        <label for="email"><b>Email:</b></label>
        <input type="text" name="email" value="<?php echo $user['email']; ?>"><br><br>
        <br>
        <label for="password"><b>Password:</b></label>
        <input type="password" name="password"><br><br>
        <?php if (isset($_SESSION['errors']['password'])) echo "<p>{$_SESSION['errors']['password']}</p>"; ?>

        <?php if (isset($_SESSION['errors']['login'])) { ?>
    <p><?php echo $_SESSION['errors']['login']; ?></p>
        <?php } ?><br>
        </fieldset>
        </td>
        </tr>
        <table>
            
      <p align='center'>  <input type="submit" value="Update Profile"><br></p>
      <p align='center'>  <?php echo "<a href='profile.php'><b>Go back</b></a>"?><br></p>
      <p align='center'>  <?php echo "<a href='welcome.php'><b>Back to Main page</b></a>"?></p>
        
    </form>
</body>
</html>
<?php
   if (isset($_SESSION['errors'])) {
         unset($_SESSION['errors']);
}
?>


<?php
include 'footer.php';
?>
