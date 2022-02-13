<?php

function decToBin($dec) {
    $binary = '';
    echo "Decimal number '$dec'";
    while($dec >= 1){
        $rem = $dec % 2;
        $dec /= 2;
        $binary = $rem.$binary;
    }
    echo " is '$binary' in binary.<br/>";
}

function decToRom($dec) {
    if($dec <= 3999) {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        echo "Decimal number '$dec'";
        while ($dec > 0) {
        foreach ($map as $roman => $int) {
            if($dec >= $int) {
                $dec -= $int;
                $returnValue .= $roman;
                break;
                }
            }
        }
        echo " is '$returnValue' in roman.";
    }
    else {
        echo "Error: Max convertable number is 3999.";
    }
    echo "<br/>";
}


decToBin(532);
decToBin(122);
decToBin(564);
decToRom(532);
decToRom(122);
decToRom(564);