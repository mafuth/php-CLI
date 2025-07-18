<?php
header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_ORIGIN']);
$API_PAGE = $URL_DECORDER->route(2);

$route = $routes->api($API_PAGE);