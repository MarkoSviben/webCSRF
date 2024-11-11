<?php
include 'config.php';

if (!isset($_SESSION['logged_in'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['csrf_protection'] = isset($_POST['csrf_protection']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kontrolna ploča</title>
</head>
<body>
    <h2>Dobrodošli, <?php echo htmlspecialchars(USERNAME); ?>!</h2>
    <p>CSRF zaštita je trenutno: <strong><?php echo $_SESSION['csrf_protection'] ? 'UKLJUČENA' : 'ISKLJUČENA'; ?></strong></p>

    <form method="post">
        <label>
            <input type="checkbox" name="csrf_protection" onchange="this.form.submit()" <?php echo $_SESSION['csrf_protection'] ? 'checked' : ''; ?>>
            Omogući CSRF zaštitu
        </label>
    </form>

    <p>Odaberite akciju:</p>
    <ul>
        <li><a href="change_password.php">Promijeni lozinku</a></li>
        <li><a href="logout.php">Odjava</a></li>
    </ul>
</body>
</html>
