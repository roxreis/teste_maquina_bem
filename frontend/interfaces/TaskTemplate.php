<?php 

interface TaskTemplate
{
  public function createTask($data);
  public function listTask();
  public function updateTask($data);
  public function deleteTask($id);
  public function showTask($id);

}