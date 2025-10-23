<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Mail\MyEmail;
use App\Models\Categorie;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Mailjet\Client;
use Mailjet\Resources;

// Auth + verified users routes
Route::middleware(['auth', 'verified'])->group(function () {

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

//No Auth routes (les invités / guests)
Route::middleware('guest')->controller(AuthController::class)->group(function () {
    Route::get('/login', 'Login')->name('login');
    Route::post('/login', 'LoginStore')->name('LoginStore');
    Route::get('/signup', 'SignUp')->name('signup');
    Route::post('/signup', 'SignUpStore')->name('SignUpStore');
    Route::get('/forgotPassword', 'ForgotPassword')->name('forgotPassword');
    Route::post('/forgotPassword', 'ForgotPasswordStore')->name('ForgotPasswordStore');
    Route::get('/resetPassword/{token}', 'ResetPassword')->name('password.reset');
    Route::post('/resetPassword', 'ResetPasswordStore')->name('password.update');
});

// Routes verification d'email
Route::middleware('auth')->group(function () {

    // verification notice page
    Route::get('/email/verify', function () {
        return view('Auth.verify-email');
    })->name('verification.notice');

    // link de verification
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/')->with('success', 'Email verified successfully!');
    })->middleware(['auth', 'signed'])->name('verification.verify');

    // resend verification link
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
});

Route::get('/send-mailjet-api', function () {
    $mj = new Client(env('MAIL_USERNAME'), env('MAIL_PASSWORD'), true, ['version' => 'v3.1']);
    
    $body = [
        'Messages' => [
            [
                'From' => [
                    'Email' => "no-reply@todo-app.com",
                    'Name' => "TODO_APP"
                ],
                'To' => [
                    [
                        'Email' => "salahlsh4@gmail.com",
                        'Name' => "Salah"
                    ]
                ],
                'Subject' => "Test Email via Mailjet API",
                'TextPart' => "Salut Salah, ceci est un test depuis Mailjet API!",
                'HTMLPart' => "<h3>Salut Salah</h3><p>Ceci est un test depuis Mailjet API!</p>"
            ]
        ]
    ];
    
    $response = $mj->post(Resources::$Email, ['body' => $body]);
    
    return $response->success() ? 'Email sent ✅' : 'Error ❌';
});

Route::get('/mail-config', function () {
    return [
        'MAIL_MAILER' => config('mail.default'),
        'MAIL_HOST' => config('mail.mailers.smtp.host'),
        'MAIL_PORT' => config('mail.mailers.smtp.port'),
        'MAIL_USERNAME' => config('mail.mailers.smtp.username'),
        'MAIL_ENCRYPTION' => config('mail.mailers.smtp.encryption'),
        'MAIL_FROM' => config('mail.from'),
    ];
});
