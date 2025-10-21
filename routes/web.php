<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Models\Categorie;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Route;

//Auth middleware
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/', function () {
        $users = User::count();
        $categories = Categorie::count();
        $tasks = Task::count();
        return view('Dashboard', compact('users', 'categories', 'tasks'));
    })->name('Dashboard');

    // Users
    Route::resource('users', UserController::class);

    // Tasks
    Route::resource('tasks', TaskController::class)
        ->middleware('role:manager,admin');


    Route::middleware('role:manager,admin,user')->group(function () {
        Route::get('myTasks/{id}', [TaskController::class, 'myTasks'])->name('myTasks');
    });

    // Categories
    Route::middleware('role:manager,admin')->group(function () {
        Route::resource('categories', CategorieController::class)->except(['index', 'show']);
    });

    Route::middleware('role:manager,admin,user')->group(function () {
        Route::resource('categories', CategorieController::class)->only(['index', 'show']);
    });

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Auth routes (hors du middleware 'auth')
Route::middleware('guest')->controller(AuthController::class)->group(function () {
    Route::get('/login', 'Login')->name('login');
    Route::post('/login', 'LoginStore')->name('LoginStore');
    Route::get('/signup', 'SignUp')->name('signup');
    Route::post('/signup', 'SignUpStore')->name('SignUpStore');
    Route::get('/forgotPassword', 'ForgotPassword')->name('forgotPassword');
    Route::post('/forgotPassword', 'ForgotPasswordStore')->name('ForgotPasswordStore');
    Route::get('/resetPassword/{token}', 'ResetPassword')->name('password.reset');
    Route::post('/resetPassword', 'ResetPasswordStore')->name('password.update');;
});
