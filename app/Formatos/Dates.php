<?php

namespace App\Formatos;

use Illuminate\Database\Eloquent\Model;

class Dates extends Model
{
    public static function regular_date_to_array($date,$delimiter)
    {
        $pizza  = "piece1 piece2 piece3 piece4 piece5 piece6";
        $pieces = explode($delimiter, $date);
        $day = $pieces[0]; // piece1
        $month = $pieces[1]; // piece2
        $year = $pieces[2]; // piece2
        return $pieces;
    }
}
