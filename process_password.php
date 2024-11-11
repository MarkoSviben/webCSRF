<?php
include 'config.php';
include 'csrf_token.php';

if (!isset($_SESSION['logged_in'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' || (!$_SESSION['csrf_protection'] && $_SERVER['REQUEST_METHOD'] === 'GET')) {
    $new_password = $_REQUEST['new_password'] ?? '';
    $confirm_password = $_REQUEST['confirm_password'] ?? '';

    if ($_SESSION['csrf_protection'] && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $csrf_token = $_POST['csrf_token'] ?? '';
        if (!verifyToken($csrf_token)) {
            die("Neispravan CSRF token.");
        }
    }

    if ($new_password === $confirm_password) {
        setPassword($new_password);

        echo "Lozinka je uspješno promijenjena.";

        header("Refresh:2; url=attack.html");
        exit();
    } else {
        echo "Lozinke se ne podudaraju.";
    }
} else {
    header('Location: change_password.php');
    exit();
}
?>
