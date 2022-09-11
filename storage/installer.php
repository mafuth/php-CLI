<?php
$HTACESS = 'RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^.*$ /index.php [L,QSA]
';

$CONFIG = '[app configs]
appname = "'.$appName.'"
port = "8080"

[database configs]
servername = "'.$servername.'"
username = "'.$username.'"
password = "'.$password.'"
dbname = "'.$dbname.'"

[Mail server]
mailServer = "'.$SMTPservername.'"
mailUsername = "'.$SMTPusername.'"
mailPassword = "'.$SMTPpassword.'"
mailport = "'.$SMTPport.'"

[encryption keys]
KEY_ONE = "'.$SECURITY_KEY_ONE.'"
KEY_TWO = "'.$SECURITY_KEY_TWO.'"

[maintanance mode]
maintanance = false

[error reporting]
error = false

[auto ssl]
autossl = false
';

$gitignore = '#git ignore files and folder goes in this folder
vendor
config.ini
.htaccess
composer.phar
';

$CONFIG_NEW = '[app configs]
appname = "'.$config['appname'].'"
port = "'.$config['port'].'"

[database configs]
servername = "localhost"
username = "'.$config['username'].'"
password = "'.$config['password'].'"
dbname = "'.$config['dbname'].'"

[Mail server]
mailServer = "'.$config['mailServer'].'"
mailUsername = "'.$config['mailUsername'].'"
mailPassword = "'.$config['mailPassword'].'"
mailport = "'.$config['mailport'].'"

[encryption keys]
KEY_ONE = "'.$config['KEY_ONE'].'"
KEY_TWO = "'.$config['KEY_TWO'].'"

[maintanance mode]
maintanance = false

[error reporting]
error = false

[auto ssl]
autossl = false
';