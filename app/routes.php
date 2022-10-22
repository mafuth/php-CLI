<?php
class routes {

    public function ajax($route){
        if(file_exists(dirname(__DIR__, 1).'/ajax/'.$route.'.ajax.php')){
            return '/ajax/'.$route.'.ajax.php';
        }else{
            throw new Exception("No valid ajax route found for ".$route);
        }
    }
    public function handler($route){
        if(file_exists(dirname(__DIR__, 1).'/handlers/'.$route.'.handler.php')){
            return '/handlers/'.$route.'.handler.php';
        }else{
            throw new Exception("No valid handler route found for ".$route);
        }
    }
    public function view($route){
        if(file_exists(dirname(__DIR__, 1).'/views/'.$route.'.php')){
            return '/views/'.$route.'.php';
        }else{
            throw new Exception("No valid views route found for ".$route);
        }

    }
}
