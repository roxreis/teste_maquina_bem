<?php 

include_once('Task.php');

class TaskSubgroup extends Task
{

  private $important = false;
  private $estimated_time;

  public function getImportant()
  {
    return $this->important;
  }

  public function setImportant($important)
  {
    $this->important = $important;
  }

  public function getEstimated_time()
  {
    return $this->estimated_time;
  }

  public function setEstimated_time($estimated_time)
  {
    $this->estimated_time = $estimated_time;
  }

  public function createTask($data)
  { 
    $this->setTitle($data['title']);
    $this->setDescription($data['description']);
    $init = curl_init('http://localhost:8000/api/create');

    $fields = [
      'title' => $this->getTitle(),
      'description' => $this->getDescription()
    ];

    curl_setopt($init, CURLOPT_POST, true);
    curl_setopt($init, CURLOPT_POSTFIELDS, $fields);
    curl_exec($init);
    curl_close($init);

  }
  public function listTask()
  {
    $json = file_get_contents('http://localhost:8000/api/');
    return json_decode($json);
  }
  public function updateTask($data)
  {

  }
  public function deleteTask($id)
  {

  }
}