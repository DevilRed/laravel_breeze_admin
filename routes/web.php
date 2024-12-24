<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\RoomController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ReservationController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('rooms', RoomController::class);

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/rooms/{id}', [RoomController::class, 'view'])->name('rooms.view');
Route::get('/book/{room}', ReservationController::class)->name('reservation.book');
Route::post('/book/{room}', [ReservationController::class, 'store'])->name('reservation.store');
