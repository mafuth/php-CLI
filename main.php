<?php
if(file_exists('config.ini')){
    $config = parse_ini_file('config.ini');
    
    //db connection
    if($config['servername'] !=""){
        $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
    }
    if($config['mailServer'] !=""){
        $mailer =  new mailer($config['mailServer'], $config['mailUsername'], $config['mailPassword'], $config['mailport']);
    }
    
    //error reporting
    if($config['error'] == false){
        error_reporting(0);
    }
}else{
    error_reporting(0);
}
if(file_exists('vendor/autoload.php')){
    include('vendor/autoload.php');
}
//classes loader
include ('includes/autoload.inc.php');

//security funtions
$SECURITY = new security ($config['KEY_ONE'],$config['KEY_TWO']);

//tokens class
$TOKEN_GENERATOR = new tokens ();