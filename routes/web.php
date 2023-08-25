<?php

use Illuminate\Support\Facades\Auth;
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
//
//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [App\Http\Controllers\PublicController::class, 'show'])->name('home');
Route::get('/support', [App\Http\Controllers\PublicController::class, 'support'])->name('support');


Auth::routes();

Route::get('/self', [App\Http\Controllers\HomeController::class, 'self'])->name('self');

Route::get('/selfModeration', [App\Http\Controllers\HomeController::class, 'selfModeration'])->name('selfModeration');
Route::get('/selfSuccess/{id}', [App\Http\Controllers\HomeController::class, 'selfSuccess'])->name('selfSuccess');


Route::post('/selfSave', [App\Http\Controllers\HomeController::class, 'selfSave'])->name('selfSave');
Route::get('/card', [App\Http\Controllers\HomeController::class, 'card'])->name('card');
Route::get('/myCard', [App\Http\Controllers\HomeController::class, 'myCard'])->name('myCard');
Route::get('/cardSuccess/{id}', [App\Http\Controllers\HomeController::class, 'cardSuccess'])->name('cardSuccess');
Route::get('/card/{id}', [App\Http\Controllers\HomeController::class, 'cardItem'])->name('cardItem');
Route::get('/cardDelete/{id}', [App\Http\Controllers\HomeController::class, 'cardDelete'])->name('cardDelete');

Route::get('/personal', [App\Http\Controllers\HomeController::class, 'personalData'])->name('personal');
Route::get('/moderation', [App\Http\Controllers\HomeController::class, 'moderation'])->name('moderation');
Route::post('/cardSave', [App\Http\Controllers\HomeController::class, 'save'])->name('card.save');
