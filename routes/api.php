<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [UserController::class, 'registerAPI'])->name('registerAPI');
Route::post('/login', [UserController::class, 'loginAPI'])->name('loginAPI');
Route::get('/view-books', [BookController::class, 'viewBooksAPI'])->name('viewBooksAPI')->middleware('auth');
Route::post('/logout', [UserController::class, 'logoutAPI'])->name('logoutAPI')->middleware('auth');
Route::post('/add-book', [BookController::class, 'addBookAPI'])->name('addBookAPI')->middleware('auth')->middleware('accType');
Route::post('/remove-book/{id}', [BookController::class, 'removeBookAPI'])->name('removeBookAPI')->middleware('auth')->middleware('accType');
Route::post('/update-book/{id}', [BookController::class, 'updateBookAPI'])->name('updateBookAPI')->middleware('auth')->middleware('accType');
