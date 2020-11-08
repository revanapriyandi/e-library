<?php

namespace App\Helpers;

function UnformatRupiah($value)
{
    $pos = strpos($value, "(");

    $negatif = true;
    if ($pos === false) {
        $negatif = false;
    }

    $value = str_replace("Rp", "", $value);
    $value = str_replace(".", "", $value);
    $value = str_replace(" ", "", $value);
    $value = str_replace("(", "", $value);
    $value = str_replace(")", "", $value);


    if ($negatif) {
        $num = "-" . $value;
    } else {
        $num = $value;
    }
    return (int)$num;
}
