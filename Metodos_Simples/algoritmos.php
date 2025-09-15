<?php
function mergeSort($array) {
    if(count($array) <= 1) return $array;

    $middle = floor(count($array)/2);
    $left = array_slice($array, 0, $middle);
    $right = array_slice($array, $middle);

    $left = mergeSort($left);
    $right = mergeSort($right);

    return merge($left, $right);
}

function merge($left, $right) {
    $result = [];
    while(count($left) > 0 && count($right) > 0) {
        if($left[0] <= $right[0]) {
            $result[] = array_shift($left);
        } else {
            $result[] = array_shift($right);
        }
    }
    return array_merge($result, $left, $right);
}

function quickSort($array) {
    if(count($array) < 2) return $array;

    $pivot = $array[0];
    $left = $right = [];

    for($i=1; $i<count($array); $i++) {
        if($array[$i] < $pivot) {
            $left[] = $array[$i];
        } else {
            $right[] = $array[$i];
        }
    }

    return array_merge(quickSort($left), [$pivot], quickSort($right));
}

function bubbleSort($array) {
    $n = count($array);
    for($i=0; $i<$n; $i++) {
        for($j=0; $j<$n-$i-1; $j++) {
            if($array[$j] > $array[$j+1]) {
                $temp = $array[$j];
                $array[$j] = $array[$j+1];
                $array[$j+1] = $temp;
            }
        }
    }
    return $array;
}
?>
