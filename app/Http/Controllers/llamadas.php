<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Http\Requests;

class llamadas extends Controller
{
    public function index($id, Request $request){
        DB::table('llamadas')->insert([
            'id_ticket_su' => $id, 'detalles' => $request->detalles
        ]);
        return redirect('dashboard/llamadas/'.$id);
    }
}
