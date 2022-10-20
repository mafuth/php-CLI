<?php
include (__DIR__.'/main.php');
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
            ob_start();
            include (__DIR__.'/routes/views.php');
            include(__DIR__.$route);
            $PAGE = ob_get_clean();
            echo $COMPILER->output($PAGE,true);
        }
    }catch(Exception $e) {
        echo $e->getMessage();
    }
}else{
    echo 'maintanance mode';
}