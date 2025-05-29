<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wprg";

$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("blad: " . $conn->connect_error);
}

$conn->select_db($dbname);

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $dropSQL = "DROP TABLE IF EXISTS Student";
    if ($conn->query($dropSQL) === TRUE) {
        $message = "tabela usunieta.";
    } else {
        $message = "blad: " . $conn->error;
    }
}
else {
    $createSQL = "CREATE TABLE IF NOT EXISTS Student (
        StudentID   INT AUTO_INCREMENT PRIMARY KEY,
        Firstname   VARCHAR(255) NOT NULL,
        Secondname  VARCHAR(255),
        Salary      INT,
        DateOfBirth DATE
    )";

    if ($conn->query($createSQL) === TRUE) {
        $message = "utworzono tabele.";
    } else {
        if ($conn->errno == 1050) {
            $message = "tabela student juz istnieje.";
        } else {
            $message = "blad: " . $conn->error;
        }
    }

}
?>
    <!DOCTYPE html>
    <html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>zadanie 1</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background: #222;
            }
            .container {
                max-width: 600px;
                margin: 50px auto;
                background: #fff;
                padding: 50px;
            }
            h1 {
                text-align: center;
                margin-bottom: 30px;
            }
            .message {
                padding: 15px;
                color: red;
                border-radius: 5px;
                margin-bottom: 30px;
                text-align: center;
            }
            button {
                font-size: 16px;
                border-radius: 5px;
                background: #4caf50;
                color: #fff;
                padding: 15px 30px;
                cursor: pointer;
            }
        </style>
    </head>
    <body>
    <div class="container">
        <h1>Manage MySQL Table</h1>

        <div class="message"><?php echo $message; ?></div>

        <form method="post">
            <button type="submit" name="delete">Delete Table</button>
        </form>
    </div>
    </body>
    </html>

<?php

$conn->close();

?>