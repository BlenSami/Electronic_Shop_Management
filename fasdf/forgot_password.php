<?php
session_start();
?>
<!DOCTYPE html>

<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>

<body>
    <form action="process_forgot_password.php" method="post" novalidate>
        <table align="center">
            <tr>
                <td>
                    <fieldset>
                        <legend><b>Forgot Password<b></legend>

                        <label for="username">Username:</label>
                        <input type="text" name="username">
                        <?php if (isset($_SESSION['errors']['username'])) echo "<p>{$_SESSION['errors']['username']}</p>"; ?>
                        <br>
                        <br>

                        <label for="securityQuestion">Security Question :</label>
                        <select name="securityQuestion">
                            <option value="">--Please choose an option--</option>
                            <option value="pet" <?php if (isset($_SESSION['input']['securityQuestion']) && $_SESSION['input']['securityQuestion'] === 'pet') echo 'selected'; ?>>What is the name of your first pet?</option>
                            <option value="birthCity" <?php if (isset($_SESSION['input']['securityQuestion']) && $_SESSION['input']['securityQuestion'] === 'birthCity') echo 'selected'; ?>>In what city were you born?</option>

                        </select>
                        <?php if (isset($_SESSION['errors']['securityQuestion'])) echo "<p>{$_SESSION['errors']['securityQuestion']}</p>"; ?>
                        <br>

                        <label for="securityAnswer">Security Answer :</label>
                        <input type="text" name="securityAnswer" value="<?php echo isset($_SESSION['input']['securityAnswer']) ? $_SESSION['input']['securityAnswer'] : ''; ?>">
                        <?php if (isset($_SESSION['errors']['securityAnswer'])) echo "<p>{$_SESSION['errors']['securityAnswer']}</p>"; ?>
                        <br>


                        <label for="newPassword">New Password:</label>
                        <input type="password" name="newPassword">
                        <?php if (isset($_SESSION['errors']['newPassword'])) echo "<p>{$_SESSION['errors']['newPassword']}</p>"; ?>
                        <br>
                    </fieldset>
                </td>
            </tr>
        </table>

        <p align="center"> <input type="submit" value="Reset Password"></p>
    </form>
    <p align="center"><?php echo "<a href='login.php'><b>Back to Login</b></a>" ?><br><br></p>
    <p align="center"><?php echo "<a href='signup.php'><b>Create New Account</b></a>" ?><br></p>

</body>

</html>