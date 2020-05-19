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
    if(Auth::check()){
        return view('user/home');
    }
    return view('auth/login');
});


Route::post('/login', 'AuthController@postLogin');

Route::group(['middleware' => ['auth']], function() {

Route::get('/home', 'UserController@index');

//Account Routes
Route::get('/account/settings', 'UserController@viewSettings');
Route::get('/account/changePassword', 'UserController@viewChangePassword');

Route::put('/account/changePassword/save','UserController@updatePassword');
Route::put('/account/settings/save', 'UserController@updateSettigs');

//BlackListWords
Route::get('/blacklist/words', 'BlackListWordsController@index');
Route::post('/blacklist/words/add', 'BlackListWordsController@addWordBlackList')->name('addWordBlist');
Route::post('/blacklist/words/remove', 'BlackListWordsController@removeWordBlist')->name('removeWordBlist');
Route::get('/blacklist/words/get', 'BlackListWordsController@getWordBlist')->name('getWordBlist');

//BlackListUser
Route::get('/blacklist/user', 'BlackListUserController@index');
Route::post('/blacklist/user/add', 'BlackListUserController@addUser')->name('addUserToBlacklist');
Route::get('/blacklist/user/get', 'BlackListUserController@getUserBlackList')->name('getUserBlackList');
Route::post('/blacklist/user/remove', 'BlackListUserController@remove')->name('removeUserBL');

//DashBoard Live
Route::get('/search/liveidautomatic', 'UserController@searchLiveIdAutomatic')->name('buscarLiveId');
});

