<?php
$HTACESS = '
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^.*$ /index.php [L,QSA]
# DO NOT REMOVE THIS LINE AND THE LINES BELLOW SSL_REDIRECT:mvflix.stream
RewriteEngine on
RewriteCond %{HTTPS} off
RewriteCond %{HTTP_HOST} (www\.)?mvflix.stream
RewriteRule (.*) https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
# DO NOT REMOVE THIS LINE AND THE LINES BELLOW SSL_REDIRECT:mvflix.stream
';

$CONFIG = '
<?php
//DATABASE CONFIGURATIONS//
$servername = "'.$servername.'";
$username = "'.$username.'";
$password = "'.$password.'";
$dbname = "'.$dbname.'";
$conn = new mysqli($servername, $username, $password, $dbname);

//other
$SECURITY_KEY_ONE = "'.$SECURITY_KEY_ONE.'";
$SECURITY_KEY_TWO = "'.$SECURITY_KEY_TWO.'";

function uniqidReal($lenght = 13) {
    // uniqid gives 13 chars, but you could adjust it to your needs.
    if (function_exists("random_bytes")) {
        $bytes = random_bytes(ceil($lenght / 2));
    } elseif (function_exists("openssl_random_pseudo_bytes")) {
        $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
    } else {
        throw new Exception("no cryptographically secure random function available");
    }
    return substr(bin2hex($bytes), 0, $lenght);
}
';