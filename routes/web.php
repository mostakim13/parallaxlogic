<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/product',ProductController::class);
Route::get('/deleted/data',[ProductController::class,'deletedData'])->name('deleted-data');
Route::get('product/deletedproduct/{id}', [ProductController::class, 'restoreDeletedProduct'])->name('restoreDeletedProduct');
Route::get('product/deletePermanently/{id}', [ProductController::class, 'deletePermanently'])->name('deletePermanently');
Route::get('log/details', [ProductController::class, 'logDetails'])->name('log-details');
Route::get('log/details/delete/{id}', [ProductController::class, 'logDetailsDelete'])->name('log-details-delete');


Route::get('log/data/dataDetails/{id}', [ProductController::class, 'dataDetails'])->name('log-data-details');

