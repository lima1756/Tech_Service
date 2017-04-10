<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Http\Requests;

class getUserTickets extends Controller
{
    public function index(Request $request)
    {
        $tickets = DB::table('tickets')->select('pregunta','descripcion')->where('id_ticket',$request->ticketid)->get();
        return json_encode($tickets[0]);
    }

    public function getImage(Request $request){
        $img = DB::table('imgs_tickets')->select('nombre', 'extension')->where('id_ticket',$request->ticketid)->get();
        if(sizeof($img)>0)
            return json_encode($img[0]);
        else
            return "-1";
    }

    public function getTechData(Request $request)
    {
        $tickets = DB::table('ticket_sus')->join('estados', 'ticket_sus.id_estado', '=', 'estados.id_estado')->select('ticket_sus.porcentaje','ticket_sus.prioridad', 'estados.estado', 'estados.detalles')->where('id_ticket',$request->ticketid)->get();
        if(sizeof($tickets)==0){
            $tickets = DB::table('ticket_sus')->select('ticket_sus.porcentaje','ticket_sus.prioridad')->where('id_ticket',$request->ticketid)->get();
        }

        return json_encode($tickets[0]);
    }
}
