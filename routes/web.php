<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [TaskController::class, 'index'])->name('task.index');
Route::post('/tasks/update-order', [TaskController::class, 'updateOrder'])->name('task.updateOrder');
Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('task.destroy');
