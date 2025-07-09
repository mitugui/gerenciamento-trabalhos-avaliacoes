<?php

use App\Http\Controllers\EventoController;
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

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/eventos', [EventoController::class, 'index'])->name('eventos.index');
    Route::get('/admin/eventos/create', [EventoController::class, 'create'])->name('eventos.create');
    Route::post('/admin/eventos', [EventoController::class, 'store'])->name('eventos.store');
    Route::get('/admin/eventos/{evento}/edit', [EventoController::class, 'edit'])->name('eventos.edit');
    Route::put('/admin/eventos/{evento}', [EventoController::class, 'update'])->name('eventos.update');
    Route::delete('/admin/eventos/{evento}', [EventoController::class, 'destroy'])->name('eventos.destroy');
});

Route::middleware(['auth', 'role:admin,professor'])->group(function () {
    Route::get('/eventos/{evento}/pdf', [EventoController::class, 'generatePdf'])->name('eventos.pdf');
});

Route::middleware(['auth', 'role:aluno,professor'])->group(function () {
    Route::get('/eventos', [EventoController::class, 'publicIndex'])->name('eventos.public');
});

Route::middleware(['auth', 'role:professor'])->group(function () {
    Route::get('/eventos/{evento}', [EventoController::class, 'show'])->name('eventos.show');
});

require __DIR__.'/auth.php';
