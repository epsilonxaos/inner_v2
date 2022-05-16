<?php

namespace App\Http\Controllers;

use App\Categorias;
use App\DataTableHelper;
use App\Helpers;
use App\Noticias;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

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
        return view('panel.noticias.index', [
            'title' => 'Noticias',
            'breadcrumb' => [
                [
                    'title' => 'Listado',
                    'route' => 'panel.noticias.index',
                    'active' => true
                ]
            ]
        ]);
    }

    public function getData()
    {
        $dataGet = Noticias::join('categorias', 'noticias.categorias_id', '=', 'categorias.id')
            -> select([
                'noticias.id',
                'noticias.portada',
                'noticias.titulo',
                'categorias.title',
                'noticias.created_at',
                'noticias.status',
            ])
            -> orderBy('noticias.id','desc');

        return DataTables::of($dataGet)
        -> editColumn('created_at', function($data){
            return Helpers::dateSpanishShort($data -> created_at);
        })
        -> addColumn('visualizar', function($data) {
            $accion = '<div class="wp"> <input class="tgl tgl-light chkbx-toggle" type="checkbox" disabled/> <label class="tgl-btn toggle_'.$data -> id.'" for="toggle_'.$data -> id.'"></label> </div>';
            
            $accion = '<div class="wp" data-tippy-content="Activar / Ocultar">
                    <input class="tgl tgl-light chkbx-toggle" id="toggle_'.$data -> id.'" type="checkbox" value="'.$data -> id.'" '.($data -> status == 1 ? 'checked="checked"' : '').'"/>
                    <label class="tgl-btn toggle_'.$data -> id.'" for="toggle_'.$data -> id.'" onclick="cambiarStatusGeneral(\'toggle_'.$data -> id.'\', '.$data -> id.', '.($data -> status == 1 ? 0 : 1).', \''.route('panel.noticias.status') .'\')"></label>
                </div>';

            return $accion;
        })
        -> addColumn('acciones', function($data) {
            $acciones = "";
            
            $acciones .= '<a href="'.route("panel.noticias.edit", ["id" => $data -> id]).'" class="btn btn-info btn-sm"><i class="fas fa-edit fa-lg"></i></a>';
            $acciones .= '<button type="button" data-url="'.route("panel.noticias.destroy", ["id" => $data -> id]).'" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-lg"></i></button>';

            return $acciones;
        })
        ->rawColumns(['visualizar', 'acciones'])
        -> make();
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

        return response()->json('true', 200);
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
