<?php 

namespace App\Repositories;

use App\Exceptions\CreateDeniedException;
use App\Exceptions\DoNotExistsTasksException;
use App\Exceptions\UpdateDeniedException;
use App\Models\TaskSubGroup;

class TaskSubGroupRepository 
{
  public function listTasks()
  {
    $tasks = TaskSubGroup::orderBy('id', 'desc')->get();
    if($tasks != null):
      return $tasks; 
      else:
        throw new DoNotExistsTasksException('You do not have tasks yet!', 404);
    endif;
  }

  public function showSubTasks($id)
  {
    $task =TaskSubGroup::find($id);
    if($task != null):
      return $task; 
      else:
        throw new DoNotExistsTasksException('Task not exists!', 404);
    endif;
  }

  public function createTask($fields)
  { 
    $task = new TaskSubGroup;
    if($task == null):
      throw new CreateDeniedException('There was an error creating the task, try again!', 503);
    endif;
    
    $task->create([
      'title' => $fields['title'],
      'description' => $fields['description'],
      'important' => $fields['important'],
      'estimated_time' => $fields['estimated_time'],
      'task_id' => $fields['task_id']
    ]);

  } 
  
  
  public function updateTask($fields, $id)
  {
    $task = TaskSubGroup::where('id', $id)->first();
    if($task == null):
      throw new UpdateDeniedException('Task not exist', 404);
    endif;

    $task->update([
      'title' => $fields['title'],
      'description' => $fields['description'],
      'estimated_time' => $fields['estimated_time'],
      'important' => $fields['important']
    ]);
  }

  public function deleteTask($id)
  {
    $delete = TaskSubGroup::find($id);
    if($delete != null):
       $delete->delete();
      else:
        throw new DoNotExistsTasksException('Task not exist', 404);
    endif;    
  }
}