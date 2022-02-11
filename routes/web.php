<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\QuizController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['prefix'=>'admin/dashboard','middleware'=>['admin','auth'],'namespace'=>'admin'],function(){
    Route::get('home', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('video/upload', [VideoController::class, 'create'])->name('add.video');
    Route::post('video/insert', [VideoController::class, 'store'])->name('insert.video');
    Route::get('Quizs/create', [QuizController::class, 'create'])->name('add.quiz');
    Route::post('Quizs/upload', [QuizController::class, 'store'])->name('create.question');
});



Route::group(['prefix'=>'user/dashboard','middleware'=>['user','auth'],'namespace'=>'user'],function(){
    Route::get('home', [UserController::class, 'index'])->name('user.dashboard');
    Route::post('profile/update{id}', [RegisteredUserController::class, 'profileUpdate'])->name('profile.update');
});
