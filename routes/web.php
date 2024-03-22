<?php

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

use App\Http\Controllers\UserController;
Route::get('/register', [UserController::class, 'showForm'])->name('register');
Route::post('/register', [UserController::class, 'createUser']);

Route::get('/', function () {
    return view('welcome');
});


use App\Http\Controllers\AdminController;
Route::get('/admin/create', [AdminController::class, 'showForm'])->name('admin.show_create_user_form');
Route::post('/admin/create', [AdminController::class, 'createUser'])->name('admin.create_user');
Route::get('admin/login', [AdminController::class, 'showFormLogin'])->name('login');
Route::post('admin/login', [AdminController::class, 'loginUser']);
