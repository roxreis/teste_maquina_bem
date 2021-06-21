<?php 

  include_once('template/header.php');
  include_once('autoload.php');

    if(isset($_GET['id'])) $id = $_GET['id'];
    $taskSub = new TaskSubGroup;
    $taskSub = $taskSub->showSubTask($id);

?>
  <main class="container mt-5">
    <form method="POST" action="controller/subtask/updateSubTask.php">
        <legend>New Task</legend>
        <div class="form-group">
          <label for="exampleInputEmail1">Title</label>
          <input type="text" class="form-control col-3"  value="<?=$taskSub->title?>"name="title" placeholder="">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Description</label>
          <input type="text" class="form-control col-6"  name="description" value="<?=$taskSub->description?>" placeholder="">
        </div>
        <input type='hidden' name="id" value="<?=$taskSub->id?>" placeholder="">
        <div class="form-group mt-2">
          <input type="number" min="0" class="form-control col-3" name="estimated_time" value="<?=$taskSub->estimated_time?>" placeholder="">
          <label  class="sr-only">Estimated time</label>
        </div>
        <div class="form-group form-check">
          <label >important</label>
          <select class="custom-select col-3" name="important"id="inputGroupSelect01">
            <option selected>choose..</option>
            <option value="1">No</option>
            <option value="2">Yes</option>
          </select>
        </div>
        <button type="submit" class="btn btn-success">Update</button>

    </form>
  </main>

<?php include_once('template/footer.php')?>