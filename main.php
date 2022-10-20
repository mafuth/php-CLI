<?php
if(file_exists(__DIR__.'/config.ini')){
    $config = parse_ini_file('config.ini');
    
    //db connection
    if($config['servername'] !=""){
        $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
    }
    
    //error reporting
    if($config['error'] == false){
        error_reporting(0);
    }
}else{
    error_reporting(0);
}
if(file_exists(__DIR__.'/vendor/autoload.php')){
    include(__DIR__.'/vendor/autoload.php');
    if($config['mailServer'] !=""){
        $mailer =  new mailer($config['mailServer'], $config['mailUsername'], $config['mailPassword'], $config['mailport']);
    }
}
//classes loader
include (__DIR__.'/includes/autoload.inc.php');

//security funtions
$SECURITY = new security ($config['KEY_ONE'],$config['KEY_TWO']);

//tokens class
$TOKEN_GENERATOR = new tokens ();

//data base
if($config['servername'] !=""){
    $DB = new db($conn);
}
