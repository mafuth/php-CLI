<?php
//remove erros
error_reporting(0);

//session
session_start();
$SESSION_ID = session_id();

//configs
include ('config.php');

//classesloader
include ('includes/autoload.inc.php');

//db
include ('includes/insert.inc.php');
include ('includes/update.inc.php');
include ('includes/select.inc.php');
include ('includes/delete.inc.php');

//get url
$url = $_SERVER['REQUEST_URI'];

//construst url decorder
$URL_DECORDER = new url_decorder ($url);

//security funtions
$SECURITY = new security ($SECURITY_KEY_ONE,$SECURITY_KEY_TWO);

//device infor funtions
$DEVICE_TYPE = new device ();

//minification funtions
$MINIFY = new minify ();

//otp class
$OTP_GENERATOR = new otp ($SECURITY_KEY_ONE,$SECURITY_KEY_TWO,6);

//tokens class
$TOKEN_GENERATOR = new tokens ($SECURITY_KEY_ONE,$SECURITY_KEY_TWO,13);
if(!isset($_COOKIE['UID']))
{
    // sets uid and temp cookies for user
    $TOKEN_GENERATOR->setUid();
    setcookie('temp', $SECURITY->encrypt(time()), 2147483647,'/');
}


//all requests handler
if($URL_DECORDER->get_path(1) == "error")
{
    include ('veiws/404.php');
}
elseif($URL_DECORDER->get_path(1) == "handle")
{
    $HANDLER = $URL_DECORDER->get_path(2);
    $FILE = "handlers/$HANDLER.handler.php";
    if(file_exists($FILE))
    {
        include ($FILE);
    }
    else{
        include ("veiws/404.php");
    }
}
elseif($URL_DECORDER->get_path(1) == "files")
{
       include ('files.php');  
}
elseif($URL_DECORDER->get_path(1) == "xml")
{
    //sleep(1);
    $AJAX_PAGE = $URL_DECORDER->get_path(2);
    if(file_exists("ajax/$AJAX_PAGE.ajax.php")){
        include ("ajax/$AJAX_PAGE.ajax.php");
    }else{
        echo 'unkown ajax request';
    }
}
else{
    if(file_exists('.htaccess') && file_exists('config.php')){
        ob_start();
        $PAGE_NAME = $URL_DECORDER->get_path(1);
        if($URL_DECORDER->get_path(1) == "")
        {
            include ('veiws/index.php');
        }
        elseif(file_exists("veiws/$PAGE_NAME.php"))
        {
            include ("veiws/$PAGE_NAME.php");
        }
        else{
            include ("veiws/404.php");
        } 
        $PAGE = ob_get_clean();
        echo $MINIFY->min($PAGE);
    }else{
        echo 'Please configure cli installation';
    }
}

