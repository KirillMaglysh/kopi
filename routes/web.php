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
Route::post('/selfSave', [App\Http\Controllers\HomeController::class, 'selfSave'])->name('selfSave');
Route::get('/personal', [App\Http\Controllers\HomeController::class, 'personalData'])->name('personal');

Route::get('/info', [App\Http\Controllers\LKControllers\InfoController::class, 'info'])->name('info');
Route::post('/infoSave', [App\Http\Controllers\LKControllers\InfoController::class, 'save'])->name('info.save');

Route::get('/card', [App\Http\Controllers\LKControllers\MyCardController::class, 'card'])->name('card');
Route::get('/cardSuccess/{id}', [App\Http\Controllers\LKControllers\MyCardController::class, 'cardSuccess'])->name('cardSuccess');
Route::get('/card/{id}', [App\Http\Controllers\LKControllers\MyCardController::class, 'cardItem'])->name('cardItem');
Route::get('/support/card/{id}', [App\Http\Controllers\OurDreamersController::class, 'cardMore'])->name('cardMore');
Route::get('/cardMore/{id}', [App\Http\Controllers\LKControllers\MyCardController::class, 'myCardMore'])->name('myCardMore');
Route::get('/checkCard/{id}', [App\Http\Controllers\OurDreamersController::class, 'checkCard'])->name('checkCard');
Route::get('/cardDelete/{id}', [App\Http\Controllers\LKControllers\MyCardController::class, 'cardDelete'])->name('cardDelete');
Route::get('/myCard', [App\Http\Controllers\LKControllers\MyCardController::class, 'myCard'])->name('myCard');
Route::post('/changeSum', [App\Http\Controllers\LKControllers\MyCardController::class, 'changeSum'])->name('changeSum');
Route::post('/cardSave', [App\Http\Controllers\LKControllers\NewCardController::class, 'save'])->name('card.save');

Route::get('/newPartner', [App\Http\Controllers\LKControllers\PartnersController::class, 'newPartner'])->name('newPartner');
Route::get('/deletePartner/{id}', [App\Http\Controllers\LKControllers\PartnersController::class, 'delete'])->name('deletePartner');
Route::get('/partnersModeration', [App\Http\Controllers\LKControllers\PartnersController::class, 'partnersModeration'])->name('partnersModeration');
Route::post('/partnerSave', [App\Http\Controllers\LKControllers\NewPartnerController::class, 'save'])->name('partner.save');

Route::get('/myDreamers', [App\Http\Controllers\LKControllers\MyDreamersController::class, 'myDreamers'])->name('myDreamers');

Route::get('/moderation', [App\Http\Controllers\HomeController::class, 'moderation'])->name('moderation');

Route::post('/newNewsSave', [App\Http\Controllers\LKControllers\EditNewsController::class, 'saveNew'])->name('newNews.save');
Route::post('/editOldSave', [App\Http\Controllers\LKControllers\EditNewsController::class, 'editOld'])->name('editOld.save');
Route::get('/newsModeration', [App\Http\Controllers\LKControllers\NewsController::class, 'newsModeration'])->name('newsModeration');
Route::get('/newNews', [App\Http\Controllers\LKControllers\NewsController::class, 'newNews'])->name('newNews');
Route::get('/edit/{id}', [App\Http\Controllers\LKControllers\NewsController::class, 'edit'])->name('editNews');
Route::get('/deleteNews/{id}', [App\Http\Controllers\LKControllers\NewsController::class, 'delete'])->name('deleteNews');
Route::get('/moreNews/{id}', [App\Http\Controllers\LKControllers\NewsController::class, 'delete'])->name('moreNews');
