<?php
$DATA = '<?php
$sql = "CREATE TABLE '.$TABLE_NAME.' (
    id INT(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
  if ($conn->query($sql) === TRUE) {
    $CLI->success( "Table '.$TABLE_NAME.' created successfully " ."\n");
  } else {
    $CLI->error( "Error creating '.$TABLE_NAME.' table ". $conn->error ."\n");
  }
';