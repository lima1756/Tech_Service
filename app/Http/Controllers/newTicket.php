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

class newTicket extends Controller
{
    public function index(Request $request){
        $mySU = $this->toWho();
        $mail = DB::table('users')->select('email')->where('id', $mySU)->get();
        if($request->hasFile('imgForm')){
            $name = $request->imgForm->hashName(); //Nombre con todo y extension
            $fileName = pathinfo($name, PATHINFO_FILENAME); //Nombre sin extension
            $fileExt = pathinfo($name, PATHINFO_EXTENSION); //Extension*/
            if($fileExt=="jpeg" || $fileExt=="png"){
                $request->imgForm->store('public/ticketImages');
                $ticketID = DB::table('tickets')->insertGetId(
                    ['id_mortal' => Auth::id(), 'pregunta' => $request->preguntaForm, 'descripcion' => $request->descripcionForm]
                );
                DB::table('imgs_tickets')->insertGetId(
                    ['id_ticket' => $ticketID, 'nombre' => $name, 'extension' => $fileExt]
                );
                $id_estado = DB::table('estados')->insertGetId(
                    ['estado' => 'Nuevo']
                );
                $ticketID2 = DB::table('ticket_sus')->insertGetId(
                    ['id_SU' => $mySU, 'id_ticket' => $ticketID, 'porcentaje' => 0, 'id_estado' => $id_estado]
                );
                $this->email($mail[0]->email, $ticketID2);
                
                return redirect('/tickets');
            }
            else{
                return view('/tickets', ['error' => 'Archivo no valido']);
            }
        }
        else{
            $ticketID = DB::table('tickets')->insertGetId(
                ['id_mortal' => Auth::id(), 'pregunta' => $request->preguntaForm, 'descripcion' => $request->descripcionForm]
            );
            $id_estado = DB::table('estados')->insertGetId(
                    ['estado' => 'Nuevo']
                );
                $ticketID2 = DB::table('ticket_sus')->insertGetId(
                    ['id_SU' => $mySU, 'id_ticket' => $ticketID, 'porcentaje' => 0, 'id_estado' => $id_estado]
                );
                $this->email($mail[0]->email, $ticketID2);
                return redirect('/tickets');
        }
        return -1;
    }

    private function toWho(){
        $SUs = DB::table('superusers')->select('id_usuario')->get();
        $points = array();
        foreach($SUs as $SU){
            $points[$SU->id_usuario]=0;
            $tasks = DB::table('ticket_sus')->select('prioridad', DB::raw('COUNT(\'prioridad\') AS count'))->where('id_SU', $SU->id_usuario)->groupBy('prioridad')->get();
            foreach($tasks as $task){
                if($task->prioridad=="bajo"){
                    $points[$SU->id_usuario]=$points[$SU->id_usuario] + ($task->count * 1);
                }
                elseif($task->prioridad=="medio"){
                    $points[$SU->id_usuario]=$points[$SU->id_usuario] + ($task->count * 2);
                }
                elseif($task->prioridad=="alto"){
                    $points[$SU->id_usuario]=$points[$SU->id_usuario] + ($task->count * 4);
                }
                elseif($task->prioridad == NULL){                   
                    $points[$SU->id_usuario]=$points[$SU->id_usuario] + ($task->count * 4);
                }
            }
        }
        $min=99999999;
        foreach($points as $point){
            if($point<$min){
                $min=$point;
            }
        }
        
        $myKey=0;
        foreach($points as $key => $point)
        {
            if($point==$min){
                $myKey=$key;
            }
        }
        return $myKey;
    }

    private function email($correo, $id_ticket){
        $data = [
            'mensaje' => 'Nueva ticket a tu cargo :)',
            'id_ticket' => $id_ticket,
        ];
        Mail::send('mailSU', $data, function($message) use ($correo){
            $message->from('admin@tech_service.com');
            $message->subject('IMPORTANTE - Nuevo ticket');
            $message->to($correo);
        });
    }
}
