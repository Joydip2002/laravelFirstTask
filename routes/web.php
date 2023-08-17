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

Route::get('/submitExcel',[ExcelController::class,'submitExcel'])->middleware('isLogin');
Route::get('/studentview',[ExcelController::class,'view'])->middleware('isLogin');
Route::get('/studentview/trash',[ExcelController::class,'trash'])->middleware('isLogin');
Route::post('/import-data',[ExcelController::class,'upload']);

Route::get('/sortById/{type}',[ExcelController::class,'sortById'])->name('sortById');
Route::get('/sortByName/{type}',[ExcelController::class,'sortByName'])->name('sortByName');
Route::get('/sortByEmail/{type}',[ExcelController::class,'sortByEmail'])->name('sortByEmail');
Route::get('/sortByAddress/{type}',[ExcelController::class,'sortByAddress'])->name('sortByAddress');

Route::get('/studentview/edit/{id}',[ExcelController::class,'edit'])->name('student-edit')->middleware('isLogin');
Route::get('/studentview/restore/{id}',[ExcelController::class,'restore'])->name('student-restore');
Route::get('/studentview/forcedelete/{id}',[ExcelController::class,'forcedelete'])->name('student-force-delete');
Route::patch('/studentview/update/{id}',[ExcelController::class,'update'])->name('student-update');
Route::view('/studentedit','studentedit')->middleware('isLogin');

Route::get('/studentview/delete/{id}',[ExcelController::class,'delete'])->name('student-delete');
Route::get('/student-delete',[ExcelController::class,'deletebulk'])->name('studentsoft-delete')->middleware('isLogin');

Route::get('/studentview/active', [ExcelController::class, 'updateStatus'])->name('student-active-status');
Route::get('/studentview/inactive', [ExcelController::class, 'inactiveupdateStatus'])->name('student-inactive-status');
Route::get('/studentview/status/{id}',[ExcelController::class,'changeStatusUsingBtn'])->name('change-status');

Route::get('/',[ExcelController::class,'loginPage'])->name('login-page')->middleware('isLoggedin');
Route::post('/euser-login',[ExcelController::class,'eloginuser'])->name('elogin-user');

Route::get('/signup',[ExcelController::class,'signupPage'])->name('signup-page')->middleware('isLoggedin');
Route::post('/signup-user',[ExcelController::class,'signupuser'])->name('signup-user');

Route::get('/logout',[ExcelController::class,'logout'])->name('logout');


// Upload Multiple Image
Route::get('/mulImage',[ExcelController::class,'uploadImage'])->name('mul-image-upload'); 
Route::post('/multipleImageupload',[ExcelController::class,'importMulImage'])->name('import-image'); 
Route::get('/show-image',[ExcelController::class,'showImage'])->name('/show-image'); 


Route::get('/forgot-password',[ExcelController::class,'forgotPassword'])->name('forgot-password'); 
Route::post('/forgot-password-page',[ExcelController::class,'forgotPasswordPage'])->name('forgot-password-page'); 

Route::get('/reset-password/{id}/',[ExcelController::class,'resetPassword'])->name('reset-password');
Route::post('/reset-password-page/{id}',[ExcelController::class,'resetPasswordPage'])->name('reset-password-page');











// Route Grouping 
// Route::prefix('studentview')->group(function(){
//     Route::get('/trash',[ExcelController::class,'trash']);
//     Route::get('/active', [ExcelController::class, 'updateStatus'])->name('student-active-status');
//     Route::get('/inactive', [ExcelController::class, 'inactiveupdateStatus'])->name('student-inactive-status');
//     Route::get('/status/{id}',[ExcelController::class,'changeStatusUsingBtn'])->name('change-status');
// });


