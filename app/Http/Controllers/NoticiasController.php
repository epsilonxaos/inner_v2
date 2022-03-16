<?php

namespace App\Http\Controllers;

use App\Categorias;
use App\Helpers;
use App\Noticias;
use Illuminate\Http\Request;

class NoticiasController extends Controller
{
    private $directorio = 'public/noticias';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Noticias::select('noticias.*', 'categorias.title as categoriaTitulo')
            -> join('categorias', 'noticias.categorias_id', '=', 'categorias.id')
            -> get();

        return view('panel.noticias.index', [
            'title' => 'Noticias',
            'breadcrumb' => [
                [
                    'title' => 'Listado',
                    'route' => 'panel.noticias.index',
                    'active' => true
                ]
            ],
            'lista' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.noticias.create', [
            'title' => 'Noticias',
            'breadcrumb' => [
                [
                    'title' => 'Listado noticias',
                    'route' => 'panel.noticias.index',
                    'active' => false
                ],
                [
                    'title' => 'Nueva noticia',
                    'route' => 'panel.noticias.create',
                    'active' => true
                ]
            ],
            'categorias' => Categorias::where([['seccion', '=', 'blog'], ['status', '=', 1]]) -> orderBy('title', 'desc') -> get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $add = new Noticias();

        if($request -> hasFile('portada')){
            $portada_name = Helpers::addFileStorage($request -> file('portada'), $this -> directorio);
        }

        $add -> portada = $portada_name;
        $add -> titulo = $request -> titulo;
        $add -> categorias_id = $request -> categorias_id;
        $add -> descripcion_corta = $request -> descripcion_corta;
        $add -> contenido = $request -> contenido;
        $add -> save();

        return redirect() -> back() -> with('success', 'Registro creado correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Noticias  $noticias
     * @return \Illuminate\Http\Response
     */
    public function show(Noticias $noticias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Noticias  $noticias
     * @return \Illuminate\Http\Response
     */
    public function edit(Int $id)
    {
        return view('panel.noticias.edit', [
            'title' => 'Noticias',
            'breadcrumb' => [
                [
                    'title' => 'Listado categorias',
                    'route' => 'panel.noticias.index',
                    'active' => false
                ],
                [
                    'title' => 'Editar noticia',
                    'route' => 'panel.noticias.edit',
                    'params' => [
                        "id" => $id
                    ],
                    'active' => true
                ]
                ],
                'noticia' =>  Noticias::find($id),
                'categorias' => Categorias::where([['seccion', '=', 'blog'], ['status', '=', 1]]) -> orderBy('title', 'desc') -> get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Noticias  $noticias
     * @return \Illuminate\Http\Response
     */
    public function update(Int $id, Request $request)
    {
        $upt = Noticias::find($id);
        if($request -> hasFile('portada')) {
            Helpers::deleteFileStorage('noticias', 'portada', $id);
            $portada_name = Helpers::addFileStorage($request -> file('portada'), $this -> directorio);
            $upt -> portada = $portada_name;
            $upt -> save();
        }

        $upt -> titulo = $request -> titulo;
        $upt -> categorias_id = $request -> categorias_id;
        $upt -> descripcion_corta = $request -> descripcion_corta;
        $upt -> contenido = $request -> contenido;
        $upt -> save();

        return redirect() -> back() -> with('success', 'Registro actualizado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Noticias  $noticias
     * @return \Illuminate\Http\Response
     */
    public function destroy(Int $id)
    {
        Helpers::deleteFileStorage('noticias', 'portada', $id);
        Noticias::where('id', $id) -> delete();

        return redirect() -> back() -> with('success', 'Registro eliminado correctamente!');
    }

    /**
     * Change status to show - hidden
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        Helpers::changeStatus('noticias', $request -> id, $request -> status);
        return 'true';
    }
}
