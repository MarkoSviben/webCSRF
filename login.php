<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $_SESSION['csrf_protection'] = isset($_POST['csrf_protection']);

    if ($username === USERNAME && $password === getPassword()) {
        $_SESSION['logged_in'] = true;
        header('Location: dashboard.php');
        exit();
    } else {
        echo "Neispravni podaci za prijavu.";
    }
} else {
    header('Location: index.php');
    exit();
}
?>
