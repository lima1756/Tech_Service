<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Http\Requests;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Database\Eloquent\Model;

class getFAQSU extends Controller
{
    public function index(Request $request){
        $questions= DB::table('knowledge')->where('id', $request->id)->get();
        
        return json_encode($questions[0]);
    }

    public function submit(Request $request){
        $this->validate($request, [
            'content' => 'required'
        ]);
        $message=$request->input('content');
        $dom = new \DomDocument();
        $dom->loadHtml($message, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
        $images = $dom->getElementsByTagName('img');
       // foreach <img> in the submited message
        foreach($images as $img){
            $src = $img->getAttribute('src');
            
            // if the img source is 'data-url'
            if(preg_match('/data:image/', $src)){                
                // get the mimetype
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];                
                // Generating a random filename
                $filename = uniqid();
                $filepath = "summernoteimages/$filename.$mimetype";    
                // @see http://image.intervention.io/api/
                $image = Image::make($src)
                  // resize if required
                  /* ->resize(300, 200) */
                  ->encode($mimetype, 100)  // encode file to the specified mimetype
                  ->save(public_path($filepath));                
                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            } // <!--endif
        } // <!-
        if(isset($request->id)){
            if($request->select_tema=="null"){
                DB::table('knowledge')->where('id', $request->id)->update([
                'titulo' => $request->Titulo, 'contenido' => $dom->saveHTML(), 'tema' => $request->input_tema
                ]);
            }
            else{
                            
                DB::table('knowledge')->where('id', $request->id)->update([
                    'titulo' => $request->Titulo, 'contenido' => $dom->saveHTML(), 'tema' => $request->select_tema
                ]);
            }
        }
        else{
            if($request->select_tema=="null"){
                DB::table('knowledge')->insert([
                    'titulo' => $request->Titulo, 'contenido' => $dom->saveHTML(), 'tema' => $request->input_tema, 'id_superuser' => Auth::id()
                ]);
            }
            else{
                DB::table('knowledge')->insert([
                    'titulo' => $request->Titulo, 'contenido' => $dom->saveHTML(), 'tema' => $request->select_tema, 'id_superuser' => Auth::id()
                ]);
            }
        }
        return redirect('/dashboard/knowledge');
    }
    
    public function drop(Request $request){
        if(isset($request->id)){
            DB::table('knowledge')->where('id', $request->id)->delete();
        }
        return redirect('/dashboard/knowledge');
    }
}
