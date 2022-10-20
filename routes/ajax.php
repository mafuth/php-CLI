<?php
header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_ORIGIN']);
$AJAX_PAGE = $URL_DECORDER->route(2);

$route = $routes->ajax($AJAX_PAGE);