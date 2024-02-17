<?php
use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;




Auth::routes(['auth'=>true]);
Route::prefix('admin')->middleware(['auth','active'])->group(function () {


//cars
Route::get('cars',[CarController::class,'index'])->name('cars');
Route::get('addcar',[CarController::class,'create'])->name('addcar');
Route::get('editcar/{id}',[CarController::class,'edit'])->name('editcar');
Route::put('updatecar/{id}',[CarController::class,'update'])->name('updatecar');
Route::get('createcar',[CarController::class,'create'])->name('createcar');
Route::post('storecar',[CarController::class,'store'])->name('storecar');
Route::get('deletecar/{id}',[CarController::class,'destroy'])->name('deletecar');

    //testimonial
Route::get('testimonial',[TestimonialController::class,'index'])->name('testimonial');
Route::get('addtestimonial',[TestimonialController::class,'create'])->name('addtestimonial');
Route::get('edittestimonial/{id}',[TestimonialController::class,'edit'])->name('edittestimonial');
Route::put('updatetestimonial/{id}',[TestimonialController::class,'update'])->name('updatetestimonial');
Route::post('storetestimonial',[TestimonialController::class,'store'])->name('storetestimonial');
Route::get('deletetestimonial/{id}',[TestimonialController::class,'destroy'])->name('deletetestimonial');
// categories
Route::get('categories',[CategoryController::class,'index'])->name('categories');
Route::get('addcategory',[CategoryController::class,'create'])->name('addcategory');
Route::get('editcategory/{id}',[CategoryController::class,'edit'])->name('editcategory');
Route::put('updatecategory/{id}',[CategoryController::class,'update'])->name('updatecategory');
Route::get('createcat',[CategoryController::class,'create'])->name('createcat');
Route::post('storecat',[CategoryController::class,'store'])->name('storecat');
Route::get('deletecat/{id}',[CategoryController::class,'destroy'])->name('deletecat');
//users
Route::get('users',[UserController::class,'index'])->name('users');
Route::get('adduser',[UserController::class,'create'])->name('adduser');
Route::post('adduser',[UserController::class,'store'])->name('adduser');
Route::get('edituser/{id}',[UserController::class,'edit'])->name('edituser');
Route::put('updateuser/{id}',[UserController::class,'update'])->name('updateuser');

Route::get('deleteuser/{id}',[UserController::class,'destroy'])->name('deleteuser');
// messages
Route::get('messages',[MessageController::class,'index'])->name('messages');
Route::post('storemessage',[MessageController::class,'store'])->name('storemessage');
Route::get('deletemessage/{id}',[MessageController::class,'destroy'])->name('deletemessage');
Route::get('showmsg/{id}',[MessageController::class,'show'])->name('showmsg');
Route::get('/messages/{id}', 'PublicController@show')->name('messages.show');
//Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
