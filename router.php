<?php
use eftec\bladeone\BladeOne;
use eftec\bladeone\BladeOneCache;
use eftec\bladeonehtml\BladeOneHtml;

include (__DIR__.'/main.php');

$views = __DIR__ . '/views';
$cache = __DIR__ . '/storage/cache';
class BladeCached extends BladeOne
{
    use BladeOneCache;
}

$blade = new BladeCached($views,$cache,BladeOne::MODE_DEBUG);
$blade->setCacheLog(__DIR__.'/storage/cachelog.log');
define('BLADEONE_MODE', 0); // (optional) 1=forced (test),2=run fast (production), 0=automatic, default value.
//$blade = new BladeOne($views,$cache,BladeOne::MODE_DEBUG);
$blade->share(array('config'=>$config,'SECURITY'=>$SECURITY));
if($config['servername'] !=""){
    $blade->share(array('DB'=>$DB));
    $blade->share(array('conn'=>$conn));
}
if($config['mailServer'] !="" && file_exists(__DIR__.'/vendor/autoload.php')){
    $mailer =  new mailer();
    $blade->share(array('mailer'=>$mailer));
}

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

if(!isset($_COOKIE['UUID']))
{
    // sets uid and temp cookies for user
    $UUID = $TOKEN_GENERATOR->setUUid(13);
    setcookie('temp', $SECURITY->encrypt(time()), 2147483647,'/');
    if (empty($_SESSION['token'])) {
        $TOKEN_GENERATOR->generateCSRF();
    }
    header('Location: ' . $CURRENT_URL);
}
if (empty($_SESSION['token'])) {
    $TOKEN_GENERATOR->generateCSRF();
}

//get url
$url = $_SERVER['REQUEST_URI'];

//construst url decorder
$URL_DECORDER = new url_decorder ($url);

//minification funtions
$COMPILER = new compiler ();

//router funtions
$routes = new routes ();

if($config['maintanance'] == false){
    try {
        if($URL_DECORDER->route(1) == "handle"){
            include (__DIR__.'/routes/handlers.php');
            include(__DIR__.$route);
        }
        elseif($URL_DECORDER->route(1) == "xml"){
            include (__DIR__.'/routes/ajax.php');
            include(__DIR__.$route);
        }
        else{
            include (__DIR__.'/routes/views.php');
            ob_start();
            if($route){
                include(__DIR__.$route);
            }else{
                echo $blade->run();
            }
            $PAGE = ob_get_clean();
            echo $COMPILER->output($PAGE,true);
        }
    }catch(Exception $e) {
        include(__DIR__.'/storage/exception.php');
    }
}else{
    echo 'maintanance mode';
}
