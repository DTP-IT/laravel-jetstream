<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

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

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/', function() {
        return view('dashboard');
    })->name('dashboard');
    
    Route::prefix('books')->group(function () {
        Route::get('/', [BookController::class, 'index'])->name('book.index');
        Route::get('/create', [BookController::class, 'create'])->name('book.create');
        Route::post('/', [BookController::class, 'store'])->name('book.store');
        Route::get('/{book}/edit', [BookController::class, 'edit'])->name('book.edit');
        Route::put('/{book}', [BookController::class, 'update'])->name('book.update');
        Route::put('/restore/{book}', [BookController::class, 'restore'])->name('book.restore');
        Route::delete('/{book}', [BookController::class, 'destroy'])->name('book.destroy');
        Route::get('search', [BookController::class, 'search'])->name('book.search');
        Route::get('/show-soft-delete', [BookController::class, 'showSoftDelete'])->name('book.showSoftDelete');
    });
    Route::group(['middleware' => ['role:admin']], function () {
        Route::prefix('user')->group(function () {
            Route::get('/permission', [UserController::class, 'permission'])->name('user.permission');
            Route::post('permission/', [UserController::class, 'insertPermission'])->name('user.insertPermission');
            Route::get('/', [UserController::class, 'index'])->name('user.index');
            Route::get('/create', [UserController::class, 'create'])->name('user.create');
            Route::get('/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
            Route::put('/{user}', [UserController::class, 'update'])->name('user.update');
            Route::post('/', [UserController::class, 'store'])->name('user.store');
            Route::get('/search', [UserController::class, 'search'])->name('user.search');
        });
    });
    Route::prefix('category')->group(function() {
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/create', [CategoryController::class, 'create'])->middleware('role:admin')->name('category.create');
        Route::post('/', [CategoryController::class, 'store'])->middleware('role:admin')->name('category.store');
    });
});
