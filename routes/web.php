<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RegistrationsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/landingpage', function () {
    return Inertia::render('Landingpage');
});

Route::get('/test', function () {
    return Inertia::render('Test');
});


Route::middleware('auth:sanctum')->get('/items', [ItemController::class, 'index']);
Route::middleware('auth:sanctum')->put('/items/{id}/approve', [ItemController::class, 'approve']);
Route::middleware('auth:sanctum')->put('/items/{id}/reject', [ItemController::class, 'reject']);


Route::middleware('auth:sanctum')->get('/registrations', [RegistrationsController::class, 'index']);


require __DIR__.'/auth.php';
