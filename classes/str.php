<?php

class str{

    static public function getRandomString($length = 60){
        $lowerLetterArray = [];
        for($letter = 'a'; $letter <= 'z'; $letter++){
            $lowerLetterArray[] = $letter;
        }
        $upperLetterArray = array_map('strtoupper', $lowerLetterArray);
        $numberArray = [];
        for($number = 0; $number <= 9; $number++){
            $numberArray[] = $number;
        }
        $symbolArray = ['!', '@', '#', '$',  ];  
        $finalArray = array_merge($lowerLetterArray, $upperLetterArray, $numberArray, $symbolArray);
        shuffle($finalArray);
        $randomString = '';
        for($i = 0; $i < $length; $i++){
            $randomInt = rand(0, count($finalArray) - 1);
            $randomString .= $finalArray[$randomInt];
        }
        return $randomString;
    }
}