<?php

function mnozenie($A, $B) {
    $rowsA = count($A);
    $colsA = count($A[0]);

    $rowsB = count($B);
    $colsB = count($B[0]);

    if ($colsA != $rowsB) {
        echo "wymiary macierzy niezgodne ($colsA != $rowsB) <br>";
        return;
    }

    $result =
        array_fill(0, $rowsA,
            array_fill(0, $colsB, 0));

    for ($i = 0; $i < $rowsA; $i++) {
        for ($j = 0; $j < $colsB; $j++) {
            for ($k = 0; $k < $colsA; $k++) {
                $result[$i][$j] += $A[$i][$k] * $B[$k][$j];
            }
        }
    }

    echo "Wynik mnozenia macierzy: <br>";
    foreach ($result as $row) {
        echo implode(" ", $row) . "<br>";
    }
}

$A = [
    [1, 1, 1],
    [2, 2, 2]
];

$B = [
    [3, 4],
    [4, 3],
    [4, 3]
];

mnozenie($A, $B);

$C = [
    [1, 2],
    [3, 4]
];

$D = [
    [5, 6]
];

mnozenie($C, $D);

?>
