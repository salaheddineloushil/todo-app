<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Models\Categorie;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;



// Auth + verified users routes
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/', function () {
        $users = User::count();
        $categories = Categorie::count();
        $tasks = Task::count();
        return view('Dashboard', compact('users', 'categories', 'tasks'));
    })->name('Dashboard');

    // Users
    Route::resource('users', UserController::class)->middleware('role:manager:admin');

    Route::middleware('role:manager,admin,user')->group(function () {
        Route::resource('users', UserController::class)->only('show');
    });

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

//No Auth routes (les invités / guests)
Route::middleware('guest')->controller(AuthController::class)->group(function () {
    Route::get('/login', 'Login')->name('login');
    Route::post('/login', 'LoginStore')->name('LoginStore');
    Route::get('/signup', 'SignUp')->name('signup');
    Route::post('/signup', 'SignUpStore')->name('SignUpStore');
    // Route::get('/forgotPassword', 'ForgotPassword')->name('forgotPassword');
    // Route::post('/forgotPassword', 'ForgotPasswordStore')->name('ForgotPasswordStore');
    // Route::get('/resetPassword/{token}', 'ResetPassword')->name('password.reset');
    // Route::post('/resetPassword', 'ResetPasswordStore')->name('password.update');
});

// // صفحة تأكيد الايميل
// Route::get('/email/verify', function () {
//     return view('auth.verify-email');
// })->middleware('auth')->name('verification.notice');

// // تأكيد الايميل من اللينك
// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();
//     return redirect('/home'); // redirect بعد verification
// })->middleware(['auth', 'signed'])->name('verification.verify');

// // إعادة إرسال لينك التحقق
// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();
//     return back()->with('resent', true);
// })->middleware(['auth', 'throttle:6,1'])->name('verification.resend');