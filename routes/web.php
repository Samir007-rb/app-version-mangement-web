<?php

use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::resource('uploader', UploadController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('archives', ArchiveController::class);
    Route::get('archive/index/{id}', [ArchiveController::class, 'index'])->name('archives-index');
    Route::get('archives ? {project_id}', [ArchiveController::class, 'create'])->name('archives-create');
    Route::get('archive/{id}/edit ? {project_id}', [ArchiveController::class, 'edit'])->name('archives-edit');
    Route::post('/deleteFile',[ArchiveController::class,'deleteFile'])->name('archive.image.delete');
    Route::resource('tasks', TaskController::class);
    Route::get('tasks ? {project_id}', [TaskController::class, 'create'])->name('tasks-create');
    Route::get('task/index/{id}', [TaskController::class, 'index'])->name('tasks-index');
    Route::get('/logout', [LoginController::class, 'logout']);
});
