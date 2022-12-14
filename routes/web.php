<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\ContentPageController;
use App\Http\Controllers\DocumentTypeController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\MarketPriceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReferralWithdrawController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WithdrawController;
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
            Route::get('user_transfer_balance_logs', 'user_transfer_balance_logs')->name('user_transfer_balance_logs');
        });
        Route::controller(SettingController::class)->name('settings.')->group(function () {
            Route::get('settings', 'settings')->name('index');
            Route::post('settings', 'settings_update')->name('update');
            Route::post('update_logo_favicon', 'update_logo_favicon')->name('update_logo_favicon');
        });
        Route::controller(AdminUserController::class)->name('users.')->group(function() {
            Route::get('make-vendor/{id}', 'makeVendor')->name('make-vendor');
            Route::post('verify_account', 'do_verify_account')->name('verify_account');
            Route::get('kyc_index', 'kyc_index')->name('kyc_index');
            Route::get('user/{id}/kyc_info', 'kyc_info')->name('kyc_info');
        });
        Route::controller(WithdrawController::class)->prefix('withdraws')->name('withdraws.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('unpaid', 'unpaid')->name('unpaid');
            Route::get('approved', 'approved')->name('approved');
            Route::get('declined', 'declined')->name('declined');
            Route::get('decline/{id}', 'decline')->name('decline');
            Route::post('approve', 'approve')->name('approve');
            Route::get('delete/{id}', 'delete')->name('delete');
        });
        Route::controller(ReferralWithdrawController::class)->prefix('referral_withdraws')->name('referral_withdraws.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('unpaid', 'unpaid')->name('unpaid');
            Route::get('approved', 'approved')->name('approved');
            Route::get('declined', 'declined')->name('declined');
            Route::get('decline/{id}', 'decline')->name('decline');
            Route::post('approve', 'approve')->name('approve');
            Route::get('delete/{id}', 'delete')->name('delete');
        });
        Route::controller(ContentPageController::class)->prefix('content_pages')->name('content_pages.')->group(function() {
            Route::get('edit/{page}', 'edit')->name('edit');
            Route::post('update/{page}', 'update')->name('update');

        });
        Route::resource('banks', BankController::class)->except('create', 'show');
        // Route::resource('content_pages', ContentPageController::class)->except('show', 'index');
        Route::resource('market_prices', MarketPriceController::class)->except('create', 'show');
        Route::resource('roles', RoleController::class)->except('create', 'show', 'delete');
        Route::resource('users', AdminUserController::class)->except('create', 'show', 'delete');
        Route::resource('document_types', DocumentTypeController::class)->except('create', 'show');
    });
    // User
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    // Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
    //             ->name('password.confirm');

    // Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    // Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::middleware('user')->prefix('app')->name('user.')->group(function () {
        Route::get('/logout', [UserController::class, 'logout'])->name('logout');
        Route::middleware('verified')->group(function() {
            Route::controller(UserController::class)->group(function () {
                Route::get('dashboard', 'dashboard')->name('dashboard');
                Route::get('market_rates', 'market_rates')->name('market_rates');
                Route::get('fund_wallet', 'fund_wallet')->name('fund_wallet');
                Route::get('verify_trader', 'verify_trader')->name('trader.verify');
                Route::post('verify_trader', 'do_verify_trader')->name('trader.do_verify');
                Route::get('transfer_balance', 'transfer_balance')->name('transfer_balance');
                Route::post('transfer_balance', 'do_transfer_balance')->name('do_transfer_balance');
                Route::get('change_pin', 'change_pin')->name('change_pin');
                Route::post('change_pin', 'do_change_pin')->name('do_change_pin');
                Route::get('withdraw', 'withdraw')->name('withdraw');
                Route::post('withdraw', 'do_withdraw')->name('do_withdraw');
                Route::get('withdraw_referral', 'withdraw_referral')->name('withdraw_referral');
                Route::post('withdraw_referral', 'do_withdraw_referral')->name('do_withdraw_referral');
                Route::get('sell_to_blackmarket', 'sell_to_blackmarket')->name('sell_to_blackmarket');
                Route::post('sell_to_blackmarket', 'do_sell_to_blackmarket')->name('do_sell_to_blackmarket');
                Route::post('get_amount_exchanged', 'get_amount_exchanged')->name('get_amount_exchanged');
                Route::get('upload_proof', 'upload_proof')->name('upload_proof');
                Route::get('thankyou', 'thankyou')->name('thankyou');
                Route::get('referral', 'referral')->name('referral');
                Route::get('exclusive_offers', 'exclusive_offers')->name('exclusive_offers');
            });
            Route::controller(ProfileController::class)->group(function () {
                Route::get('profile', 'edit')->name('profile.edit');
                Route::patch('profile', 'update')->name('profile.update');
                Route::get('bank_details', 'create_bank_details')->name('create_bank_details');
                Route::get('bank_details/{id}', 'edit_bank_details')->name('edit_bank_details');
                Route::post('bank_details', 'store_bank_details')->name('store_bank_details');
                Route::patch('bank_details/{id}', 'update_bank_details')->name('update_bank_details');
                Route::middleware('is_not_verified')->group(function () {
                    Route::get('verify_account', 'verify_account')->name('verify_account');
                    Route::post('verify_account', 'do_verify_account')->name('do_verify_account');
                });
            });
        });
    });
});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
