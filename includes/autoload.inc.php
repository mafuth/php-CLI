<?php
spl_autoload_register('classesloader');

function classesloader ($CLASS)
{
  $PATH = "classes/";
  $TYPE = ".class.php";
  $FILE = $PATH . $CLASS . $TYPE;

  if(file_exists($FILE))
  {
    include_once $FILE;
  }
 
}