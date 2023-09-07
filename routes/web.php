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
Route::get('/support', [App\Http\Controllers\OurDreamersController::class, 'dreamersNoFilter'])->name('support');
Route::get('/support/searchSkills', [App\Http\Controllers\OurDreamersController::class, 'dreamersFilter'])->name('search.skills');


Auth::routes();

Route::get('/self', [App\Http\Controllers\HomeController::class, 'self'])->name('self');

Route::get('/selfModeration', [App\Http\Controllers\HomeController::class, 'selfModeration'])->name('selfModeration');
Route::get('/selfSuccess/{id}', [App\Http\Controllers\HomeController::class, 'selfSuccess'])->name('selfSuccess');


Route::get('/card', [App\Http\Controllers\LKControllers\MyCardController::class, 'card'])->name('card');
Route::get('/newPartner', [App\Http\Controllers\LKControllers\PartnersController::class, 'newPartner'])->name('newPartner');
Route::get('/myCard', [App\Http\Controllers\LKControllers\MyCardController::class, 'myCard'])->name('myCard');
Route::get('/info', [App\Http\Controllers\LKControllers\InfoController::class, 'info'])->name('info');
Route::get('/myDreamers', [App\Http\Controllers\LKControllers\MyDreamersController::class, 'myDreamers'])->name('myDreamers');
Route::get('/cardSuccess/{id}', [App\Http\Controllers\LKControllers\MyCardController::class, 'cardSuccess'])->name('cardSuccess');
Route::get('/card/{id}', [App\Http\Controllers\LKControllers\MyCardController::class, 'cardItem'])->name('cardItem');
Route::get('/cardDelete/{id}', [App\Http\Controllers\LKControllers\MyCardController::class, 'cardDelete'])->name('cardDelete');
Route::get('/deletePartner/{id}', [App\Http\Controllers\LKControllers\PartnersController::class, 'delete'])->name('deletePartner');

Route::get('/personal', [App\Http\Controllers\HomeController::class, 'personalData'])->name('personal');
Route::get('/moderation', [App\Http\Controllers\HomeController::class, 'moderation'])->name('moderation');
Route::get('/partnersModeration', [App\Http\Controllers\LKControllers\PartnersController::class, 'partnersModeration'])->name('partnersModeration');

Route::post('/cardSave', [App\Http\Controllers\LKControllers\NewCardController::class, 'save'])->name('card.save');
Route::post('/infoSave', [App\Http\Controllers\LKControllers\InfoController::class, 'save'])->name('info.save');
Route::post('/selfSave', [App\Http\Controllers\HomeController::class, 'selfSave'])->name('selfSave');
Route::post('/partnerSave', [App\Http\Controllers\LKControllers\NewPartnerController::class, 'save'])->name('partner.save');
