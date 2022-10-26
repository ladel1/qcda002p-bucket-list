<?php 

namespace App\Service;

class Censurator{

    public function purify($string):string{
        $badWords = ["idiot","con"];
        return str_ireplace($badWords,"*****",$string);
    }

    public function purify2(string $text): string {
        $badWords = ["idiot","con"];
        $cleanText = array();
        foreach (explode(' ', $text) as $word) {
            if (array_search(strtolower($word),$badWords)) {
                array_push($cleanText, str_repeat('*', strlen($word)));
            } else {
                array_push($cleanText, $word);
            }
        }
        return implode(' ', $cleanText);
    }

}