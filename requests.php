<?php
//get url
$url = $_SERVER['REQUEST_URI'];

//construst url decorder
$URL_DECORDER = new url_decorder ($url);

//minification funtions
$COMPILER = new compiler ();

//all requests handler
if($URL_DECORDER->get_path(1) == "error")
{
    include ('veiws/404.php');
}
elseif($URL_DECORDER->get_path(1) == "handle")
{
    $HANDLER = $URL_DECORDER->get_path(2);
    if (!empty($_POST['token'])) {
        if (hash_equals($_SESSION['token'], $_POST['csrf']) || hash_equals($_SESSION['token'], $_GET['csrf'])) {
            $TOKEN_GENERATOR->generateCSRF();
            $FILE = "handlers/$HANDLER.handler.php";
            if(file_exists($FILE))
            {
                include ($FILE);
            }
            else{
                include ("veiws/404.php");
            }
        } else {
            $TOKEN_GENERATOR->generateCSRF();
            include ("veiws/404.php");
        }
    }else {
        $TOKEN_GENERATOR->generateCSRF();
        include ("veiws/404.php");
    }
}
elseif($URL_DECORDER->get_path(1) == "xml")
{
    header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_ORIGIN']);
    $AJAX_PAGE = $URL_DECORDER->get_path(2);
    if(file_exists("ajax/$AJAX_PAGE.ajax.php")){
        include ("ajax/$AJAX_PAGE.ajax.php");
    }else{
        echo 'unkown ajax request';
    }
}
else{
    if(file_exists('.htaccess') && file_exists('config.ini')){
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
        echo $COMPILER->output($PAGE,true);
    }else{
        echo 'open terminal and run ( php cli --config ) to configure php CLI';
    }
}
