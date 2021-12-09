<?php
$DATA = '
<?php
//do not delete the control feild
$sql = "CREATE TABLE '.$TABLE_NAME.' (
    id INT(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    control_feild VARCHAR(1000) NOT NULL,
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
  if ($conn->query($sql) === TRUE) {
    $CLI->success( "Table '.$TABLE_NAME.' created successfully " ."\n");
  } else {
    $CLI->error( "Error creating '.$TABLE_NAME.' table ". $conn->error ."\n");
  }
';