<?php 

namespace App\Repositories;

use App\Exceptions\CreateDeniedException;
use App\Exceptions\DoNotExistsTasksException;
use App\Exceptions\UpdateDeniedException;
use App\Models\Task;
use App\Models\TaskSubGroup;

class TaskRepository 
{
  public function listTasks()
  {
    $tasks = Task::orderBy('id', 'desc')->get();

     if($tasks != null):
      return $tasks; 
     else:
      throw new DoNotExistsTasksException('You do not have tasks yet!', 404);
     endif;
  }

  public function showTasks($id)
  {
    $task =Task::find($id);
    if($task != null):
      return $task; 
     else:
      throw new DoNotExistsTasksException('Task not exists!', 404);
     endif;
  }

  public function createTask($fields)
  {
    $task = new Task;

    if($task == null):
      throw new CreateDeniedException('There was an error creating the task, try again!', 503);
    endif;

    $task->create([
      'title' => $fields['title'],
      'description' => $fields['description']
    ]);


  } 
  
  
  public function updateTask($fields, $id)
  {
    $task = Task::where('id', $id)->first();
    
    if($task == null):
      throw new UpdateDeniedException('Task not exist', 404);
    endif;

    $task->update([
      'title' => $fields['title'],
      'description' => $fields['description']
    ]);


  }

  public function deleteTask($id)
  {
    $delete = Task::find($id);
    $deleteSub = TaskSubGroup::where('task_id', $id);
    if($delete != null):
      $deleteSub->delete();
      $delete->delete();
     else:
      throw new DoNotExistsTasksException('Task not exist', 404);
     endif;    
  }
}