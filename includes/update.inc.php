<?php
function update_table($TABLE_NAME,$SET_COLUM,$SET_VALUE,$SET_WHERE,$WHERE_VALUE,$conn){
    $sql="UPDATE ".$TABLE_NAME." SET ".$SET_COLUM."='".$SET_VALUE."' WHERE ".$SET_WHERE."='".$WHERE_VALUE."'";
    if ($conn->query($sql) === TRUE) {
        return true;
    }else{
        return $conn->error;
    }
}