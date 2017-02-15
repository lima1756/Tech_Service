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
/*
Route::get('/', function () {
    return view('home', getCountries::index());
});
*/
//Route::get('/', 'getCountries@index');
Route::get('/home', 'getCountries@index');


 Route::get('/', function (){
    if(Auth::check()) return "funco"; else return "nope";
});

Route::post('/signUp', 'signUp@index');
Route::get('/signUp', function (){
    return redirect('/');
});

Route::post('/logIn', 'signIn@index');
