<?php

namespace App\Http\Controllers;

use App\Exceptions\CreateDeniedException;
use App\Exceptions\DoNotExistsTasksException;
use App\Exceptions\UpdateDeniedException;
use Illuminate\Http\Request;
use App\Repositories\TaskRepository;


class TaskController extends Controller
{
    /**
    * @var TaskRepository
    */

    protected $repository;

    public function __construct(TaskRepository $repository)
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
            $result = $this->repository->showTasks($id);
            return response()->json($result);
        } catch (DoNotExistsTasksException $exception) {
            return response()->json(['errors' => ['main' => $exception->getMessage()]], $exception->getCode());
        }
    }
     
    public function create(Request $request)
    { 
        $this->validate($request, [
            'title' => 'required|max:100',
            'description' => 'required|max:255'        
        ]);

          $fields = $request->only(['title', 'description']);
 
        try {
            $this->repository->createTask($fields);
        } catch (CreateDeniedException $exception) {
            return response()->json(['errors' => ['main' => $exception->getMessage()]], $exception->getCode());
        }
    }

    public function update(Request $request, $id)
    { 
        $this->validate($request, [
            'title' => 'required|max:100',
            'description' => 'required|max:255'        
          ]);
    
        $fields = $request->only(['title', 'description']);

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
