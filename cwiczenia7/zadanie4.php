<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
<form action="" method="get">
    <label for="imie">Imię: </label>
    <input type="text" id="imie" name="imie"> <br>

    <label for="nazwisko">Nazwisko: </label>
    <input type="text" id="nazwisko" name="nazwisko"> <br>

    <label for="email">Adres e-mail: </label>
    <input type="email" id="email" name="email"> <br>

    <label for="haslo">Hasło: </label>
    <input type="password" id="haslo" name="haslo"> <br>

    <label for="haslo2">Potwierdź hasło: </label>
    <input type="password" id="haslo2" name="haslo2"> <br>

    <label for="wiek">Wiek </label>
    <input type="number" id="wiek" name="wiek"> <br>

    <input type="submit" value="Zarejestruj się">
</form>

<table>
    <tr>
        <th>Imię</th>
        <th>Nazwisko</th>
        <th>Adres e-mail</th>
        <th>Haslo</th>
        <th>Wiek</th>
    </tr>
    <tr>
<?php

if(isset($_GET['imie']) && isset($_GET['nazwisko']) && isset($_GET['email']) && isset($_GET['haslo']) && isset($_GET['haslo2']) && isset($_GET['email'])) {

    $imie = $_GET['imie'];
    $nazwisko = $_GET['nazwisko'];
    $email = $_GET['email'];
    $haslo = $_GET['haslo'];
    $haslo2 = $_GET['haslo2'];
    $wiek = $_GET['wiek'];

    if ($haslo !== $haslo2) {
        echo "<td colspan='5'>Hasła nie są takie same!</td>";
    } else {
        echo "<td>$imie</td>";
        echo "<td>$nazwisko</td>";
        echo "<td>$email</td>";
        echo "<td>$haslo</td>";
        echo "<td>$wiek</td>";
    }

}

?>
    </tr>
</table>

</body>
</html>
