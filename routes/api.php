<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToDoController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Todo Resources
Route::get('/todos', [TodoController::class,'index'])->name('todos');
Route::post('/todo/add/', [TodoController::class,'store'])->name('todos.store');
Route::post('/todo/update/{id}', [TodoController::class, 'update'])->name('todos.update');
Route::post('/todo/delete/{id}', [TodoController::class, 'destroy'])->name('todos.destroy');