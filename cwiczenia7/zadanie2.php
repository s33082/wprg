<?php

function rozepchnijTablice($tablica, $n)
{
    if (!isset($tablica[$n])) {
        echo "BŁĄD";
        return;
    }

    $rozepchnieta = [];

    foreach ($tablica as $i => $wartosc) {
        if ($i == $n) {
            $rozepchnieta[] = '$';
        }
        $rozepchnieta[] = $wartosc;
    }

    foreach ($rozepchnieta as $j => $wartosc) {
        echo $wartosc . " ";
    }
    echo "<br>";
}

$tablica = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
$n = 5;
rozepchnijTablice($tablica, $n);


$tablica = [5, 6, 7];
$n = 5;
rozepchnijTablice($tablica, $n);

?>