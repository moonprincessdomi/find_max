<?php
// src/Entity/Task.php
namespace App\Entity;

class GenerateNumbers
{
    private static $cached = [];

    private static function generateArray()
    {
        $array[0] = 0;
        $array[1] = 1;

        foreach(range (2,99999) as $iter){
            $array[$iter] = ($iter % 2 == 0) ? ($array[floor($iter/2)]) : ($array[floor($iter/2)] + $array[ceil($iter/2)]);
        }

        return $array;
    }

    public static function findMax($input_array) {
        $max = [];
        if (count(GenerateNumbers::$cached) == 0) {
            GenerateNumbers::$cached = GenerateNumbers::generateArray();
        }
        foreach($input_array as &$iter){
            $tiny_array = array_slice(GenerateNumbers::$cached, 0, $iter + 1);
            
            $max[] = max($tiny_array);
        }
        return $max;
    }
}
