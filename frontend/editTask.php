<?php 

  include_once('template/header.php');
  include_once('autoload.php');

    if(isset($_GET['id'])) $id = $_GET['id'];
    $task = new Task;
    $task = $task->showTask($id);
    
?>
  <main class="container mt-5">
    <form method="POST" action="controller/task/updateTask.php">
        <legend>New Task</legend>
        <div class="form-group">
          <label for="exampleInputEmail1">Title</label>
          <input type="text" class="form-control col-3"  value="<?=$task->title?>"name="title" placeholder="">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Description</label>
          <input type="text" class="form-control col-6"  name="description" value="<?=$task->description?>" placeholder="">
        </div>
        <input type='hidden' name="id" value="<?=$task->id?>" placeholder="">
        <button type="submit" class="btn btn-success">Update</button>

    </form>
  </main>

<?php include_once('template/footer.php')?>