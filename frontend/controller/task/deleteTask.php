<?php 

require_once('../../autoload.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
  $id = $_POST['id'];
  $task = new Task;
  if($task->deleteTask($id)) 
    return header("Location: ../../index.php");
 
    
}