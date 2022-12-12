<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\MarketPriceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

Route::name('front.')->controller(FrontController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/about', 'about')->name('about');
    Route::get('/services', 'services')->name('services');
    Route::get('/projects', 'projects')->name('projects');
    Route::get('/features', 'features')->name('features');
    Route::get('/team', 'team')->name('team');
    Route::get('/testimonial', 'testimonial')->name('testimonial');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/terms', 'terms')->name('terms');
    Route::get('/support', 'support')->name('support');
    Route::get('/market_rates', 'market_rates')->name('market_rates');
});
Route::middleware('guest')->group(function () {
    // Admin
    Route::prefix('arbyvestadministrativepanel')->name('admin.')->group(function () {
        Route::get('login', [AdminController::class, 'login'])->name('login');
        Route::post('login', [AdminController::class, 'do_login'])->name('do_login');
    });
    // User
    Route::prefix('app')->name('user.')->group(function () {
        Route::get('login', [UserController::class, 'login'])->name('login');
        Route::post('login', [UserController::class, 'do_login'])->name('do_login');
        Route::get('register', [UserController::class, 'register'])->name('register');
        Route::post('register', [UserController::class, 'do_register'])->name('do_register');
    });


    // Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
    //             ->name('password.request');

    // Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
    //             ->name('password.email');

    // Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
    //             ->name('password.reset');

    // Route::post('reset-password', [NewPasswordController::class, 'store'])
    //             ->name('password.store');
});

Route::middleware('auth')->group(function () {
    // Admin
    Route::middleware('admin')->prefix('arbyvestadministrativepanel')->name('admin.')->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('/logout', 'logout')->name('logout');
            Route::get('/', 'dashboard')->name('dashboard');
            Route::get('account', 'account')->name('account');
            Route::post('account', 'account_update')->name('account.update');
        });
        Route::controller(SettingController::class)->name('settings.')->group(function () {
            Route::get('settings', 'settings')->name('index');
            Route::post('settings', 'settings_update')->name('update');
            Route::post('update_logo_favicon', 'update_logo_favicon')->name('update_logo_favicon');
        });
        Route::resource('banks', BankController::class)->except('create', 'show');
        Route::resource('market_prices', MarketPriceController::class)->except('create', 'show');
    });
    // User
    Route::middleware('user')->prefix('app')->name('user.')->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('/logout', 'logout')->name('logout');
            Route::get('dashboard', 'dashboard')->name('dashboard');
            Route::get('market_rates', 'market_rates')->name('market_rates');
            Route::get('profile', 'profile_edit')->name('profile.edit');
            Route::patch('profile', 'profile_update')->name('profile.update');
        });
    });
});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
