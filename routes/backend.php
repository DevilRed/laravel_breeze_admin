<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;

// require __DIR__.'/auth.php';
Route::middleware(['auth', 'admin'])->group(function () {
    Route::group([
        'middleware' => ['auth', 'role:admin|staff|super-admin'],
    ], function() {
        Route::get('dashboard', [DashboardController::class, 'render'])->name('dashboard');
    });
});
