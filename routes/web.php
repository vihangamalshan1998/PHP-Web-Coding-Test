<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\TicketsController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function (Request $request) {
    return view('index');
});
Route::get('/dashboard', [AuthController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('login', [AuthController::class, 'create'])
    ->name('login');
Route::post('login', [AuthController::class, 'login']);

Route::post('save_ticket', 'App\Http\Controllers\TicketsController@saveTicket')->name('save_ticket');
Route::get('search_ticket', 'App\Http\Controllers\TicketsController@searchTicket')->name('search_ticket');
Route::resource('ticket', TicketsController::class);
Route::resource('note', NoteController::class)->middleware('auth');

Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
