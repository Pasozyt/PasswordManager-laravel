<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessegeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ManufacturerController;

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
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';


// grupowanie routingu - wszystkie będą wymagały zalogowania
Route::middleware(['auth', 'verified'])->group(function () {
    

    Route::name('password.')->prefix('password')->group(function () {
        // lista wszystkich
        Route::get('', [PasswordController::class, 'index'])
            ->name('index')
            ->middleware(['permission:password.view']);
        // tworzenie nowego wpisu
        Route::get('create', [PasswordController::class, 'create'])
            ->name('create')
            ->middleware(['permission:password.view']);
        Route::post('', [PasswordController::class, 'store'])
            ->name('store')
            ->middleware(['permission:password.view']);
        // edycja wpisu
        Route::get('{password}/edit', [PasswordController::class, 'edit'])
            ->where('password', '[0-9]+')
            ->name('edit')
            ->middleware(['permission:password.view']);
        Route::patch('{password}', [PasswordController::class, 'update'])
            ->where('password', '[0-9]+')
            ->name('update')
            ->middleware(['permission:password.view']);
        // usuwanie wpisu 
        Route::get('delete/{password}', [PasswordController::class, 'delete'])
            ->where('password', '[0-9]+')
            ->name('destroy')
            ->middleware(['permission:password.view']);
        // przywrócenie usuniętego wpisu 
        Route::get('show', [PasswordController::class, 'show'])
            ->name('show')
            ->middleware(['only_ajax_request']);
    });
});
