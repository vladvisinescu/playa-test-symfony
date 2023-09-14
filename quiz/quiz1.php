<?php

$initialArray = [1,2,3];

if (empty($initialArray) || count($initialArray) > 8) {
    echo json_encode($initialArray);
    exit();
}

for ($x = 0; $x < count($initialArray); ++$x) {
    if (($initialArray[$x] < -10) || ($initialArray[$x] > 10)) {
        echo json_encode($initialArray);
        exit();
    }
}

function permute($nums, $perms = [], &$results = [], &$seen = []) {

    if (empty($nums)) {
        $results[] = $perms;
    } else {
        for ($i = count($nums) - 1; $i >= 0; --$i) {
            $new = $nums;
            $newArray = $perms;
            list($foo) = array_splice($new, $i, 1);
            array_unshift($newArray, $foo);

            if (!in_array($newArray, $seen)) {
                $seen[] = $newArray;
                permute($new, $newArray, $results, $seen);
            }
        }
    }

    return $results;
}


echo json_encode(permute($initialArray));
