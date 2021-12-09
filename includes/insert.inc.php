<?php
function insert_to_table($TABLE_NAME,$VALUES,$conn){
    ob_start();
    $sql = "SHOW COLUMNS FROM ".$TABLE_NAME."";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) 
    {
        if($row['Field'] != "id" && $row['Field'] != "updated_on" && $row['Field'] != "control_feild"){
            $COLUM = $row['Field'];
            echo $COLUM.',';
        }
    }
    echo 'control_feild';
    $COLUMS = ob_get_clean();
    ob_start();
    $i =0;
    while($VALUES[$i] != ""){
        $VALUE = $VALUES[$i];
        if($VALUE != ""){
            echo "'$VALUE',";
        }
        $i++;
    }
    echo "'null'";
    $INSERT_VALUES = ob_get_clean();
    
    $sql = "INSERT INTO ".$TABLE_NAME." (".$COLUMS.")
    VALUES (".$INSERT_VALUES.")";
    if ($conn->query($sql) === TRUE){
        echo true;
    }else{
        echo $conn->error;
    }
}
