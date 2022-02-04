<?php
$HTACESS = '
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^.*$ /index.php [L,QSA]
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
