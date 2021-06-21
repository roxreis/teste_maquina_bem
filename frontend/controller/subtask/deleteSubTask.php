<?php


require_once('../../autoload.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
  $id = $_POST['id'];
  $taskSub = new TaskSubGroup;
  if($taskSub->deleteSubTask($id)) 
    return header("Location: ../../index.php");
 
    
}