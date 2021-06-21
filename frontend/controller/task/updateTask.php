<?php 

include_once('../../autoload.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

  $task = new Task;
  if($task->updateTask($_POST))
    return header("Location: ../../index.php");
 

}