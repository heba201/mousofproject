<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//note that the prefix is admin for all file route

   /* Route::group(['namespace' => 'Admin', 'middleware' => 'auth:admin','prefix' => 'admin'], function () {

        Route::get('/', 'DashboardController@index')->name('admin.dashboard');  // the first page admin visits if authenticated

    }); */
    Route::group(['namespace' => 'App\Http\Controllers\Admin','middleware' =>['auth:admin']],function(){
        Route::get('/', 'DashboardController@index')->name('admin.dashboard');
        Route::get('logout', 'LogoutController@logout')->name('admin.logout');


 ######################### Begin mojjams Routes ########################
    Route::group(['prefix' => 'mojjams'], function () {
    Route::get('/','mojjamsController@index') -> name('admin.mojjams');
    Route::get('create','mojjamsController@create') -> name('admin.mojjams.create');
    Route::post('store','mojjamsController@store') -> name('admin.mojjams.store');
    Route::get('edit/{id}','mojjamsController@edit') -> name('admin.mojjams.edit');
    Route::post('update/{id}','mojjamsController@update') -> name('admin.mojjams.update');
    Route::get('delete/{id}','mojjamsController@destroy') -> name('admin.mojjams.delete');

    });
     ######################### End   mojjams Routes  ########################

     ######################### Begin words Routes ########################
    Route::group(['prefix' => 'words'], function () {
    Route::get('/','wordsController@index') -> name('admin.words');
    Route::get('create','wordsController@create') -> name('admin.words.create');
    Route::post('store','wordsController@store') -> name('admin.words.store');
    Route::get('seccreate/{id}','wordsController@seccreate') -> name('admin.words.seccreate');
    Route::post('firstupdate/{id}','wordsController@firstupdate') -> name('admin.words.firstupdate');
    Route::get('edit/{id}','wordsController@edit') -> name('admin.words.edit');
    Route::post('update/{id}','wordsController@update') -> name('admin.words.update');
    Route::get('secedit/{id}','wordsController@secedit') -> name('admin.words.secedit');
    Route::post('secupdate/{id}','wordsController@secupdate') -> name('admin.words.secupdate');
    Route::get('thirdedit/{id}','wordsController@thirdedit') -> name('admin.words.thirdedit');
    Route::post('thirdupdate/{id}','wordsController@thirdupdate') -> name('admin.words.thirdupdate');
    Route::get('finaledit/{id}','wordsController@finaledit') -> name('admin.words.finaledit');
    Route::post('finalupdate/{id}','wordsController@finalupdate') -> name('admin.words.finalupdate');
    Route::get('delete/{id}','wordsController@destroy') -> name('admin.words.delete');

    });
     ######################### End   words Routes  ########################


     ######################### Begin sentences Routes ########################
     Route::group(['prefix' => 'sentences'], function () {
        Route::get('/','sentencesController@index') -> name('admin.sentences');
        Route::get('addsentence/{id}','sentencesController@addsentence') -> name('admin.sentences.addsentence');
        Route::post('createforword/{id}','sentencesController@createforword') -> name('admin.sentences.createforword');
        Route::get('editsentence/{id}','sentencesController@editsentence') -> name('admin.sentences.editsentence');
        Route::post('updateforword/{id}','sentencesController@updateforword') -> name('admin.sentences.updateforword');
        Route::get('delete/{id}','sentencesController@destroy') -> name('admin.sentences.delete');

    });
     ######################### End sentences Routes ########################



     ######################### Begin meaning Routes ########################
     Route::group(['prefix' => 'meanings'], function () {
        Route::get('/','meaningsController@index') -> name('admin.meanings');
        Route::get('edit/{id}','meaningsController@edit')->name('admin.meanings.edit');
        Route::post('update/{id}','meaningsController@update')->name('admin.meanings.update');
        Route::get('delete/{id}','meaningsController@destroy') -> name('admin.meanings.delete');

     });
      ######################### End meaning Routes ########################

  ######################### Begin characters Routes ########################
    Route::group(['prefix' => 'characters'], function () {
    Route::get('/','charactersController@index') -> name('admin.characters');
    Route::get('show/{id}','charactersController@show') -> name('admin.characters.show');
    Route::get('create','charactersController@create') -> name('admin.characters.create');
    Route::post('store','charactersController@store') -> name('admin.characters.store');
    Route::get('edit/{id}','charactersController@edit')->name('admin.characters.edit');
    Route::post('update/{id}','charactersController@update')->name('admin.characters.update');
    Route::get('delete/{id}','charactersController@destroy') -> name('admin.characters.delete');

 });
  ######################### End characters Routes ########################


  ######################### Begin wisdomsayingsubjects Routes ########################
  Route::group(['prefix' => 'wisdomsayingsubjects'], function () {
    Route::get('/','WisdomSayingsubjectsController@index') -> name('admin.wisdomsayingsubjects');
    Route::get('create','WisdomSayingsubjectsController@create') -> name('admin.wisdomsayingsubjects.create');
    Route::post('store','WisdomSayingsubjectsController@store') -> name('admin.wisdomsayingsubjects.store');
    Route::get('edit/{id}','WisdomSayingsubjectsController@edit') -> name('admin.wisdomsayingsubjects.edit');
    Route::post('update/{id}','WisdomSayingsubjectsController@update') -> name('admin.wisdomsayingsubjects.update');
    Route::get('delete/{id}','WisdomSayingsubjectsController@destroy') -> name('admin.wisdomsayingsubjects.delete');

    });
     ######################### End  articlecategories Routes  ########################


   ######################### Begin sayings Routes ########################
   Route::group(['prefix' => 'sayings'], function () {
    Route::get('saying','sayingsController@index') -> name('admin.sayings');
    Route::get('addsaying/{id}','sayingsController@addsaying') -> name('admin.sayings.addsaying');
    Route::post('createforcharacter/{id}','sayingsController@createforcharacter') -> name('admin.sayings.createforcharacter');
    Route::get('editsaying/{id}','sayingsController@editsaying') -> name('admin.sayings.editsaying');
    Route::post('updatesaying/{id}','sayingsController@updatesaying') -> name('admin.sayings.updatesaying');
    Route::get('delete/{id}','sayingsController@destroy') -> name('admin.sayings.delete');

});
 ######################### End sayingss Routes ########################


 ######################### Begin wisdoms Routes ########################
 Route::group(['prefix' => 'wisdoms'], function () {
    Route::get('/','wisdomsController@index') -> name('admin.wisdoms');
    Route::get('create','wisdomsController@create') -> name('admin.wisdoms.create');
    Route::post('store','wisdomsController@store') -> name('admin.wisdoms.store');
    Route::get('edit/{id}','wisdomsController@edit') -> name('admin.wisdoms.edit');
    Route::post('update/{id}','wisdomsController@update') -> name('admin.wisdoms.update');
    Route::get('delete/{id}','wisdomsController@destroy') -> name('admin.wisdoms.delete');

    });
     ######################### End   wisdoms Routes  ########################

    ######################### Begin articlecategories Routes ########################
    Route::group(['prefix' => 'articlecategories'], function () {
    Route::get('/','ArticlecategoriesController@index') -> name('admin.articlecategories');
    Route::get('show/{id}','ArticlecategoriesController@show') -> name('admin.articlecategories.show');
    Route::get('create','ArticlecategoriesController@create') -> name('admin.articlecategories.create');
    Route::post('store','ArticlecategoriesController@store') -> name('admin.articlecategories.store');
    Route::get('edit/{id}','ArticlecategoriesController@edit') -> name('admin.articlecategories.edit');
    Route::post('update/{id}','ArticlecategoriesController@update') -> name('admin.articlecategories.update');
    Route::get('delete/{id}','ArticlecategoriesController@destroy') -> name('admin.articlecategories.delete');

    });
     ######################### End  articlecategories Routes  ########################


   ######################### Begin articles Routes ########################
    Route::group(['prefix' => 'articles'], function () {
    Route::get('/','ArticlesController@index') -> name('admin.articles');
    Route::get('show/{id}','ArticlesController@show') -> name('admin.articles.show');
    Route::get('create','ArticlesController@create') -> name('admin.articles.create');
    Route::post('store','ArticlesController@store') -> name('admin.articles.store');
    Route::get('edit/{id}','ArticlesController@edit') -> name('admin.articles.edit');
    Route::post('update/{id}','ArticlesController@update') -> name('admin.articles.update');
    Route::get('delete/{id}','ArticlesController@destroy') -> name('admin.articles.delete');

    });
     ######################### End  articles Routes  ########################

      ######################### Begin lessoncategories Routes ########################
        Route::group(['prefix' => 'lessoncategories'], function () {
        Route::get('/','LessoncategoriesController@index') -> name('admin.lessoncategories');
        Route::get('show/{id}','LessoncategoriesController@show') -> name('admin.lessoncategories.show');
        Route::get('create','LessoncategoriesController@create') -> name('admin.lessoncategories.create');
        Route::post('store','LessoncategoriesController@store') -> name('admin.lessoncategories.store');
        Route::get('edit/{id}','LessoncategoriesController@edit') -> name('admin.lessoncategories.edit');
        Route::post('update/{id}','LessoncategoriesController@update') -> name('admin.lessoncategories.update');
        Route::get('delete/{id}','LessoncategoriesController@destroy') -> name('admin.lessoncategories.delete');

        });
         ######################### End  lessoncategories Routes  ########################

          ######################### Begin lessons Routes ########################
        Route::group(['prefix' => 'lessons'], function () {
        Route::get('/','LessonsController@index') -> name('admin.lessons');
        Route::get('create','LessonsController@create') -> name('admin.lessons.create');
        Route::post('store','LessonsController@store') -> name('admin.lessons.store');
        Route::get('edit/{id}','LessonsController@edit') -> name('admin.lessons.edit');
        Route::post('update/{id}','LessonsController@update') -> name('admin.lessons.update');
        Route::get('delete/{id}','LessonsController@destroy') -> name('admin.lessons.delete');

        });
         ######################### End  lessons Routes  ########################

         ######################### Begin moradfat Routes ########################
        Route::group(['prefix' => 'moradfat'], function () {
            Route::get('/','MoradfatController@index') -> name('admin.moradfat');
        Route::get('create/{id}','MoradfatController@create') -> name('admin.moradfat.create');
        Route::post('store/{id}','MoradfatController@store') -> name('admin.moradfat.store');
        Route::get('edit/{id}','MoradfatController@edit') -> name('admin.moradfat.edit');
        Route::post('update/{id}','MoradfatController@update') -> name('admin.moradfat.update');
        Route::get('delete/{id}','MoradfatController@destroy') -> name('admin.moradfat.delete');

});
    ######################### End  moradfat Routes ########################

    ######################### Begin poets Routes ########################
  Route::group(['prefix' => 'poets'], function () {
    Route::get('/','PoetsController@index') -> name('admin.poets');
    Route::get('create','PoetsController@create') -> name('admin.poets.create');
    Route::post('store','PoetsController@store') -> name('admin.poets.store');
    Route::get('edit/{id}','PoetsController@edit')->name('admin.poets.edit');
    Route::post('update/{id}','PoetsController@update')->name('admin.poets.update');
    Route::get('delete/{id}','PoetsController@destroy') -> name('admin.poets.delete');

 });
  ######################### End poets Routes ########################

       ######################### Begin abyaat Routes ########################
       Route::group(['prefix' => 'abyaat'], function () {
        Route::get('/','AbyaatController@index') -> name('admin.abyaat');
        Route::get('show/{id}','AbyaatController@show') -> name('admin.abyaat.show');
    Route::get('create/{id}','AbyaatController@create') -> name('admin.abyaat.create');
    Route::post('store/{id}','AbyaatController@store') -> name('admin.abyaat.store');
    Route::get('edit/{id}','AbyaatController@edit') -> name('admin.abyaat.edit');
    Route::post('update/{id}','AbyaatController@update') -> name('admin.abyaat.update');
    Route::get('delete/{id}','AbyaatController@destroy') -> name('admin.abyaat.delete');

});
######################### End  abyaat Routes ########################
    ######################### Begin fawaed subjects Routes ########################
    Route::group(['prefix' => 'fawaedsubjects'], function () {
        Route::get('/','FawaedsubjectsController@index') -> name('admin.fawaedsubjects');
        Route::get('show/{id}','FawaedsubjectsController@show') -> name('admin.fawaedsubjects.show');
        Route::get('create','FawaedsubjectsController@create') -> name('admin.fawaedsubjects.create');
        Route::post('store','FawaedsubjectsController@store') -> name('admin.fawaedsubjects.store');
        Route::get('edit/{id}','FawaedsubjectsController@edit') -> name('admin.fawaedsubjects.edit');
        Route::post('update/{id}','FawaedsubjectsController@update') -> name('admin.fawaedsubjects.update');
        Route::get('delete/{id}','FawaedsubjectsController@destroy') -> name('admin.fawaedsubjects.delete');

        });
         ######################### End  fawaed subjects Routes  ########################

    ######################### Begin fawaed  Routes ########################
    Route::group(['prefix' => 'fawaed'], function () {
    Route::get('/','FawaedController@index') -> name('admin.fawaed');
    Route::get('show/{id}','FawaedController@show') -> name('admin.fawaed.show');
    Route::get('create','FawaedController@create') -> name('admin.fawaed.create');
    Route::post('store','FawaedController@store') -> name('admin.fawaed.store');
    Route::get('edit/{id}','FawaedController@edit') -> name('admin.fawaed.edit');
    Route::post('update/{id}','FawaedController@update') -> name('admin.fawaed.update');
    Route::get('delete/{id}','FawaedController@destroy') -> name('admin.fawaed.delete');

    });
     ######################### End  fawaed  Routes  ########################

      ######################### Begin namesorigins Routes ########################
        Route::group(['prefix' => 'namesorigins'], function () {
        Route::get('/','NamesoriginsController@index') -> name('admin.namesorigins');
        Route::get('create','NamesoriginsController@create') -> name('admin.namesorigins.create');
        Route::post('store','NamesoriginsController@store') -> name('admin.namesorigins.store');
        Route::get('edit/{id}','NamesoriginsController@edit') -> name('admin.namesorigins.edit');
        Route::post('update/{id}','NamesoriginsController@update') -> name('admin.namesorigins.update');
        Route::get('delete/{id}','NamesoriginsController@destroy') -> name('admin.namesorigins.delete');

        });
         ######################### End   namesorigins Routes  ########################

    ######################### Begin namesmeanings Routes ########################
    Route::group(['prefix' => 'namesmeanings'], function () {
    Route::get('/','NamesmeaningsController@index') -> name('admin.namesmeanings');
    Route::get('create','NamesmeaningsController@create') -> name('admin.namesmeanings.create');
    Route::post('store','NamesmeaningsController@store') -> name('admin.namesmeanings.store');
    Route::get('edit/{id}','NamesmeaningsController@edit') -> name('admin.namesmeanings.edit');
    Route::post('update/{id}','NamesmeaningsController@update') -> name('admin.namesmeanings.update');
    Route::get('delete/{id}','NamesmeaningsController@destroy') -> name('admin.namesmeanings.delete');

    });
     ######################### End namesmeanings Routes  ########################


    ######################### Begin adminmanagement Routes ########################
   Route::group(['prefix' => 'adminmanagement'], function () {
    Route::get('/','AdminmanagementController@index') -> name('admin.adminmanagement');
    Route::get('create','AdminmanagementController@create') -> name('admin.adminmanagement.create');
    Route::post('store','AdminmanagementController@store') -> name('admin.adminmanagement.store');
    Route::get('edit/{id}','AdminmanagementController@edit') -> name('admin.adminmanagement.edit');
    Route::post('update/{id}','AdminmanagementController@update') -> name('admin.adminmanagement.update');
    Route::get('delete/{id}','AdminmanagementController@destroy') -> name('admin.adminmanagement.delete');
    Route::get('adminroles','AdminmanagementController@adminroles') -> name('admin.adminmanagement.adminroles');
    Route::get('supervisor/{id}','AdminmanagementController@supervisor') -> name('admin.adminmanagement.supervisor');
    Route::get('admin/{id}','AdminmanagementController@admin') -> name('admin.adminmanagement.admin');
    Route::get('changepassword','AdminmanagementController@changepassword') -> name('admin.adminmanagement.changepassword');
    Route::post('updatepassword/{id}','AdminmanagementController@updatepassword') -> name('admin.adminmanagement.updatepassword');

});
     ######################### End adminmanagement Routes  ########################


    });

    Route::group(['namespace' => 'App\Http\Controllers\Admin','middleware' => 'guest:admin','prefix' => 'admin'], function () {

        Route::get('login', 'LoginController@login')->name('get.admin.login');
        Route::post('login', 'LoginController@postLogin')->name('admin.post.login');

    });

