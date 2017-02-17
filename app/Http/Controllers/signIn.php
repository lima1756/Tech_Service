<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;

class signIn extends Controller
{
    public function index(Request $request){
        $data = $request->all();
        $email = $request->get('email');
        $pass = $request->get('pass');
        $remember = $request->get('loginrem');
        if($remember == "on"){
            if (Auth::attempt(['email' => $email, 'password' => $pass], true)) {
                if(Auth::check()){
                    $user = Auth::user();
                    return view('noHome');//
                }
                return -1;
            }
        }
        elseif (Auth::attempt(['email' => $email, 'password' => $pass])) {
            if(Auth::check()){
                $user = Auth::user();
                return view('noHome');//
            }
            return -1;
        }
        $error = "sign-in";
        //return -1;
        return view('noHome', ['signIn' => $error]);
    }
}
