<?php

function sequences_n($start, $step, $n) {
    if (!is_numeric($start) || !is_numeric($step) || !is_numeric($n)) {
        echo "$start, $step, $n: Parameters must be numeric!<br>";
        return;
    }

    $start = (float)$start;
    $step = (float)$step;
    $n = (int)$n;

    if ($n <= 0) {
        echo "$start, $step, $n: N must be positive number!<br>";
        return;
    }

    echo "$start, $step, $n:<br>";

    $arithmetic = [];
    $a = $start;
    for ($i = 0; $i < $n; $i++) {
        $arithmetic[] = $a;
        $a += $step;
    }

    $geometric = [];
    $g = $start;
    for ($i = 0; $i < $n; $i++) {
        $geometric[] = $g;
        $g *= $step;
    }

    echo "Arithmetic: " . implode(", ", $arithmetic) . "<br>";
    echo "Geometric: " . implode(", ", $geometric) . "<br>";
    echo "<br>";
}

sequences_n(5, 2, 10);
sequences_n(5, -2, 10);
sequences_n(-5, 2, 10);
sequences_n(5, 2.5, 5);
sequences_n(5, 2, -10);
sequences_n("start", 2, 10);

?>
