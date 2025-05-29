<?php

session_start();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host     = "localhost";
$user     = "root";
$pass     = "";
$dbname   = "wprg";

try {
    $conn = new mysqli($host, $user, $pass);
    $conn->set_charset("utf8mb4");
    $conn->query("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $conn->select_db($dbname);

    $conn->query("CREATE TABLE IF NOT EXISTS users (
        id            INT AUTO_INCREMENT PRIMARY KEY,
        first_name    VARCHAR(255) NOT NULL,
        last_name     VARCHAR(255) NOT NULL,
        email         VARCHAR(255) NOT NULL UNIQUE,
        password_hash VARCHAR(255) NOT NULL,
        age           INT,
        created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB");

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
        $first = trim($_POST['first_name'] ?? "");
        $last  = trim($_POST['last_name']  ?? "");
        $email = trim($_POST['email']      ?? "");
        $passw = $_POST['password']        ?? "";
        $age   = (int)($_POST['age'] ?? 0);

        if ($first && $last && $email && $passw && $age) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['message'] = "Niepoprawny adres e-mail.";
            } else {
                $hash = password_hash($passw, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password_hash, age) VALUES (?,?,?,?,?)");
                $stmt->bind_param("ssssi", $first, $last, $email, $hash, $age);
                $stmt->execute();
                $_SESSION['message'] = "Rejestracja zakończona pomyślnie!";
            }
        } else {
            $_SESSION['message'] = "Uzupełnij wszystkie pola.";
        }
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    $message = "";
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
    }

    $count = 0;
    $res = $conn->query("SELECT COUNT(*) AS cnt FROM users");
    if ($row = $res->fetch_assoc()) {
        $count = (int)$row['cnt'];
    }

} catch (mysqli_sql_exception $e) {
    $message = "Błąd: " . $e->getMessage();
    $count   = 0;
}
?>
    <!DOCTYPE html>
    <html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>rejestracja</title>
        <style>
            body {
                display: flex;
                justify-content: center;
                align-items: flex-start;
                min-height: 100vh;
                font-family: Arial, sans-serif;
            }
            .card {
                background: #fff;
                width: 420px;
                border-radius: 14px;
                border: 1px solid black;
                padding: 40px 50px;
            }
            h2 {
                text-align: center;
                margin-bottom: 30px;
            }
            label {
                display: block;
                font-weight: bold;
                margin-top: 18px;
            }
            input {
                width: 100%;
                padding: 12px 14px;
                border: 2px solid black;
                border-radius: 6px;
                font-size: 15px;
                outline: none;
                transition: box-shadow .15s;
            }
            input:focus {
                box-shadow: 0 0 0 3px rgba(0,124,115,0.25);
            }
            .btn {
                margin-top: 28px;
                width: 100%;
                background: #333333;
                color: #fff;
                padding: 14px;
                border: none;
                border-radius: 6px;
                font-size: 16px;
                cursor: pointer;
                transition: background .2s;
            }
            .btn:hover {
                background: #555555;
            }
            .info {
                text-align: center;
                margin-bottom: 18px;
                color: #333;
            }
            .msg {
                border: 1px solid black;
                color: red;
                border-radius: 6px;
                padding: 12px;
                text-align: center;
                margin-bottom: 18px;
            }
        </style>
    </head>
    <body>
    <div class="card">
        <h2>Registration Form</h2>

        <p class="info">Zarejestrowanych użytkowników: <strong><?php echo $count; ?></strong></p>

        <?php if ($message): ?>
            <div class="msg"><?php echo $message; ?></div>
        <?php endif; ?>

        <form method="post" novalidate>
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" min="1" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button class="btn" type="submit" name="register">Register</button>
        </form>
    </div>
    </body>
    </html>
<?php
if (isset($conn) && $conn instanceof mysqli) {
    $conn->close();
}
?>