<?php
$DATA = '
<?php
$POST_DATA = array();
foreach ($_POST as $x => $val) {
    $POST_DATA[$x] = $conn->real_escape_string(htmlspecialchars($val));
}
// all post request data is now saved in $POST_DATA variable
';