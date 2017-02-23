<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class alterTicketSU extends Controller
{
    public function index(Request $request){
        DB::table('estados')->where('id_estado', $request->state)
        ->update([
            'estado' => $request->estado_actual, 'detalles' => $request->detalles
            ]);
        $prioridad = DB::table('ticket_sus')->select('prioridad')->where('id_ticketSU', $request->ticket_su)->get();
        if($prioridad[0]->prioridad==null){
            DB::table('ticket_sus')->where('id_ticketSU', $request->ticket_su)
            ->update([
                'fecha_hora' => DB::raw('now()'), 'porcentaje' => $request->porcentaje, 'prioridad' => $request->prioridad
                ]);
        }
        else{
            DB::table('ticket_sus')->where('id_ticketSU', $request->ticket_su)
            ->update([
                'porcentaje' => $request->porcentaje, 'prioridad' => $request->prioridad
                ]);
        }
        $nuevoID = DB::table('ticket_sus')->select('id_ticket')->where('id_ticketSU', $request->ticket_su)->get();
        return redirect('/dashboard/tickets/'.$nuevoID[0]->id_ticket);
    }
}
