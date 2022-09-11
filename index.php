<?php
//main file
include ('main.php');
if($config['autossl']==true){
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: ' . $location);
        exit;
    }
}else{
    $location = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $CURRENT_URL = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}else{
    $CURRENT_URL = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

//session
session_start();
$SESSION_ID = session_id();

if(!isset($_COOKIE['UID']))
{
    // sets uid and temp cookies for user
    $TOKEN_GENERATOR->setUUid(13);
    setcookie('temp', $SECURITY->encrypt(time()), 2147483647,'/');
}
if (empty($_SESSION['token'])) {
    $TOKEN_GENERATOR->generateCSRF();
}


if($config['maintanance'] == false){
    include('requests.php');
}else{
    echo 'site in maintanance mode';
}

