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
        
        if (Auth::attempt(['email' => $email, 'password' => $pass])) {
            if(Auth::check()){
                $user = Auth::user();
                var_dump($user);
                return view('noHome');//
                return 105;
            }
            return 55;
        }
        else
        {
            $error = "sign-in";
            //return view('noHome', ['items' => $items, 'signIn' => $error]);
        }
        /*$vals = DB::table('usuarios')->select("id_usuarios")->where('email', '=', $email)->where('pass', '=', $pass)->first();
        if($vals==NULL){
            $error = "sign-in";
            return view('noHome', ['items' => $items, 'signIn' => $error]);
        }
        else{
            $request->session()->put('user', $vals->id_usuarios);
            return 1;
        }*/
        return 0;
    }
}
