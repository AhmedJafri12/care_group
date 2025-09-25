<?php
session_start();
if (isset($_GET['logout'])) { session_destroy(); header('Location: login.php'); exit(); }
if ($_POST) {
    if ($_POST['username'] === 'admin' && $_POST['password'] === 'admin123') {
        $_SESSION['logged_in'] = true;
        header('Location: pages/dashboard.php');
        exit();
    } else {
        $error = "Invalid credentials";
    }
}
?>
<!DOCTYPE html>