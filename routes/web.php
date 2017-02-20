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

//ajaxMRT=ajax mortal request tickets
Route::post('/ajaxMRT', 'getUserTickets@index')->middleware('checkMortal');
//ajaxMRTI=ajax mortal request tickets Image
Route::post('/ajaxMRTI', 'getUserTickets@getImage')->middleware('checkMortal');
//ajaxMRTSI=ajax mortal request tickets SUsInfo
Route::post('/ajaxMRTSI', 'getUserTickets@getTechData')->middleware('checkMortal');

Route::post('/tickets/newTicket', 'newTicket@index')->middleware('checkMortal');


Route::get('/dashboard', function() {
    return view('dashboard');
})->middleware('checkSU');