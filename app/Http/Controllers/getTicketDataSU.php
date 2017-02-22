<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Http\Requests;

class getTicketDataSU extends Controller
{
    public function index(Request $request){
        $tickets = DB::table('tickets')
        ->join('ticket_sus', 'tickets.id_ticket', '=', 'ticket_sus.id_ticket')
        ->join('estados', 'ticket_sus.id_estado', '=', 'estados.id_estado')
        ->select('tickets.pregunta', 'tickets.descripcion', 'ticket_sus.porcentaje', 'ticket_sus.prioridad', 'ticket_sus.id_estado', 'estados.estado', 'estados.detalles')
        ->where('ticket_sus.id_ticket', $request->ticketid)->get(); //toSql()  To get the sql query
        return json_encode($tickets[0]);
    }

    public function states(Request $request){

    }

    public function imgs(Request $request){
        $tickets = DB::table('tickets')->select('pregunta','descripcion')->where('id_ticket',$request->ticketid)->get();
        return json_encode($tickets[0]);
    }
}
