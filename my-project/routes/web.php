<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstallerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\ReelController;
use App\Http\Controllers\AdController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StripeWebhookController;
use App\Http\Controllers\Admin\SubscriptionAdminController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\AdAdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/welcome', function () { return view('welcome'); });

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');
Route::get('/dashboard', [ProfileController::class, 'index'])->middleware('auth')->name('dashboard');

// Installer
Route::get('/install', [InstallerController::class, 'show']);
Route::post('/install', [InstallerController::class, 'install']);

// Home actions
Route::post('/fetch-extreme', [HomeController::class, 'fetchByExtremeCode']);
Route::post('/fetch-matches', [HomeController::class, 'fetchMatchesFromSite']);

// Resources
Route::get('/channels', [ChannelController::class, 'index']);
Route::get('/channels/{channel}', [ChannelController::class, 'show']);

Route::get('/matches', [MatchController::class, 'index']);
Route::get('/matches/{match}', [MatchController::class, 'show']);

Route::get('/reels', [ReelController::class, 'index']);
Route::post('/reels', [ReelController::class, 'store']);
Route::get('/reels/{reel}', [ReelController::class, 'show']);

Route::get('/ads', [AdController::class, 'index']);
Route::post('/ads', [AdController::class, 'store']);

// Subscriptions & Payments
Route::get('/subscriptions', [SubscriptionController::class, 'index']);
Route::post('/subscriptions/checkout/{subscription}', [SubscriptionController::class, 'checkout']);
Route::get('/subscriptions/success', [SubscriptionController::class, 'success']);

// Stripe webhook
Route::post('/webhook/stripe', [StripeWebhookController::class, 'handle']);

// Admin routes
Route::prefix('admin')->middleware(['auth', \App\Http\Middleware\IsAdmin::class])->group(function () {
	Route::get('/', function(){ return redirect('/admin/subscriptions'); });
	Route::get('/subscriptions', [SubscriptionAdminController::class, 'index']);
	Route::get('/subscriptions/create', [SubscriptionAdminController::class, 'create']);
	Route::post('/subscriptions', [SubscriptionAdminController::class, 'store']);
	Route::get('/subscriptions/{subscription}/edit', [SubscriptionAdminController::class, 'edit']);
	Route::post('/subscriptions/{subscription}', [SubscriptionAdminController::class, 'update']);
	Route::post('/subscriptions/{subscription}/delete', [SubscriptionAdminController::class, 'destroy']);
	Route::get('/users', [UserAdminController::class, 'index']);
	Route::post('/users/{user}/toggle-admin', [UserAdminController::class, 'toggleAdmin']);
	Route::post('/users/{user}/delete', [UserAdminController::class, 'destroy']);
	Route::get('/ads', [AdAdminController::class, 'index']);
	Route::get('/ads/create', [AdAdminController::class, 'create']);
	Route::post('/ads', [AdAdminController::class, 'store']);
	Route::get('/ads/{ad}/edit', [AdAdminController::class, 'edit']);
	Route::post('/ads/{ad}', [AdAdminController::class, 'update']);
	Route::post('/ads/{ad}/delete', [AdAdminController::class, 'destroy']);
});

