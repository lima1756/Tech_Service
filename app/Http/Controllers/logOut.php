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
        
        return view('noHome');
    }
}
