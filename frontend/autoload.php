<?php 

spl_autoload_register(
   function($class){
     require "class/$class.php";
   }
  );

  require_once('interfaces/TaskTemplate.php');
 