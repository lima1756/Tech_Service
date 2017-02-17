<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;

class logOut extends Controller
{
    public function index(){
        Auth::logout();
        $items = DB::select('SELECT id, name FROM countries ORDER BY name ASC;');
        
        return view('noHome', ['items' => $items]);
    }
}
