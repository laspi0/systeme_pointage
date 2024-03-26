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
Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\UserController;
Route::get('/register', [UserController::class, 'showForm'])->name('register');
Route::post('/register', [UserController::class, 'createUser']);
Route::get('/login', [UserController::class, 'showFormLogin'])->name('login');
Route::post('/login', [UserController::class, 'loginUser']);

Route::get('/calendar', [UserController::class, 'showCalendar'])->name('calendar');
Route::put('/update-schedule', [UserController::class, 'updateSchedule'])->name('update-schedule');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');



use App\Http\Controllers\AdminController;

Route::get('/admin/create', [AdminController::class, 'showForm'])->name('admin.create_user');
// Traitement de la création d'utilisateur administrateur
Route::post('/admin/create', [AdminController::class, 'createUser']);

// Affichage du formulaire de connexion administrateur
Route::get('/admin/login', [AdminController::class, 'showFormLogin'])->name('admin.login');
// Traitement de la connexion administrateur
Route::post('/admin/login', [AdminController::class, 'loginAdmin']);

Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('admin/{user}', [AdminController::class, 'show'])->name('admin.show');
Route::delete('admin/{user}', [AdminController::class, 'destroy'])->name('admin.destroy');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/admin/salary/pdf/{id}', [AdminController::class, 'generateSalairePDF'])->name('admin.salaire.pdf');
