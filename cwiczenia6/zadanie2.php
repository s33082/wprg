<?php

function numbers($input) {
    if (!is_numeric($input)) {
        echo "$input: Parameter must be numeric!<br>";
        return;
    }

    $inputorg = $input;

    $input = str_replace('-', '', strval($input));
    $input = str_replace('.', '', strval($input));

    do {
        $sum = 0;
        for ($i = 0; $i < strlen($input); $i++) {
            $sum += (int)$input[$i];
        }
        $input = (string)$sum;
    } while ($sum >= 10);

    echo "$inputorg: $sum <br>";
}

numbers(5210);
numbers(-5210);
numbers(5210.5);
numbers("numbers");

?>
