<?php
    session_start();
    include 'header.php';
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    } 
?>

<!DOCTYPE html>
<head>
<style>
        .error {
            color: red;
            font-size: 12px; /* Adjust font size as needed */
        }
    </style>
    <link rel="stylesheet" type="text/css" href="login.css">
    <script src ="updatePass.js" ></script>
    <title>Update Password</title>
</head>
<body>
    <h1  align='center'>Update Password</h1>
  
    <form action="process_update_password.php" method="post" novalidate onsubmit="return validateupdatePassForm(this);">
    <table align='center'>
        <tr>
            <td>
                <fieldset>
                    <legend><b>Change Your Password Here</b></legend>
        <label for="currentPassword">Current Password:</label>
        <input type="password" name="currentPassword" ><br><br>
        <?php if (isset($_SESSION['errors']['currentPassword'])) echo "<p>{$_SESSION['errors']['currentPassword']}</p>"; ?>
        <?php if (isset($_SESSION['errors']['currentPass'])) echo "<p>{$_SESSION['errors']['currentPass']}</p>"; ?>
        <span id="currentPasswordError" class="error-message"></span>
        <br>   
        <label for="newPassword">New Password:</label>
        <input type="password" name="newPassword" ><br><br>
        <?php if (isset($_SESSION['errors']['newPassword'])) echo "<p>{$_SESSION['errors']['newPassword']}</p>"; ?>
        <span id="newPasswordError" class="error-message"></span>
        <span id="newPasswordError" style="color: red;"></span>
        <br>
        
        <label for="confirmNewPassword">Confirm New Password:</label>
        <input type="password" name="confirmNewPassword" ><br><br>
        <?php if (isset($_SESSION['errors']['confirmPassword'])) echo "<p>{$_SESSION['errors']['confirmPassword']}</p>"; ?>
        <span id="confirmNewPasswordError" class="error-message"></span>
        <br>
        
        <?php if (isset($_SESSION['errors']['pass'])) { ?>
        <p><?php echo $_SESSION['errors']['pass']; ?></p>
        <?php } ?>
        </fieldset>
        </td>
        </tr>
        </table>
      <p align='center'>  <input type="submit" value="Update Password"><br><br></p>
      <p align='center'> <?php echo "<a href='welcome.php'><b>Back to Main page</b></a>"?></p>
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