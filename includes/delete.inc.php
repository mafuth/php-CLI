<?php
function delete_from_table($TABLE_NAME,$WHERE,$WHERE_VALUE,$conn){
    $sql3 = "DELETE FROM ".$TABLE_NAME." WHERE ".$WHERE."='".$WHERE_VALUE."'";
    if ($conn->query($sql3) === TRUE) {
        return true;
    } else {
        return $conn->error;
    }
}