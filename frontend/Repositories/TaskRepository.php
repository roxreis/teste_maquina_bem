<?php 

namespace frontend\repositories;

  class TaskRepository
  {

    public static function create($fields)
    {
      $init = curl_init('http://localhost:8000/api/create');
      curl_setopt($init, CURLOPT_POST, true);
      curl_setopt($init, CURLOPT_POSTFIELDS, $fields);
      curl_exec($init);
      curl_close($init);
    }







  }