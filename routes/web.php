<?php

use App\Http\Controllers\hellowworldcontroller;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


/*Esto es la práctica de mi hello world pasando variables
Route::get('/hello-world', function(){
    return view('hello-world',[
        'name' => 'Brahim',
    ]);
});
*/
//Hello world usando controlador
//Route::get('/hello-world', [hellowworldcontroller::class,'index']);


//ruta para probar el nuevo layout
/*
Route::get('layout',function(){
    return view('hello-world');
});*/
Route::get("/tasks", [TaskController::class,'index'])->name('tasks.index') ;
Route::get('tasks/create', [TaskController::class,'create'])-> name('tasks.create');
Route::post('tasks', [TaskController::class,'store'])-> name('tasks.store');
Route::get('tasks/{task}/edit', [TaskController::class,'edit'])->name('tasks.edit');
Route::put('tasks/{task}',[TaskController::class, 'update'])->name('tasks.update');
Route::patch("tasks/{task}/toggle", [TaskController::class, "toggle"])->name("tasks.toggle");
Route::delete("tasks/{task}", [TaskController::class, "destroy"])->name("tasks.destroy");
