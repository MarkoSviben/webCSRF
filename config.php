<?php
session_start();

define('USERNAME', 'user');

function getPassword() {
    return trim(file_get_contents('password.txt'));
}

function setPassword($password) {
    file_put_contents('password.txt', $password);
}

if (!isset($_SESSION['csrf_protection'])) {
    $_SESSION['csrf_protection'] = false; 
}
?>
