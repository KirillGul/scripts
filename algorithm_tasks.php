<?php

error_reporting(E_ALL); //задаёт уровень протоколирования ошибки (E_ALL)
ini_set('display_errors', 'on'); //требуется ли выводить ошибки на экран

//$line = '-2 1 -3 4 -1 2 1 -5 4';
$line = '-8 -3 -6 -2 -5 -4';

echo $line."<br>";
$line = explode (' ', $line);

$maximumEequence = '';

while (count($line) > 0) {
    if (!isset($sum)) {
        
        $sum = $line[0];
        $maximumEequence = $line[0];

    } else {

        if ($line[0] + $sum > $line[0]) {
            $sum += $line[0];
            $maximumEequence .= ' ' . $line[0];
        } else {
            $sum = $line[0];
            $maximumEequence = $line[0];
        }

    }


    array_shift($line);
}

echo $maximumEequence;
echo "<br>$sum";
