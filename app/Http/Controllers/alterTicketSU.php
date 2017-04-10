<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Order;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;


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
        $datos = DB::table('ticket_sus')->select('tickets.id_ticket', 'users.email')->join('tickets', 'ticket_sus.id_ticket', '=', 'tickets.id_ticket')
                    ->join('mortals', 'tickets.id_mortal', '=', 'mortals.id_usuario')->join('users', 'mortals.id_usuario', '=', 'users.id')
                    ->where('ticket_sus.id_ticketSU', '=', $request->ticket_su)->get();
        $this->sendEmail($datos[0]->email, $datos[0]->id_ticket);
        return redirect('/dashboard/tickets/'.$nuevoID[0]->id_ticket);
    }

    private function sendEmail($correo, $id_ticket){
        $data = [
            'mensaje' => 'Tu orden ha sido actualizada',
            'id_ticket' => $id_ticket,
        ];
        Mail::send('mail', $data, function($message) use ($correo){
            $message->from('admin@tech_service.com');
            $message->subject('IMPORTANTE - actualización de ticket');
            $message->to($correo);
        });
    }
}
