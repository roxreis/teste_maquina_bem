<?php

require_once(dirname(__FILE__).'/../interfaces/TaskTemplate.php');
 

class Task implements TaskTemplate
{
  private $title;
  private $description;

  public function getTitle()
  {
     return $this->title;
  }

  public function setTitle($title)
  {
    $this->title = $title;
  }

  public function getDescription()
  {
    return $this->description;
  }

  public function setDescription($description)
  {
    $this->description = $description;
  }

  public function createTask($data)
  { 
    $this->setCreateOrUpdate($data);

    $fields = [
      'title' => $this->getTitle(),
      'description' => $this->getDescription()
    ];
    
    return $this->curlCreate($fields);

  }

  public function listTask()
  {
    return json_decode($this->curlList());
  }

  public function showTask($id)
  {
    return json_decode($this->curlShow($id)); 
  }

  public function updateTask($data)
  { 
    $this->setCreateOrUpdate($data);

    $fields = [
      'title' => $this->getTitle(),
      'description' => $this->getDescription(),
      'id' => $data['id']
    ];
    
    return json_decode($this->curlUpdate($fields));

  }
  public function deleteTask($id)
  {
    return $this->curlDelete($id);
  }



  public function curlCreate($fields)
  {
    $init = curl_init('http://localhost:8000/api/create');
    return $this->curlPost($init, $fields);

  }

  public function curlList()
  {
    $url = 'http://localhost:8000/api/list';
    return $this->curlGet($url);

  }

  public function curlShow($id)
  {
    $url = "http://localhost:8000/api/show/$id";
    return $this->curlGet($url);

  }

  public function curlUpdate($fields)
  {
    $id = $fields[ 'id'];
    $init = curl_init("http://localhost:8000/api/update/$id");
    return $this->curlPost($init, $fields);
 
  }

  public function curlDelete($id)
  {
    $init = curl_init("http://localhost:8000/api/delete/$id");
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

  public function setCreateOrUpdate($data)
  {
    $this->setTitle($data['title']);
    $this->setDescription($data['description']);
  }

}
