<?php
$PAGE_NAME = $URL_DECORDER->route(1);

if($PAGE_NAME == ""){
    //$route = $routes->view('index');
    $blade->setView('index'); 
}
else{
    $blade->setView($PAGE_NAME); 
    //$route = $routes->view($PAGE_NAME);
}