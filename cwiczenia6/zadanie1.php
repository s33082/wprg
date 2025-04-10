<?php

function print_primes($start, $stop) {
    if (!is_numeric($start) || !is_numeric($stop)) {
        echo "$start, $stop: Start and stop must be numeric!<br>";
        return;
    }

    $startorg = $start;
    $stoporg = $stop;
    $start = (int)ceil($start);
    $stop = (int)ceil($stop);

    if ($start <= 0 || $stop <= 0) {
        echo "$startorg, $stoporg: Start and stop must be positive number! Given $start, $stop!<br>";
        return;
    }

    $min = min($start, $stop);
    $max = max($start, $stop);

    echo "$startorg, $stoporg: ";
    for ($i = $min; $i <= $max; $i++) {
        if (is_prime($i)) {
            echo "$i ";
        }
    }
    echo "<br>";
}

function is_prime($n) {
    if ($n < 2) return false;
    for ($i = 2; $i <= sqrt($n); $i++) {
        if ($n % $i == 0) return false;
    }
    return true;
}

print_primes(5, 10);
print_primes(10, 5);
print_primes(5.5, 10);
print_primes(-5, 10);
print_primes("prime", 10);

?>
