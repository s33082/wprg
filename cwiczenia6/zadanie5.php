<?php

function is_pangram($text) {
    $text = strtolower($text);

    $unique_letters = [];

    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];
        if ($char >= 'a' && $char <= 'z') {
            $unique_letters[$char] = true;
        }
    }

    if (count($unique_letters) === 26) {
        echo "true <br>";
    } else {
        echo "false <br>";
    }
}

is_pangram("The quick brown fox jumps over the lazy dog");
is_pangram("to zdanie na pewno nie jest pangramem");

?>
