<?php
use eftec\bladeone\BladeOne;
use eftec\bladeone\BladeOneCache;
use eftec\bladeonehtml\BladeOneHtml;
use Carbon\Carbon;

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
    $blade->share(array('db'=>$db));
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

$request = [];

$request = array_merge($request,$_GET);
$request = array_merge($request,$_POST);
$request['cookies'] = $_COOKIE;
$request['files'] = $_FILES;
$request['url'] = $URL_DECORDER->all_routes();

// Log raw body (for JSON, XML, etc.)
$rawBody = file_get_contents("php://input");

// Optionally decode JSON body
if (!empty($rawBody) && strpos($_SERVER['CONTENT_TYPE'] ?? '', 'application/json') !== false) {
    $jsonBody = json_decode($rawBody, true);
    $request = array_merge($request,$jsonBody);
}

// Fallback-compatible getallheaders
function get_all_headers_compat() {
    $headers = [];
    foreach ($_SERVER as $name => $value) {
        if (substr($name, 0, 5) === 'HTTP_') {
            $header = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))));
            $headers[$header] = $value;
        }
    }
    return $headers;
}


$headers = function_exists('getallheaders') ? getallheaders() : get_all_headers_compat();
$request['headers'] = $headers;

if($config['maintanance'] == false){
    try {
        if($URL_DECORDER->route(1) == "handle"){
            include (__DIR__.'/routes/handlers.php');
            include(__DIR__.$route);
        }
        elseif($URL_DECORDER->route(1) == "api"){
            header('Content-Type: application/json');
            include (__DIR__.'/routes/api.php');
            
            ob_start();
            include(__DIR__.$route);
            $resp = ob_get_clean();

            echo $resp;
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
        header('Content-Type: application/json');
        $response = ['error_code' => 500, 'error_description' =>"Server side error: ".$e->getMessage(), 'full_trace'=>json_encode($e)];
        echo json_encode($response);
    }
}else{
    echo 'maintanance mode';
}
