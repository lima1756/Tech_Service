<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;

class CheckMortal
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(null!==Auth::id()){
            $id=Auth::id();
            $query=DB::table('mortals')->where('id_usuario', '=', $id)->first();
            if(count($query)>0){
                return $next($request);
            }
        }
        return redirect('/');
    }
}
