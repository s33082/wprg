<?php
session_start();

$validUser = 'admin';
$validPassword = 'admin1';

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

$error = '';

if (isset($_POST['login'])) {
    $user = isset($_POST['user']) ? $_POST['user'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if ($user === $validUser && $password === $validPassword) {
        $_SESSION['logged_in'] = true;
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    } else {
        $error = 'Błędny login lub hasło.';
    }
}

$loggedIn = isset($_SESSION['logged_in']) ? $_SESSION['logged_in'] : false;
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Logowanie – Sesje PHP</title>
    <style>
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
<h1>Logowanie</h1>

<?php if ($loggedIn): ?>
    <p class="success">Zalogowano: <b><?= $validUser ?></b>.</p>
    <p><a href="?logout=1">Wyloguj</a></p>
<?php else: ?>
    <?php if ($error): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <form method="post" autocomplete="off">
        <label>Login:
            <input type="text" name="user" required>
        </label>
        <label>Hasło:
            <input type="password" name="password" required>
        </label>
        <button type="submit" name="login">Zaloguj</button>
    </form>
<?php endif; ?>
</body>
</html>
