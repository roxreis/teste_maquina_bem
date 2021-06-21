<?php

 include_once('template/header.php');
 include_once('autoload.php');

  $tasks = new Task;
  $tasks = $tasks->listTask();
  $subTasks = new TaskSubGroup;
  $subTasks = $subTasks->listSubTask();
;

?>

  <main class="container mt-5">
    <table class="table table-bordered">
    <h2>MAIN TASKS</h2>
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Edit</th>
          <th scope="col">Delete</th>
          <th scope="col">Sub Group</th>
        </tr>
      </thead>
      <tbody>
      <?php if(isset($tasks)):
              foreach($tasks as $task): ?>
                <tr>
                  <th scope="row"><?=$task->id?></th>
                  <td><?=$task->title?></td>
                  <td><?=$task->description?></td>
                  <td><a href="editTask.php?id=<?=$task->id?>"><button type="button" class="btn btn-primary">Editar</button></a></td>
                  <td><form action="controller/task/deleteTask.php" method="post">
                    <input type='hidden' name='id' value='<?=$task->id?>'>
                    <button type="submit" class="btn btn-danger">Deletar</button>
                  </form></td>
                  <td> <p class="mt-3">
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                  New Task Sub Group
                </button>
                <div class="collapse" id="collapseExample">
                  <div class="card card-body">
                    <form method="POST" action="controller/subtask/createSubTask.php">
                      <legend>Task Sub Group</legend>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <input type="text" class="form-control col-3"  name="title" placeholder="Enter Title">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Description</label>
                        <input type="text" class="form-control col-6"  name="description" placeholder="Description to your task">
                      </div>
                      <div class="form-group mt-2">
                        <input type="number" min="0" class="form-control" name="estimated_time"  placeholder="estimated time in days">
                        <label  class="sr-only">Estimated time</label>
                      </div>
                      <div class="form-group form-check">
                        <label >important</label>
                        <select class="custom-select" name="important"id="inputGroupSelect01">
                          <option selected>choose..</option>
                          <option value="1">No</option>
                          <option value="2">Yes</option>
                        </select>
                      </div>
                      <input type='hidden' name='task_id' value='<?=$task->id?>'>
                      <button type="submit" class="btn btn-success">Create</button>
                    </form>
                  </div>
                </div></td>
              </tr>
      <?php   endforeach;
            endif; ?>
      </tbody>
    </table>
    <hr>
    <table class="table table-bordered">
    <h4>SUB GROUP TASKS</h4>
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">id task father</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Important</th>
          <th scope="col">Estimated days</th>
          <th scope="col">Edit</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>
      <?php if(isset($subTasks)):
              foreach($subTasks as $subTask): ?>
                <tr>
                  <th scope="row"><?=$subTask->id?></th>
                  <td><?=$subTask->task_id?></td>
                  <td><?=$subTask->title?></td>
                  <td><?=$subTask->description?></td>
                  <?php if ($subTask->important == 1):?>
                    <td><?='no'?></td>
                    <?php else: ?>
                      <td><?='yes'?></td>
                  <?php endif; ?>
                  <td><?=$subTask->estimated_time?></td>
                  <td><a href="editSubTask.php?id=<?=$subTask->id?>"><button type="button" class="btn btn-primary">Editar</button></a></td>
                  <td><form action="controller/subtask/deleteSubTask.php" method="post">
                    <input type='hidden' name='id' value='<?=$subTask->id?>'>
                    <button type="submit" class="btn btn-danger">Deletar</button>
                  </form></td>
                  <td>
                </tr>
        <?php endforeach;
            endif; ?>
      </tbody>
    </table>

  </main>


  <?php include_once('template/footer.php')?>
