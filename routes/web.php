<?php

use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrabalhoController;
use App\Models\Avaliacao;
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
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

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

    Route::get('/admin/professores', [ProfessorController::class, 'adminIndex'])->name('admin.professores.index');
    Route::patch('/admin/professores/{professor}', [ProfessorController::class, 'patch'])->name('admin.professores.patch');
});

Route::middleware(['auth', 'role:admin,professor'])->group(function () {
    Route::get('/eventos/{evento}/pdf', [EventoController::class, 'generatePdf'])->name('eventos.pdf');
});

Route::middleware(['auth', 'role:professor', 'can.evaluate'])->group(function () {
    Route::get('/trabalhos/avaliacao', [TrabalhoController::class, 'evaluation'])->name('trabalhos.evaluation');
    Route::get('/avaliacoes/avaliar/{trabalho_id}', [AvaliacaoController::class, 'evaluate'])->name('avaliacoes.evaluate');
    Route::post('/avaliacoes/store/{trabalho_id}', [AvaliacaoController::class, 'storeEvaluation'])->name('avaliacoes.store');    
});

Route::middleware(['auth', 'role:aluno,professor'])->group(function () {
    Route::get('/eventos', [EventoController::class, 'publicIndex'])->name('eventos.public');
    Route::get('/eventos/{evento_id}', [EventoController::class, 'show'])->name('eventos.show');
});

Route::middleware(['auth', 'role:aluno'])->group(function () {
    Route::get('/trabalhos/create/{evento_id}', [TrabalhoController::class, 'create'])->name('trabalhos.create');
    Route::post('/trabalhos/store/{evento_id}', [TrabalhoController::class, 'store'])->name('trabalhos.store');
    Route::get('/trabalhos', [TrabalhoController::class, 'index'])->name('trabalhos.index');
    Route::get('/trabalhos/{id}', [TrabalhoController::class, 'show'])->name('trabalhos.show');
});

require __DIR__.'/auth.php';
