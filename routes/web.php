<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\security\role\RoleController;
use App\Http\Controllers\staff\occupation\OccupationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('occupation', [OccupationController::class, 'index'])->name('staff.occupation.index')->middleware('auth');


//Ruta al index de role
Route::get('roles', [RoleController::class, 'index'])->name('security.role.index')->middleware('auth');

require __DIR__.'/auth.php';
