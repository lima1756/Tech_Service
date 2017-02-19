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

Route::get('/home', function(){
    return view('noHome');
});
Route::get('/', function(){
    return view('noHome');
});

Route::post('/signUp', 'signUp@index');
Route::get('/signUp', function (){
    return redirect('/');
});

Route::post('/logIn', 'signIn@index');

Route::get('/logOut', 'logOut@index');
Route::get('/knowledge', function() {
    return view('knowledge');
})->middleware('checkMortal');

Route::get('/tickets', function() {
    return view('tickets');
})->middleware('checkMortal');