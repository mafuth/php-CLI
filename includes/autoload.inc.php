<?php
spl_autoload_register('classesloader');

function classesloader ($CLASS)
{
  $PATH = dirname(__DIR__, 1)."/app/";
  $TYPE = ".php";
  $FILE = $PATH . $CLASS . $TYPE;

  if(file_exists($FILE))
  {
    include_once $FILE;
  }
 
}