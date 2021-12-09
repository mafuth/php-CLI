<?php
function select_from_table($TABLE_NAME,$conn){
    $DATA = array();
    $sql = "SELECT * FROM ".$TABLE_NAME."";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc())
    {
        array_push($DATA,$row);
    }
    return $DATA;
}
