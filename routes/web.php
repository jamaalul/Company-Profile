<?php

use App\Models\Department;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MarketplaceController;

Route::middleware('guest')->group(function () {
    // Login
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    // Logout
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// News Routes
Route::prefix('news')->name('news.')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('index');
    Route::get('/{news}', [NewsController::class, 'show'])->name('show');
});

Route::get('/about-us', function () {
    $departments = Department::all(); // Mengambil semua data departemen
    return view('about-us', compact('departments')); // Mengirim data ke view
});

Route::get('/about-us/{department:slug}', [DepartmentController::class, 'showDetail'])->name('departments.showDetail');

// Portal HIMTI Routes
Route::prefix('portal')->name('portal.')->group(function () {
    Route::get('/', [PortalController::class, 'index'])->name('index');
    Route::get('/{news}', [PortalController::class, 'show'])->name('show');
});

// Marketplace Routes
Route::prefix('marketplace')->name('marketplace.')->group(function () {
    Route::get('/', [MarketplaceController::class, 'index'])->name('index')->middleware('throttle:60,1');
    Route::get('/track/{token}', [MarketplaceController::class, 'track'])->name('track')->middleware('throttle:30,1');
    Route::get('/{product}', [MarketplaceController::class, 'show'])->name('show');
    Route::get('/{product}/purchase', [MarketplaceController::class, 'purchaseForm'])->name('purchase.form');
    Route::post('/purchase', [MarketplaceController::class, 'purchase'])->name('purchase');
    Route::get('/bundle/{bundle}', [MarketplaceController::class, 'showBundle'])->name('bundle.show');
    Route::get('/bundle/{bundle}/purchase', [MarketplaceController::class, 'purchaseBundleForm'])->name('bundle.purchase.form');
    Route::post('/bundle/purchase', [MarketplaceController::class, 'purchaseBundle'])->name('bundle.purchase');
    Route::get('/order-success/{orderNumber}', [MarketplaceController::class, 'orderSuccess'])->name('order.success');
});

// Payment Routes
Route::prefix('payment')->name('payment.')->group(function () {
    Route::get('/{order}/process', [PaymentController::class, 'process'])->name('process');
    Route::post('/callback', [PaymentController::class, 'callback'])->name('callback');
    Route::get('/{order}/success', [PaymentController::class, 'success'])->name('success');
});

Route::get('/sop/partnership', function () {
    return view('coming-soon');
});

Route::get('/sop/medinfo', function () {
    return view('sop.medinfo');
});

Route::get('/coming', function () {
    return view('coming-soon');
});

// Auth Routes
// require __DIR__.'/auth.php';

// Admin routes have been removed

// Route::fallback(function () {
//     return view('coming-soon');
// });