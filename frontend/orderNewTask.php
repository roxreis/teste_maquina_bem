<?php 

  include_once('template/header.php');

?>
  <main class="container mt-5">
    <form method="POST" action="controller/task/createTask.php">
      <legend>New Task</legend>
      <div class="form-group">
        <label for="exampleInputEmail1">Title</label>
        <input type="text" class="form-control col-3"  name="title" placeholder="Enter Title">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Description</label>
        <input type="text" class="form-control col-6"  name="description" placeholder="Description to your task">
      </div>
      <button type="submit" class="btn btn-success">Create</button>
    </form>
  </main>
<?php include_once('template/footer.php')?>