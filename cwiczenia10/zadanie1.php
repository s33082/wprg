<?php
$threshold = 5;
$cookieName = 'licznik';
$cookieLifetime = 60 * 60 * 24;

if (isset($_POST['reset'])) {
    setcookie($cookieName, 0, time() + $cookieLifetime);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

$count = isset($_COOKIE[$cookieName]) ? intval($_COOKIE[$cookieName]) : 0;
$count++;
setcookie($cookieName, $count, time() + $cookieLifetime);

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Licznik odwiedzin</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 20px;
        }
        .message {
            color: red;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<p>Licznik: <strong><?= $count ?></strong></p>

<?php if ($count >= $threshold): ?>
    <p class="message">Masz już <?= $threshold ?> odwiedzin</p>
<?php endif; ?>

<form method="post">
    <button type="submit" name="reset">Resetuj licznik</button>
</form>
</body>
</html>
