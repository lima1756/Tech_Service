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

Route::get('/tickets/{state}', function($state) {
    return view('tickets', ['state'=>$state]);
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

Route::get('/dashboard/tickets/{state}', function ($state){
    return view('ticketsSU', ['state'=>$state]);
})->middleware('checkSU');

Route::get('/dashboard/tickets', function (){
    return view('ticketsSU');
})->middleware('checkSU');

//ajaxSRT=ajax SU request tickets
Route::post('/ajaxSRT', 'getTicketDataSU@index')->middleware('checkSU');
//ajaxSRTI=ajax SU request ticket states
Route::post('/ajaxSRTI', 'getTicketDataSU@imgs')->middleware('checkSU');
//ajaxSRTS=ajax SU request ticket states
Route::post('/ajaxSRTS', 'getTicketDataSU@states')->middleware('checkSU');

Route::post('/dashboard/tickets/update', 'alterTicketSU@index');

Route::get('/dashboard/foro/{id}', function ($id){
    return view('foro', ['id'=>$id]);
})->middleware('checkSU');

Route::get('/dashboard/foro', function (){
    return view('foro');
})->middleware('checkSU');

Route::post('/dashboard/foro/nuevo', 'newComment@index');

Route::get('/dashboard/knowledge', function() {
    return view('knowledgeSU');
})->middleware('checkSU');

Route::post('/ajaxFAQ', 'getFAQSU@index')->middleware('checkSU');

Route::post('/dashboard/knowledge/submit', 'getFAQSU@submit')->middleware('checkSU');

Route::post('/dashboard/knowledge/drop', 'getFAQSU@drop')->middleware('checkSU');

Route::get('/dashboard/llamadas/{id}', function($id) {
    return view('llamadas', ['id'=>$id]);
})->middleware('checkSU');

Route::post('/dashboard/llamadas/{id}/submit', 'llamadas@index')->middleware('checkSU');

Route::get('/dashboard/newUsers', function() {
    return view('newUsers');
})->middleware('checkSU');

Route::get('/dashboard/newUsers/delete/{id}', 'users@delete')->middleware('checkSU');

Route::get('/dashboard/newUsers/user/{id}', 'users@user')->middleware('checkSU');

Route::get('/dashboard/newUsers/SU/{id}', 'users@SU')->middleware('checkSU');

Route::get('/dashboard/countriesStats', function() {
    return view('countriesStats');
})->middleware('checkSU');

Route::get('/mail', function() {
    return view('mail');
});