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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/image/upload', 'ImageController@upload');

Route::get('comment/list/{comment}', 'CommentController@list');
Route::get('api/userinfo', 'CommentController@info');

Route::group(['middleware' => 'auth'], function() {  
    Route::resource('article', 'ArticleController');
    Route::get('/article/del/{article}','ArticleController@destroy');

    Route::post('/image/upload', 'ImageController@upload');
    
    Route::get('/userinfo/show','UserinfoController@show');
    Route::get('/userinfo/edit','UserinfoController@edit');
    Route::post('/userinfo/update','UserinfoController@update');

    Route::post('comment', 'CommentController@store'); 
    // Route::get('comment/list/{comment}', 'CommentController@list');
    Route::get('comment/{comment}', 'CommentController@destroy');

    Route::get('message/new', 'MessageController@new');
    Route::get('message/history', 'MessageController@history');
    
    Route::get('cate/create', 'CateController@create');
    Route::post('cate', 'CateController@store');

    Route::get('cate/self', 'CateController@self');


    Route::get('message', 'messageController@index');
    Route::get('message/{message}', 'messageController@update');
    Route::get('message/new', 'messageController@new');
    
});

Route::get('/userinfo/profile/{userinfo}','UserinfoController@profile');
Route::get('article/{article}', 'ArticleController@show');
Route::get('cate', 'CateController@index');
Route::get('cate/{cate}', 'CateController@show');
Route::get('userinfo/auth', 'UserinfoController@auth');






