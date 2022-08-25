<?php
//main file
include ('main.php');

//session
session_start();
$SESSION_ID = session_id();

//tokens class
$TOKEN_GENERATOR = new tokens ();
if(!isset($_COOKIE['UID']))
{
    // sets uid and temp cookies for user
    $TOKEN_GENERATOR->setUUid(13);
    setcookie('temp', $SECURITY->encrypt(time()), 2147483647,'/');
}


if($config['maintanance'] == false){
    include('requests.php');
}else{
    echo 'site in maintanance mode';
}

