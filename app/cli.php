<?php
class cli {

    //reporting
    public function error($string){
        echo "\033[31mERROR:-> ".$string."\033[37m\r\n";
    }
    public function success($string){
        echo "\033[32mSUCCESS:-> ".$string."\033[37m\r\n";
    }
    public function output($string){
        echo $string."\n";
    }
    public function input($string){
        return readline($string);
    }

    public function get_comand(){
        //getting the comand
        return $_SERVER["argv"];
    }
}
