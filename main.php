<?php
if(file_exists(__DIR__.'/vendor/autoload.php')){
    include(__DIR__.'/vendor/autoload.php');
}else{
    //fallback classes loader
    include (__DIR__.'/includes/autoload.inc.php');
}
// date_timezone_set($myDateTime, timezone_open('Indian/Maldives'));

date_default_timezone_set('Indian/Maldives');

if(file_exists(__DIR__.'/.env')){
    $env = new EnvLoader(__DIR__.'/.env');
}else{
    $env = new EnvLoader();
}

$config = $env->all();

//db connection
if($env->get('servername') !=""){
    $conn = new mysqli($env->get('servername'), $env->get('username'), $env->get('password'), $env->get('dbname'));
    $db = new db();
}

//mail server setup
if($env->get('mailServer') !="" && file_exists(__DIR__.'/vendor/autoload.php')){
    $mailer =  new mailer();
}

//error reporting
if($env->get('error') == false){
    error_reporting(0);
}


//security funtions
$SECURITY = new security ($env->get('KEY_ONE'),$env->get('KEY_TWO'));

//tokens class
$TOKEN_GENERATOR = new tokens ();
