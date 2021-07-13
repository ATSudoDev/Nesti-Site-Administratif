<?php 

class FormatUtil {

    public static function dump($var){
        echo "<pre>".htmlentities(print_r($var, true))."</pre>";
    }

    public static function dd($var){
        self::dump($var);
        die();
    }
    
}