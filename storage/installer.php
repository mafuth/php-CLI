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
';