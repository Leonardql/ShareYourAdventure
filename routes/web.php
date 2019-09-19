<?php

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

Route::get('/', function (){
    return view('pages.index');
});
//




Route::post('/store', "UserController@store");




Route::get('/home', 'PostsController@indexWithLogin');
Route::resource('/posts', 'PostsController');
Route::get('/', 'PostsController@index');

Route::post('/posts/{post}/comments', 'CommentsController@store');

Route::get('/adventure', function () {
    return view('adventures.adventure');

});


Route::get('current_adventures', 'AdventureController@index');
Route::post('create_adventures', 'AdventureController@store');
Route::post('edit_adventure', 'AdventureController@edit');



Route::resource('posts', 'PostsController');
Auth::routes();


Route::get('/liked/{post}', 'LikeController@store');


