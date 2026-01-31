<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;

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


Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/store', [ContactController::class, 'store']);
Route::get('/thanks', [ContactController::class, 'thanks']);
Route::get('/admin', [AdminController::class, 'index'])
    ->name('admin.index')
    ->middleware('auth');
Route::post('/login', [LoginController::class, 'store'])->name('login');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
Route::get('/search', [AdminController::class, 'index'])
    ->name('admin.search')
    ->middleware('auth');
Route::get('/reset', function () {
    return redirect('/search');
});
Route::get('/export', [AdminController::class, 'export'])
    ->name('admin.export')
    ->middleware('auth');
Route::delete('/delete/{contact}', [AdminController::class, 'destroy'])
    ->name('admin.delete')
    ->middleware('auth');

