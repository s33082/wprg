<?php

function nowaTablica($a, $b, $c, $d) {
    $tablica = [];
    $klucz = $a;
    $wartosc = $c;

    while ($klucz <= $b && $wartosc <= $d) {
        $tablica[$klucz] = $wartosc;

        $klucz++;
        $wartosc++;
    }

    print_r($tablica);
}

nowaTablica(1, 5, 1, 5);
nowaTablica(15, 20, 50, 55);

?>
