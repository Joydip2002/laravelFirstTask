<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\demo;
use App\Http\Controllers\form;
use App\Http\Controllers\scontroller;
use App\Http\Controllers\FromController;
use App\Http\Controllers\ExcelController;
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

// Route::view('/','tabularForm');
// Route::post('/submit-form',[FromController::class,'submitForm'])->name('submit-form');

// Route::get('/',function(){
//     return view('fetchExcelDataInsertDb');
// });

Route::get('/',[ExcelController::class,'submitExcel']);
Route::get('/studentview',[ExcelController::class,'view']);
Route::get('/studentview/trash',[ExcelController::class,'trash']);
Route::post('/import-data',[ExcelController::class,'upload']);

Route::get('/sortById/{type}',[ExcelController::class,'sortById'])->name('sortById');
Route::get('/sortByName/{type}',[ExcelController::class,'sortByName'])->name('sortByName');
Route::get('/sortByEmail/{type}',[ExcelController::class,'sortByEmail'])->name('sortByEmail');
Route::get('/sortByAddress/{type}',[ExcelController::class,'sortByAddress'])->name('sortByAddress');

Route::get('/studentview/edit/{id}',[ExcelController::class,'edit'])->name('student-edit');
Route::get('/studentview/restore/{id}',[ExcelController::class,'restore'])->name('student-restore');
Route::get('/studentview/forcedelete/{id}',[ExcelController::class,'forcedelete'])->name('student-force-delete');
Route::patch('/studentview/update/{id}',[ExcelController::class,'update'])->name('student-update');
Route::view('/studentedit','studentedit');

Route::get('/studentview/delete/{id}',[ExcelController::class,'delete'])->name('student-delete');
Route::get('/student-delete',[ExcelController::class,'deletebulk'])->name('studentsoft-delete');

Route::get('/studentview/active', [ExcelController::class, 'updateStatus'])->name('student-active-status');
Route::get('/studentview/inactive', [ExcelController::class, 'inactiveupdateStatus'])->name('student-inactive-status');
Route::get('/studentview/status/{id}',[ExcelController::class,'changeStatusUsingBtn'])->name('change-status');




