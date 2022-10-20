<?php
$HANDLER = $URL_DECORDER->route(2);
if (!empty($_POST['csrf'])) {
    if (hash_equals($_SESSION['token'], $_POST['csrf']) || hash_equals($_SESSION['token'], $_GET['csrf'])) {
        $TOKEN_GENERATOR->generateCSRF();

        $route = $routes->handler($HANDLER);
        
    } else {
        $TOKEN_GENERATOR->generateCSRF();
        throw new Exception("Invalid or expired token");
    }
}else {
    $TOKEN_GENERATOR->generateCSRF();
    throw new Exception("Invalid or expired token");
}