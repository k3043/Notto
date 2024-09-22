<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;




//auth
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
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
    
    //edit
    Route::get('/tasks/edit/{id}', [TaskController::class, 'showEditPage']);
    Route::post('/tasks/edit/{id}', [TaskController::class, 'update']);

    //delete
    Route::get('/tasks/delete/{id}', [TaskController::class, 'delete']);
});