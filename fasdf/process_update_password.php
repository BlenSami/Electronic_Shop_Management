<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $errors = [];

    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmNewPassword = $_POST['confirmNewPassword'];

    
    if (empty($currentPassword) ) {
        $errors['currentPassword'] = 'Current password field is empty';
    }

    if (empty($newPassword) ) {
        $errors['newPassword'] = 'New Password field is empty';
    }
    if (empty($currentPassword) ) {
        $errors['confirmPassword'] = 'Confirm Password field is empty';
    }
    if ($newPassword !== $confirmNewPassword) {
        $errors['pass'] = 'New passwords do not match';
    }

    
    
        $stmt = $conn->prepare("SELECT password FROM user WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

if (!password_verify($currentPassword, $user['password'])) {
    $errors['currentPass'] = 'Current password is incorrect';
}

if (empty($errors)) {
    
    $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE user SET password = ? WHERE id = ?");
    $stmt->bind_param("si", $hashedNewPassword, $user_id);
    
    if ($stmt->execute()) {
        $_SESSION['message'] = 'Password updated successfully';
        header('Location: welcome.php');
        exit;
    } else {
        
        $errors[] = 'Failed to update password: ' . $stmt->error;
    }
}
    }

    
    $_SESSION['errors'] = $errors;
    header('Location: update_password.php');
    exit;

?>
