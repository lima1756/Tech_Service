<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class newComment extends Controller
{
    public function index(Request $request){
        DB::table('notas')->insert(
            ['id_ticket_su' => $request->id_ticket_su, 'id_SU' => Auth::id(), 'mensaje' => $request->comentario, 'id_nota' => $request->last]
        );
        return redirect('/dashboard/foro/'.$request->id_ticket_su);
    }
}
