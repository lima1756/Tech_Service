<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Http\Requests;

class getFAQSU extends Controller
{
    public function index(Request $request){
        $questions= DB::table('knowledge')->where('id', $request->id)->get();
        return json_encode($questions[0]);
    }

    public function submit(Request $request){
        if(isset($request->id)){
            if($request->select_tema=="null"){
                DB::table('knowledge')->where('id', $request->id)->update([
                'pregunta' => $request->pregunta, 'respuesta' => $request->respuesta, 'tema' => $request->input_tema
                ]);
            }
            else{
                            
                DB::table('knowledge')->where('id', $request->id)->update([
                    'pregunta' => $request->pregunta, 'respuesta' => $request->respuesta, 'tema' => $request->select_tema
                ]);
            }
        }
        else{
            if($request->select_tema=="null"){
                DB::table('knowledge')->insert([
                    'pregunta' => $request->pregunta, 'respuesta' => $request->respuesta, 'tema' => $request->input_tema
                ]);
            }
            else{
                DB::table('knowledge')->insert([
                    'pregunta' => $request->pregunta, 'respuesta' => $request->respuesta, 'tema' => $request->select_tema
                ]);
            }
        }
        return redirect('/dashboard/knowledge');
    }
}
