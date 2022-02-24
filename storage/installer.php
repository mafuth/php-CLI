<?php
$HTACESS = '
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^.*$ /index.php [L,QSA]
';

$CONFIG = '
[database configs]
servername = "'.$servername.'"
username = "'.$username.'"
password = "'.$password.'"
dbname = "'.$dbname.'"

[encryption keys]
KEY_ONE = "'.$SECURITY_KEY_ONE.'"
KEY_TWO = "'.$SECURITY_KEY_TWO.'"

[maintanance mode]
maintanance = false

[error reporting]
error = false
';