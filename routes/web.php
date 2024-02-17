<?php
use App\Mail\CarMail;

use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\CarController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
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

Auth::routes(['verify'=>true]);
Route::prefix('/')->middleware('verified')->group(function () {
Route::get('/',[PublicController::class,'index'])->name('index');
Route::get('contact',[MessageController::class,'create'])->name('contact');
Route::post('contact',[MessageController::class,'store'])->name('contact');
Route::post('contact',[PublicController::class,'sendEmails'])->name('contact');
Route::get('testimonials',[PublicController::class,'testimonial'])->name('testimonials');
//Route::get('categories/{id}',[PublicController::class,'categories'])->name('categories');
Route::get('listing',[PublicController::class,'listing'])->name('listing');
Route::get('single/car/{id}', [CarController::class,'show'])->name('single.car');
Route::get('single/categories', [CategoryController::class,'showCategories'])->name('single.categories');
Route::get('about',[PublicController::class,'about'])->name('about');
    Route::get('blog',[CarController::class,'blog'])->name('blog');
  



  






Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});