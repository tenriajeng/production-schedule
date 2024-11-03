<?php

use App\Http\Controllers\ProductionPlanController;
use App\Http\Controllers\ProductionScheduleController;
use App\Http\Controllers\ProfileController;
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


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(ProductionPlanController::class)->group(function () {
        Route::get('/', 'index')->name('production.plans.index');
    });

    Route::prefix('production-plans')->name('production.plans.')->group(function () {
        Route::controller(ProductionPlanController::class)->group(function () {
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{productionPlan}/edit', 'edit')->name('edit');
            Route::put('/{productionPlan}', 'update')->name('update');
            Route::delete('/{productionPlan}', 'destroy')->name('destroy');
        });
    });
});

require __DIR__ . '/auth.php';
