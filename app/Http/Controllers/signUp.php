<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;


class signUp extends Controller
{
    public function index(Request $request){
        $name = $request->input('name');
        var_dump($name);
        return "hola";
    }
}
