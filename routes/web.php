<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController; // Ensure ProfileController is imported
use App\Http\Controllers\User\RequestController;
use App\Http\Controllers\User\UserHistoryController; // <<< NEW: Import UserHistoryController

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
})->name('welcome');

// Admin Routes (Protected by 'can:access-admin-area' middleware)
Route::middleware(['auth', 'can:access-admin-area'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    // Add other admin routes here later
});

// User Routes (Protected by 'auth' middleware)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); // This is "View Assigned Items"
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Asset Request Routes for Users (This is "Request New Asset")
    Route::prefix('user/requests')->name('user.requests.')->group(function () {
        Route::get('/', [RequestController::class, 'index'])->name('index'); // Catalog of requestable items
        Route::get('/create/{model}', [RequestController::class, 'create'])->name('create'); // Form to request a specific item
        Route::post('/', [RequestController::class, 'store'])->name('store'); // Store a new request
        Route::get('/status', [RequestController::class, 'status'])->name('status'); // View user's request statuses
        Route::delete('/{requestToCancel}/cancel', [RequestController::class, 'cancel'])->name('cancel'); // Cancel a pending request
    });

    // <<< NEW: User History Routes
    Route::prefix('user/history')->name('user.history.')->group(function () {
        Route::get('/', [UserHistoryController::class, 'index'])->name('index'); // "View Personal History"
    });
    // END NEW USER HISTORY ROUTES
});

require __DIR__.'/auth.php';
