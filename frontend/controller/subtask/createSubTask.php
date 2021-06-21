<?php

include_once('../../autoload.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{ 
  $taskSub = new TaskSubGroup;
  if($taskSub->createSubTask($_POST))
    return header("Location: ../../index.php");

}

