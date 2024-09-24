<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;

//auth
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('login/{provider}', [AuthController::class, 'redirectToProvider']);
Route::get('callback/{provider}', [AuthController::class, 'handleProviderCallback']);
Route::middleware('web')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
 });
Route::get('login', function () {
    return view('auth.login');
})->name('login');
Route::get('register', function () {
    return view('auth.register');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', [TaskController::class, 'index']);
    //create task
    Route::get('/createTask',function () {
        return view('createTask');
    });
    Route::post('/tasks/store', [TaskController::class, 'store']);
    
    //edit task
    Route::get('/tasks/edit/{id}', [TaskController::class, 'showEditPage']);
    Route::post('/tasks/edit/{id}', [TaskController::class, 'update']);

    //delete task
    Route::delete('/tasks/delete/{id}', [TaskController::class, 'delete']);

    //show list of tasks
    Route::get('/tasks', [TaskController::class, 'showList']);

    //status for tasks
    Route::post('/tasks/markAsDone/{id}', [TaskController::class, 'markAsDone']);
    Route::post('/tasks/markAsUnfinished/{id}', [TaskController::class, 'markAsUnfinished']);

    //đang phát triển
    Route::get('/createAppointment', [TaskController::class, 'showCreateAppointment']);
    Route::get('/createEvent', [TaskController::class, 'showCreateEvent']);
});