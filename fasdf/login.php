<?php session_start(); 
include 'header2.php';
?>

<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="login.css">
    <title>Login</title>
</head>
<body>
    <h2 align="center">Login</h2>
    <form action="process_login.php" method="post" novalidate>
<table align="center">
<tr>
    <td>
    <fieldset>
        <legend><b>User Login</b></Legend>
    <table >
        <tr>
            <td>
   
                <label for="username">Username:</label>
                <input type="text" name="username" value="<?php echo isset($_SESSION['input']['username']) ? $_SESSION['input']['username'] : ''; ?>">
                <?php if (isset($_SESSION['errors']['username'])) echo "<p>{$_SESSION['errors']['username']}</p>"; ?>
                <br>
                
                <label for="password">Password:</label>
                <input type="password" name="password">
                <?php if (isset($_SESSION['errors']['password'])) echo "<p>{$_SESSION['errors']['password']}</p>"; ?>
                <br>
                <?php if (isset($_SESSION['errors']['login'])) { ?>
                <p><?php echo $_SESSION['errors']['login']; ?></p>
                <?php } ?>

            </td>
        </tr>
    </table>
</fieldset>
         <br>        
        <?php echo "<a href='signup.php'><b>Create New Account</b></a>"?><br><br>
        <?php echo "<a href='forgot_password.php'><b>Forgotten password?</b></a>"?><br><br>
        <p align="center"><input type="submit" name="submit" value="Login"></p>
</td>
</tr>
</table>
</form>
</body>
</html>
<?php

if (isset($_SESSION['errors'])) {
    unset($_SESSION['errors']);
}
if (isset($_SESSION['input'])) {
    unset($_SESSION['input']);
}
?>
<?php
include 'footer2.php';
?>
