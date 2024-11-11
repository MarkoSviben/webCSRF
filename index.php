<!DOCTYPE html>
<html>
<head>
    <title>Prijava</title>
</head>
<body>
    <h2>Prijava</h2>
    <form action="login.php" method="post">
        Korisničko ime: <input type="text" name="username" required><br>
        Lozinka: <input type="password" name="password" required><br>
        <label>
            <input type="checkbox" name="csrf_protection" <?php echo isset($_SESSION['csrf_protection']) && $_SESSION['csrf_protection'] ? 'checked' : ''; ?>>
            Omogući CSRF zaštitu
        </label><br>
        <input type="submit" value="Prijavi se">
    </form>
</body>
</html>
