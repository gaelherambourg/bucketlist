<?php

namespace App\Util;

class Censurator{

    const MOT_A_REMPLACER = ["surf","vie","mer", "est"];

    public function purify(string $text)
    {

        //file_get_contents()  aller chercher les mots dans un fichier

        //Méthode de la correction
        foreach (self::MOT_A_REMPLACER as $badword){
            $replacement = str_repeat("*",mb_strlen($badword));
            $text = str_ireplace($badword, $replacement, $text);
        }

        //Ancienne méthode pour remplacer les bad words
//        $tabtextCensure = [];
//        $textAVerifer = explode(" ", $text);
//        var_dump($textAVerifer);
//
//        for ($i = 0; $i < count($textAVerifer); $i++){
//            $mot = $textAVerifer[$i];
//            if(in_array($mot, self::MOT_A_REMPLACER)){
//                //var_dump($mot);
//                $censure = substr_replace($mot,"***",0,strlen($mot));
//                $mot = $censure;;
//            }
//            $tabtextCensure[$i] = $mot;
//        }
//
//        $textCensure = implode(" ",$tabtextCensure);
//        var_dump($textCensure);

        return $text;
    }

}
