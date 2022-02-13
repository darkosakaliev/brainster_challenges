<?php

function decToBin($dec) {
    $binary = '';
    while($dec >= 1){
        $rem = $dec % 2;
        $dec /= 2;
        $binary = $rem.$binary;
    }
    echo $binary;
}

function decToRom($dec) {
    if($dec <= 3999999) {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($dec > 0) {
        foreach ($map as $roman => $int) {
            if($dec >= $int) {
                $dec -= $int;
                $returnValue .= $roman;
                break;
                }
            }
        }
        echo $returnValue;
    }
    else {
        echo "Error: Max convertable number is 3999999.";
    }
}

function binToDec($str) {
    $digits = str_split($str);
    $reversed = array_reverse($digits);
    $res = 0;

    for($x=0; $x < count($reversed); $x++) {
        if($reversed[$x] == 1) {
            $res += pow(2, $x);
        }
    }

    $str = $res;
    return $res;
}

function romValue($r){
    if ($r == 'I') {return 1;}
    if ($r == 'V') {return 5;}
    if ($r == 'X') {return 10;}
    if ($r == 'L') {return 50;}
    if ($r == 'C') {return 100;}
    if ($r == 'D') {return 500;}
    if ($r == 'M') {return 1000;}

    return -1;
}

function romToDec($str){
    $res = 0;
    for ($i = 0; $i < strlen($str); $i++)
    {
        $s1 = romValue($str[$i]);
        if ($i+1 < strlen($str))
        {
            $s2 = romValue($str[$i + 1]);
            if ($s1 >= $s2)
            {
                $res = $res + $s1;
            }
            else
            {
                $res = $res + $s2 - $s1;
                $i++; 
            }
        }
        else
        {
            $res = $res + $s1;
            $i++;
        }
    }
    return $res;
}

function typeOfNum(string $num) {

    if (preg_match('~^[01]+$~', $num)) {
        echo "'$num' is a binary number.<br/>";
        echo "Binary number '$num' is '";
        echo binToDec($num);
        echo "' in decimal.<br/>";
        echo "Binary number '$num' is '";
        $num = binToDec($num);
        decToRom($num);
        echo "' in roman.<br/>";
        echo "<hr/>";
    }

    else if (preg_match('/\+0/', $num) || preg_match('/-0/', $num)) {
        echo "Error: Inavlid number.<br/>";
        echo "<hr/>";
    }

    else if(preg_match('/[+-]/', $num) || preg_match('/[0-9]/', $num)) {
        echo "'$num' is a decimal number.<br/>";
        echo "Decimal number '$num' is '";
        decToBin($num);
        echo "' in binary.<br/>";
        echo "Decimal number '$num' is '";
        decToRom($num);
        echo "' in roman.<br/>";
        echo "<hr/>";
    }

    else if (preg_match('~^[IVXLCDM]+$~', $num)) {
        echo "'$num' is a roman number.<br/>";
        echo "Roman number '$num' is '";
        echo romToDec($num);
        echo "' in decimal.<br/>";
        echo "Roman number '$num' is '";
        $num = romToDec($num);
        decToBin($num);
        echo "' in binary.<br/>";
        echo "<hr/>";
    }
}


$numArr = ["1010", "+675", "893", "XXVII", "111001", "982", "VII", "MMX", "+023", "-015"];

for ($i = 0; $i < count($numArr); $i++) {
    typeOfNum($numArr[$i]);
}