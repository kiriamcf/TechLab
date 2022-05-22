<?php

use App\Http\Controllers\MachineController;
use App\Http\Controllers\ReservationController;
use App\Models\Reservation;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\PostDec;

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


Route::redirect("/", "/app");
Route::middleware('auth')->prefix('/app')->group(function () {
    Route::get('/', [MachineController::class, 'index'])->name('dashboard');
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations');
    Route::get('/machine/{machine}', [MachineController::class, 'show'])->name('machine.show');
    Route::post('/machine/{machine}', [ReservationController::class, 'store'])->name('reservation.show');
    Route::post('/machine/{machine}/json', [ReservationController::class, 'show_reserved_hours'])->name('reservation.show_reserved_hours');
});

require __DIR__.'/auth.php';
