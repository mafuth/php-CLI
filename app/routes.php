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

    public function redirect($url,$type,$message){
        if(!empty($type)){
            $_SESSION[$type] = $message;
        }
        header('Location: '.$url);
    }

    public function issetMessage($type){
        $message = false;
        if(!empty($_SESSION[$type])){
            $message = true;
        }
        return $message;
    }

    public function getMessage($type){
        $message = "";
        if(!empty($_SESSION[$type])){
            $message = $_SESSION[$type];
            $_SESSION[$type] = "";
        }
        return $message;
    }
}
