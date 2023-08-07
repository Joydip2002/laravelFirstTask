<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\demo;
use App\Http\Controllers\form;
use App\Http\Controllers\scontroller;
use App\Http\Controllers\FromController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get("/test",function(){
//     echo "Test Page";
// });

// Route::get('/test2/{name}/{id?}',function($name,$id = null){
//     // echo view('form');
//     // echo $name." ".$id;
//     $data = compact('name','id');
//     // print_r($data);
//     return view('welcome')->with($data);
// });

// Route::get('/form',function(){
//     return view('form');
// });
// Route::get("/about",function(){
//     return view('about');
// });

// ----------------------------
// Basic Controller
// Route::get('/',[demo::class,'index']);
// Route::get('/form',[form::class,'form']);
// Route::post('/register',[form::class,'register']);


// Single Action Controller
// Route::get('/form',scontroller::class);


// Resource Controller
// Route::get('/form',class_name::class)  //not created just for remind

Route::view('/','tabularForm');
Route::post('/submit-form',[FromController::class,'submitForm'])->name('submit-form');

