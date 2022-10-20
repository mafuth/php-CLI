<?php
$PAGE_NAME = $URL_DECORDER->route(1);

if($PAGE_NAME == ""){
    $route = $routes->view('index');
}
else{
    $route = $routes->view($PAGE_NAME);
}