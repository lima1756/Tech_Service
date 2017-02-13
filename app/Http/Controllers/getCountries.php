<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class getCountries extends Controller
{
    public function index(){
        $items = DB::select('SELECT id, name FROM countries ORDER BY name ASC;');
        
        return view('home', ['items' => $items]);
    }
}
