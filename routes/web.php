<?php

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
define('PAGINATION_COUNT',10);

Route::middleware('auth:api')->group(function () {
    // our routes to be protected will go in here
   // Route::post('/logout', 'Auth\ApiAuthController@logout')->name('logout.api');
});
######################### Begin login & registeration Routes ########################
Route::get('/userlogin', [App\Http\Controllers\LoginController::class, 'userlogin'])->name('userlogin');
Route::post('/postLogin', [App\Http\Controllers\LoginController::class, 'postLogin'])->name('postLogin');
Route::get('/register', [App\Http\Controllers\LoginController::class, 'register'])->name('register');
Route::post('/registeruser', [App\Http\Controllers\LoginController::class, 'registeruser'])->name('registeruser');
Route::get('/logout', [App\Http\Controllers\LogoutController::class, 'logout'])->name('logout');



#########################  login & registeration Routes End ########################


######################### Begin Home Routes ########################
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/wordsearch', [App\Http\Controllers\HomeController::class, 'wordsearch'])->name('wordsearch');
Route::get('/wordmojjam/{id}/{searchword}', [App\Http\Controllers\HomeController::class, 'wordmojjam'])->name('wordmojjam');
Route::get('/getwordmaningmojjam/{id}', [App\Http\Controllers\HomeController::class, 'getwordmaningmojjam'])->name('getwordmaningmojjam');
Route::get('/composedword/{id}', [App\Http\Controllers\HomeController::class, 'composedword'])->name('composedword');
Route::get('/expression/{id}', [App\Http\Controllers\HomeController::class, 'expression'])->name('expression');
######################### Begin Home Routes ########################



 ######################### Begin articles Routes ########################
Route::get('/articles', [App\Http\Controllers\ArticlesController::class, 'index'])->name('articles');
Route::get('/articleshow/{id}', [App\Http\Controllers\ArticlesController::class, 'articleshow'])->name('article');
Route::get('/articlecategory/{id}', [App\Http\Controllers\ArticlesController::class, 'articlesbycategory'])->name('articlecategory');
Route::get('/articlesbydate/{date}', [App\Http\Controllers\ArticlesController::class, 'articlesbydate'])->name('articlesbydate');
 ######################### End articles Routes ########################

######################### Begin lessons Routes ########################
Route::get('/lessons', [App\Http\Controllers\LessonsController::class, 'index'])->name('lessons');
Route::get('/lessonshow/{id}', [App\Http\Controllers\LessonsController::class, 'lessonshow'])->name('lesson');
 ######################### End lessons Routes ########################


######################### Begin wisdoms Routes ########################

Route::get('/wisdoms', [App\Http\Controllers\WisdomsController::class, 'index'])->name('wisdoms');
Route::get('/wisdomsubject/{id}', [App\Http\Controllers\WisdomsController::class, 'wisdomsubject'])->name('wisdomsubject');
Route::get('/wisdomcharacter/{id}', [App\Http\Controllers\WisdomsController::class, 'wisdomcharacter'])->name('wisdomcharacter');
Route::get('/wisdomtag/{tag}', [App\Http\Controllers\WisdomsController::class, 'wisdomtag'])->name('wisdomtag');
Route::post('/wisdomsearch', [App\Http\Controllers\WisdomsController::class, 'wisdomsearch'])->name('wisdomsearch');
Route::get('/allwisdomcharacter/{id}', [App\Http\Controllers\WisdomsController::class, 'allwisdomcharacter'])->name('allwisdomcharacter');
 ######################### End wisdoms Routes ########################

 ######################### Begin sayings Routes ########################

Route::get('/sayings', [App\Http\Controllers\SayingsController::class, 'index'])->name('sayings');
Route::get('/sayingsubject/{id}', [App\Http\Controllers\SayingsController::class, 'sayingsubject'])->name('sayingsubject');
Route::get('/sayingcharacter/{id}', [App\Http\Controllers\SayingsController::class, 'sayingcharacter'])->name('sayingcharacter');
Route::get('/sayingtag/{tag}', [App\Http\Controllers\SayingsController::class, 'sayingtag'])->name('sayingtag');
Route::post('/sayingsearch', [App\Http\Controllers\SayingsController::class, 'sayingsearch'])->name('sayingsearch');
Route::get('/allsayingcharacter/{id}', [App\Http\Controllers\SayingsController::class, 'allsayingcharacter'])->name('allsayingcharacter');
Route::get('/getsaying/{id}', [App\Http\Controllers\SayingsController::class, 'getsaying'])->name('getsaying');

######################### End sayings Routes ########################

 ######################### Begin moradfat Routes ########################
 Route::get('/moradfat', [App\Http\Controllers\MoradfatController::class, 'index'])->name('moradfat');
 Route::get('/moradfatword/{word}', [App\Http\Controllers\MoradfatController::class, 'moradfatword'])->name('moradfat.word');
 Route::post('/moradfatsearch', [App\Http\Controllers\MoradfatController::class, 'moradfatsearch'])->name('moradfat.search');
 Route::get('/moradfatmojjam/{id}/{searchword}', [App\Http\Controllers\MoradfatController::class, 'moradfatmojjam'])->name('moradfat.moradfatmojjam');
 ######################### End moradfat Routes ########################

  ######################### Begin namesmeanings Routes ########################
  Route::get('/namesmeanings', [App\Http\Controllers\NamesmeaningsController::class, 'index'])->name('namesmeanings');
  Route::get('/namesmeanings/{name}', [App\Http\Controllers\NamesmeaningsController::class, 'namesrelated'])->name('namesmeanings.namesrelated');
  Route::get('/namesmeanings_origin/{id}', [App\Http\Controllers\NamesmeaningsController::class, 'namesmeanings_origin'])->name('namesmeanings.namesmeanings_origin');
  Route::post('/namemeaningsearch', [App\Http\Controllers\NamesmeaningsController::class, 'namemeaningsearch'])->name('namesmeanings.namemeaningsearch');

  ######################### End namesmeanings Routes ########################

######################### Begin fawaed Routes ########################
Route::get('/fawaed', [App\Http\Controllers\FawaedController::class, 'index'])->name('fawaed');
Route::post('/faedasearch', [App\Http\Controllers\FawaedController::class, 'faedasearch'])->name('fawaed.faedasearch');
Route::get('/faeda/{id}', [App\Http\Controllers\FawaedController::class, 'getfaeda'])->name('faeda');

######################### End  fawaed Routes ########################

######################### Begin quaanwords Routes ########################
Route::get('/quaanwords', [App\Http\Controllers\QuraanwordsController::class, 'index'])->name('quaanwords');
Route::post('/faedasearch', [App\Http\Controllers\FawaedController::class, 'faedasearch'])->name('fawaed.faedasearch');

######################### End quaanwords Routes ########################



