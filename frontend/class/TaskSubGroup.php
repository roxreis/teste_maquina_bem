<?php

use Ramsey\Uuid\Guid\Fields;

class TaskSubgroup extends Task
{

  private $important;
  private $estimated_time;
  private $task_id;

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

  public function getTask_id()
  {
    return $this->task_id;
  }

  public function setTask_id($task_id)
  {
    $this->task_id = $task_id;
  }

  public function createSubTask($data)
  { 
    $this->setCreate($data);
    $fields = [
      'title' => $this->getTitle(),
      'description' => $this->getDescription(),
      'important' => $this->getImportant(),
      'estimated_time' => $this->getEstimated_time(),
      'task_id' => $this->getTask_id()
    ];

    return $this->curlSubCreate($fields);

  }

  public function listSubTask()
  {
    return json_decode($this->curlSubList());
  }

  public function showSubTask($id)
  {
    return json_decode($this->curlSubShow($id)); 
  }

  public function updateSubTask($data)
  { 
    $this->setUpdate($data);
    $fields = [
      'title' => $this->getTitle(),
      'description' => $this->getDescription(),
      'important' => $this->getImportant(),
      'estimated_time' => $this->getEstimated_time(),
      'id' => $data['id']

    ];

    return json_decode($this->curlSubUpdate($fields));

  }

  public function deleteSubTask($id)
  {
    return $this->curlSubDelete($id);
  }



  public function curlSubCreate($fields)
  {
    $init = curl_init('http://localhost:8000/api/createSub');
    return $this->curlPost($init, $fields);
 
 
  }

  public function curlSubList()
  {
    $url = 'http://localhost:8000/api/listSub';
    return $this->curlGet($url);


  }

  public function curlSubShow($id)
  {
    $url = "http://localhost:8000/api/showSub/$id";
    return $this->curlGet($url);
  }

  public function curlSubUpdate($fields)
  {
    $id = $fields[ 'id'];
    $init = curl_init("http://localhost:8000/api/updateSub/$id");
    return $this->curlPost($init, $fields);

  }

  public function curlSubDelete($id)
  {
    $init = curl_init("http://localhost:8000/api/deleteSub/$id");
    curl_setopt($init, CURLOPT_POST, true);
    return curl_exec($init);
  }

  public function curlPost($init, $fields)
  {
    curl_setopt($init, CURLOPT_POST, true);
    curl_setopt($init, CURLOPT_POSTFIELDS, $fields);
    return curl_exec($init);
  }

  public function curlGet($url)
  {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_CUSTOMREQUEST, 'GET');
    return curl_exec($ch);
  }

  public function setUpdate($data)
  {
    $this->setTitle($data['title']);
    $this->setDescription($data['description']);
    $this->setImportant($data['important']);
    $this->setEstimated_time($data['estimated_time']);
  }

  public function setCreate($data)
  {
    $this->setTitle($data['title']);
    $this->setDescription($data['description']);
    $this->setImportant($data['important']);
    $this->setEstimated_time($data['estimated_time']);
    $this->setTask_id($data['task_id']);
  }

}