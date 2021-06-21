<?php

namespace App\Http\Controllers;

use App\Exceptions\CreateDeniedException;
use App\Exceptions\DoNotExistsTasksException;
use App\Exceptions\UpdateDeniedException;
use App\Repositories\TaskSubGroupRepository;
use Illuminate\Http\Request;

class TaskSubGroupController extends Controller
{
     /**
    * @var TaskSubGroupRepository
    */

    protected $repository;

    public function __construct(TaskSubGroupRepository $repository)
    {
      $this->repository = $repository;
    }

    public function list()
    { 
        try {
            $result = $this->repository->listTasks();
            return response()->json($result);
        } catch (DoNotExistsTasksException $exception) {
            return response()->json(['errors' => ['main' => $exception->getMessage()]], $exception->getCode());
        }
    }

    public function show($id)
    {
        try {
            $result = $this->repository->showSubTasks($id);
            return response()->json($result);
        } catch (DoNotExistsTasksException $exception) {
            return response()->json(['errors' => ['main' => $exception->getMessage()]], $exception->getCode());
        }
    }
     
    public function create(Request $request)
    { 
        $this->validate($request, [
            'title' => 'required|max:100',
            'description' => 'required|max:255',
            'task_id' => 'required|numeric',       
            'important' => 'required|numeric',       
            'estimated_time' => 'required|numeric'       
        ]);


        $fields = $request->only(['title', 'description', 'task_id', 'important', 'estimated_time']);

        try {
            $this->repository->createTask($fields);
        } catch (CreateDeniedException $exception) {
            return response()->json(['errors' => ['main' => $exception->getMessage()]], $exception->getCode());
        }
    }

    public function update(Request $request, $id)
    { 
  
        $fields = $request->only(['title', 'description', 'important', 'estimated_time']);

        try {
            $this->repository->updateTask($fields, $id);
        } catch (UpdateDeniedException $exception) {
            return response()->json(['errors' => ['main' => $exception->getMessage()]], $exception->getCode());
        }
    }

    public function delete($id)
    { 
        try {
            $this->repository->deleteTask($id);
        } catch (DoNotExistsTasksException $exception) {
            return response()->json(['errors' => ['main' => $exception->getMessage()]], $exception->getCode());
        }
    }
}
