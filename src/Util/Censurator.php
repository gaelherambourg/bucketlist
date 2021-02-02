<?php

namespace App\Util;

class Censurator{

    const MOT_A_REMPLACER = ["surf","vie","mer"];

    public function purify(string $text)
    {
        $tabtextCensure = [];
        $textAVerifer = explode(" ", $text);
        var_dump($textAVerifer);

        for ($i = 0; $i < count($textAVerifer); $i++){
            $mot = $textAVerifer[$i];
            if(in_array($mot, self::MOT_A_REMPLACER)){
                //var_dump($mot);
                $censure = substr_replace($mot,"***",0,strlen($mot));
                $mot = $censure;;
            }
            $tabtextCensure[$i] = $mot;
        }

        $textCensure = implode(" ",$tabtextCensure);
        var_dump($textCensure);

        return $textCensure;
    }

}
