<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\PublicoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DestinoController;
use App\Http\Controllers\FavoritoController;

/*Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});*/

Route::get('/', [PublicoController::class, 'inicio'])->name('inicio');
Route::get('/destinos', [PublicoController::class, 'destinos'])->name('destinos.publico');
Route::get('/destinos/{destino}', [PublicoController::class, 'detalleDestino'])->name('destinos.detalle');
Route::get('/categorias', [PublicoController::class, 'categorias'])->name('categorias.publico');
Route::get('/sobre-nosotros', [PublicoController::class, 'sobreNosotros'])->name('sobre');

Route::get('/dashboard', function () {
    if (auth()->user()->rol === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('usuario.panel');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/usuario/panel', [UsuarioController::class, 'panel'])->name('usuario.panel');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/usuarios', [AdminController::class, 'usuarios'])->name('usuarios');

    Route::resource('categorias', CategoriaController::class);
    Route::resource('destinos', DestinoController::class);
});

require __DIR__.'/auth.php';
