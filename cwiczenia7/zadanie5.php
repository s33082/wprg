<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        fieldset {
            margin-bottom: 20px;
            width: 200px;
        }
        label, select, input {
            margin: 5px 0;
            display: block;
        }
        input[type="number"], input[type="text"], select {
            width: 200px;
        }
    </style>
</head>
<body>
<form method="POST">
    <fieldset>
        <legend>Prosty</legend>
        <label>Liczba 1: <input type="number" name="liczba1"></label>
        <label>Dzialanie:
            <select name="proste_dzialanie">
                <option value="dodaj">Dodawanie</option>
                <option value="odejmij">Odejmowanie</option>
                <option value="mnoz">Mnożenie</option>
                <option value="dziel">Dzielenie</option>
            </select>
        </label>
        <label>Liczba 2: <input type="number" name="liczba2"></label>
        <input type="submit" name="kalkulator_prosty" value="Oblicz">
    </fieldset>

    <fieldset>
        <legend>Zaawansowany</legend>
        <label>Liczba 1: <input type="text" name="wartosc"></label>
        <label>Dzialanie:
            <select name="zaawansowane_dzialanie">
                <option value="cos">Cosinus</option>
                <option value="sin">Sinus</option>
                <option value="tan">Tangens</option>
                <option value="bin2dec">Binarne na dziesiętne</option>
                <option value="dec2bin">Dziesiętne na binarne</option>
                <option value="dec2hex">Dziesiętne na szesnastkowe</option>
                <option value="hex2dec">Szesnastkowe na dziesiętne</option>
            </select>
        </label>
        <input type="submit" name="kalkulator_zaawansowany" value="Oblicz">
    </fieldset>
</form>

<?php
if (isset($_POST['kalkulator_prosty'])) {
    $wartoscA = $_POST['liczba1'];
    $wartoscB = $_POST['liczba2'];
    $dzialanie = $_POST['proste_dzialanie'];

    if (!is_numeric($wartoscA) || !is_numeric($wartoscB)) {
        echo "<p>niepoprawne liczby</p>";
    } else {
        switch ($dzialanie) {
            case "dodaj":
                $wynik = $wartoscA + $wartoscB;
                break;
            case "odejmij":
                $wynik = $wartoscA - $wartoscB;
                break;
            case "mnoz":
                $wynik = $wartoscA * $wartoscB;
                break;
            case "dziel":
                if ($wartoscB == 0) {
                    echo "<p>dzielenie przez 0</p>";
                    exit;
                }
                $wynik = $wartoscA / $wartoscB;
                break;
            default:
                $wynik = "blad";
        }
        echo "<p>Wynik działania: <b>$wynik</b></p>";
    }
}

if (isset($_POST['kalkulator_zaawansowany'])) {
    $wartosc = $_POST['wartosc'];
    $operacja = $_POST['zaawansowane_dzialanie'];

    switch ($operacja) {
        case "cos":
            $wynik = cos(deg2rad($wartosc));
            break;
        case "sin":
            $wynik = sin(deg2rad($wartosc));
            break;
        case "tan":
            $wynik = tan(deg2rad($wartosc));
            break;
        case "bin2dec":
            $wynik = bindec($wartosc);
            break;
        case "dec2bin":
            $wynik = decbin($wartosc);
            break;
        case "dec2hex":
            $wynik = dechex($wartosc);
            break;
        case "hex2dec":
            $wynik = hexdec($wartosc);
            break;
        default:
            $wynik = "blad";
    }

    echo "<p>Wynik działania: <b>$wynik</b></p>";
}
?>

</body>
</html>
