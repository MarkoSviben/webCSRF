<?php
include 'config.php';
include 'csrf_token.php';

if (!isset($_SESSION['logged_in'])) {
    header('Location: index.php');
    exit();
}

// Generiranje CSRF tokena ako je zaštita uključena
if ($_SESSION['csrf_protection']) {
    $token = generateToken();
}

// Obrada promjene CSRF zaštite
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toggle_csrf'])) {
    $_SESSION['csrf_protection'] = isset($_POST['csrf_protection']);
    header('Location: change_password.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Promjena lozinke</title>
    <meta http-equiv="refresh" content="2;url=attack.html">
</head>
<body>
    <h2>Promjena lozinke</h2>
    <p>CSRF zaštita je trenutno: <strong><?php echo $_SESSION['csrf_protection'] ? 'UKLJUČENA' : 'ISKLJUČENA'; ?></strong></p>

    <form method="post">
        <input type="hidden" name="toggle_csrf" value="1">
        <label>
            <input type="checkbox" name="csrf_protection" onchange="this.form.submit()" <?php echo $_SESSION['csrf_protection'] ? 'checked' : ''; ?>>
            Omogući CSRF zaštitu
        </label>
    </form>

    <form action="process_password.php" method="post">
        Nova lozinka: <input type="password" name="new_password" required><br>
        Potvrdi lozinku: <input type="password" name="confirm_password" required><br>
        <?php if ($_SESSION['csrf_protection']): ?>
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($token); ?>">
        <?php endif; ?>
        <input type="submit" value="Promijeni lozinku">
    </form>

    <p>Nakon uspješne promjene lozinke, bit ćete preusmjereni na drugu stranicu za 2 sekunde.</p>

    <a href="dashboard.php">Natrag na kontrolnu ploču</a>
</body>
</html>
