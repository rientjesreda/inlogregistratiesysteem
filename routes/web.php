<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\patientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TandartsController;
use App\Http\Controllers\assistentController;
use App\Http\Controllers\mondhygienistController;
use App\Http\Controllers\praktijkmanagementController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tandarts', [TandartsController::class, 'index'])->name('tandarts.index')
                                                             ->middleware(['auth', 'role:tandarts,praktijkmanagement']);

Route::get('/assistent', [assistentController::class, 'index'])->name('assistent.index')
                                                             ->middleware(['auth', 'role:assistent,praktijkmanagement']);

Route::get('/mondhygienist', [mondhygienistController::class, 'index'])->name('mondhygienist.index')
                                                             ->middleware(['auth', 'role:mondhygienist,praktijkmanagement']);
                                                             
Route::get('/praktijkmanagement', [praktijkmanagementController::class, 'index'])->name('praktijkmanagement.index')
                                                             ->middleware(['auth', 'role:praktijkmanagement']);

Route::get('/patient', [patientController::class, 'index'])->name('patient.index')
                                                             ->middleware(['auth', 'role:patient,praktijkmanagement']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
