<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskSubGroupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/list', [TaskController::class, 'list'])->name('listTasks');
Route::get('/show/{id}', [TaskController::class, 'show'])->name('showTasks');
Route::post('/create', [TaskController::class, 'create'])->name('createTask');
Route::post('/update/{id}', [TaskController::class, 'update'])->name('updateTask');
Route::post('/delete/{id}', [TaskController::class, 'delete'])->name('deleteTask');
    
Route::get('/listSub', [TaskSubGroupController::class, 'list'])->name('listSubTasks');
Route::get('/showSub/{id}', [TaskSubGroupController::class, 'show'])->name('showSubTasks');
Route::post('/createSub', [TaskSubGroupController::class, 'create'])->name('createSubTask');
Route::post('/updateSub/{id}', [TaskSubGroupController::class, 'update'])->name('updateSubTask');
Route::post('/deleteSub/{id}', [TaskSubGroupController::class, 'delete'])->name('deleteSubTask');
