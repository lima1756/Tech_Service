<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class signUp extends Controller
{
    public function index(Request $request){
        $data = $request->all();
        $error = array();
        $email = $request->get('email');
        $pass = $request->get('pass');
        $pass = Hash::make($pass);
        $name = $request->get('name');
        $last = $request->get('last');
        $cell = $request->get('cell');
        $tel = $request->get('tel');
        $ext = $request->get('ext');
        $work = $request->get('work');
        $area = $request->get('area');
        $country = $request->get('country');
        $items = DB::select('SELECT id, name FROM countries ORDER BY name ASC;');
        if(!$this->notNulls($data)){
            array_push($error, "NULLS");
        }
        $check = $this->checkemail($email);
        if($check!="ok")
        {
            array_push($error, $check);    
        }
        if($request->get('pass') != $request->get('pass2'))
        {
            array_push($error, "passwords");    
        }
        if(count($error)==0)
        {
            DB::table('users')->insert(
                ['email' => $email, 'password' => $pass, 'nombre' => $name, 'apellido' => $last, 
                'cel' => $cell, 'tel' => $tel, 'ext' => $ext, 'areaTrabajo' => $area, 
                'trabajo' => $work, 'id_region' => $country]
            );
        }
        return view('noHome', ['items' => $items, 'error' => $error, 'goTo' => "registro"]);
    }
    
    private function notNulls(array $data){
        foreach($data as $d){
            if($d == null){
                return false;
            }
        }
        return true;
    }

    private function checkemail($email){
        $vals = DB::table('users')->select('email', 'id_usuarios')->where('email', '=', $email)->get();
        if(count($vals)>0)
        {
            $vals = DB::table('informes')->where('id_usuario', '=', $vals[0]->id_usuarios)->first();
            if(count($vals)>0)
            {
                return "denied";
            }
            else
            {
                return "registered";
            }
        }
        return "ok";
    }
     
}
