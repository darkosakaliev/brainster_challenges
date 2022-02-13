<?php

function binToDec($str) {
    $digits = str_split($str);
    $reversed = array_reverse($digits);
    $res = 0;

    for($x=0; $x < count($reversed); $x++) {
        if($reversed[$x] == 1) {
            $res += pow(2, $x);
        }
    }

    echo "Binary number '$str' is '$res' in decimal.<br/>";
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
    echo "Roman number '$str' is '$res' in decimal.<br/>";
}


binToDec("101010");
binToDec("111111");
binToDec("010101");
romToDec("MMXX");
romToDec("XVIII");
romToDec("MXVII");
