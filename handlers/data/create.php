<?php
$DATA = '<?php
$POST_DATA = array();
foreach ($_POST as $x => $val) {
    $POST_DATA[$x] = $DB->sanitize($val);
}
$GET_DATA = array();
foreach ($_GET as $x => $val) {
    $GET_DATA[$x] = $DB->sanitize($val);
}
// all post request data is now saved in $POST_DATA array
// all get request data is now saved in $GET_DATA array
';
