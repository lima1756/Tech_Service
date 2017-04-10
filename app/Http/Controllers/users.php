<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Http\Requests;

class users extends Controller
{
    public function SU($id){
        DB::table('superusers')->insert([
            'id_usuario' => $id
        ]);
        return redirect('/dashboard/newUsers');
    }

    public function user($id){
        DB::table('mortals')->insert([
            'id_usuario' => $id
        ]);
        return redirect('/dashboard/newUsers');
    }
    
    public function delete($id){
        DB::table('informes')->insert([
            'id_usuario' => $id
        ]);
        return redirect('/dashboard/newUsers');
    }
}
