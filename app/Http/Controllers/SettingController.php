<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use App\Setting;
class SettingController extends Controller
{
    public function index(){
        $registrouno = Setting::first();
        $info = [
            'title' => '',
            'breadcrumb' => [
                [
                    'title' => 'Configurar SEO',
                    'route' => 'panel.seo.index',
                    'active' => true
                ]
            ]
        ];
        $info['data'] = Role::all();
        if($setting = Setting::find($registrouno->id)){
            $setting = Setting::find($registrouno->id);
            return view('panel.seo.index', compact('setting'),$info);
        }else{
            $setting['setting'];
            return view('panel.seo.index',compact('setting'),$info);
        }
    }

    public function edit($id)
    {
      
    }

    public function update(Request $request, $id)
    {   
        $request->validate([
            'metaAuthor' => 'required|string',
            'metaKeywords' => 'required|string',
            'metaDescription' => 'required|string',
        ]);
        
        $arr = $request->toArray();
        if($request->file('archivoFavicon')){
            $arr['archivoFavicon'] = Setting::upload($request->file('archivoFavicon'), 'public/seo');
        }
        if($request->file('archivoOgImagen')){
            $arr['archivoOgImagen'] = Setting::upload($request->file('archivoOgImagen'), 'public/seo');
        }
        if($request->file('sitemap')){
            $arr['sitemap'] = Setting::upload($request->file('sitemap'), 'public/seo');
        }
        Setting::find($id)->update($arr);
        //Sí es desde una petición API, seguramente se está actualizando el status (checkbox)
        if(isset($arr['api'])){
            //Con esta respuesta debe mostrar el mensaje de success
            return response(['success' => true], 200);
        }else{
            return back()->with('success', 'Se ha guardado con éxito');
        }

    }


}
