<?php

function checkBracketsAreBalanced(string $input) {
    $leftover = [];

    for ($x = 0; $x < strlen($input); ++$x) {
        switch ($input[$x]) {
            case ')':
                if (array_pop($leftover) !== '(') return false;
                break;
            case ']':
                if (array_pop($leftover) !== '[') return false;
                break;
            case '}':
                if (array_pop($leftover) !== '{') return false;
                break;
            default:
                array_push($leftover, $input[$x]);
                break;
        }
    }

    return count($leftover) === 0 ? true : false;
}

echo "\n ([])[]({}) " . json_encode(checkBracketsAreBalanced('([])[]({})'));
echo "\n ([)] " . json_encode(checkBracketsAreBalanced('([)]'));
echo "\n ((() " .  json_encode(checkBracketsAreBalanced('((()'));
