<?php

namespace App\Http\Controllers;

use App\Categorias;
use App\Helpers;
use App\PortafolioGaleria;
use App\Portafolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class PortafolioController extends Controller
{
    protected $directorio = "public/portafolio";
    protected $directorioGalerias = "public/portafolio/galeria";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Portafolio::select('portafolio.*', 'categorias.title AS nombreCategoria')
            -> join('categorias', 'portafolio.categoria_id', '=', 'categorias.id')
            -> orderBy('portafolio.id', 'desc') -> get();

        return view('panel.portafolio.list', [
            'title' => 'Portafolio',
            'breadcrumb' => [
                [
                    'title' => 'Listado',
                    'route' => 'panel.portafolio.index',
                    'active' => true
                ]
            ],
            'lista' => $all
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.portafolio.create', [
            'title' => 'Portafolio',
            'breadcrumb' => [
                [
                    'title' => 'Listado portafolio',
                    'route' => 'panel.portafolio.index',
                    'active' => false
                ],
                [
                    'title' => 'Nuevo',
                    'route' => 'panel.portafolio.create',
                    'active' => true
                ]
            ],
            'categorias' => Categorias::where([['seccion', '=', 'portafolio'], ['status', '=', 1]]) -> orderBy('title', 'desc') -> get()
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
        // dd($request -> all());
        $add = new Portafolio();
        $cover = Helpers::addFileStorage($request -> file('cover'), $this -> directorio);
        $portada = Helpers::addFileStorage($request -> file('portada'), $this -> directorio);

        $add -> cover = $cover;
        $add -> portada = $portada;
        $add -> nombre = $request -> nombre;
        $add -> categoria_id = $request -> categoria_id;
        $add -> descripcion = $request -> descripcion;
        $add -> save();

        return redirect() -> route('panel.portafolio.galeria.acciones', ['accion' => 'create', 'id' => $add -> id]) -> with('success', 'Registro creado correctamente!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createGaleria(String $accion, Int $id)
    {
        if($accion === 'edit')
        {
            $nameProduct = Portafolio::select('nombre') -> where('id', $id) -> first();
        }

        $info = [
            'title' => 'Galeria',
            'breadcrumb' => [
                [
                    'title' => 'Listado portafolio',
                    'route' => 'panel.portafolio.index',
                    'active' => false
                ],
                [
                    'title' => ($accion === 'edit') ? 'Editar portafolio - '.$nameProduct -> nombre : 'Nuevo portafolio',
                    'route' => ($accion === 'edit') ? 'panel.portafolio.edit' : 'panel.portafolio.create',
                    'active' => false,
                    'params' => ($accion === 'edit') ? ['id' => $id] : ''
                ],
                [
                    'title' => 'Galeria',
                    'route' => 'panel.portafolio.galeria.acciones',
                    'active' => true,
                    'params' => [
                        'accion' => $accion,
                        'id' => $id
                    ]
                ]
            ],
            'galeria' => PortafolioGaleria::where('portafolio_id', $id) -> orderBy('order', 'asc') -> get(),
            'id' => $id,
            'accion' => $accion
        ];
        return view('panel.portafolio.galeria.index', $info);
    }

    public function storeGaleria(Request $request) {
        $input = $request -> all();
        $rules = [
            'file' => 'mimes:jpeg,jpg,png|max:2048'
        ];

        $validation = Validator::make($input, $rules);

        if($validation -> fails())
        {
            return Response::json('Limite de peso excedido', 400);
        }

        $file = $request -> file('file');
        $cover = Helpers::addFileStorage($file, $this -> directorioGalerias);
        $add = new PortafolioGaleria();
        $add -> img = $cover;
        $add -> portafolio_id = $request -> id;
        $add -> save();
        $add -> order = $add -> id;
        $add -> save();

        return Response::json('success', 200);
    }

    /**
     * Reording files gallery
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ordenamiento(Request $request)
    {
        $orden = $request -> toArray();
        foreach ($orden as $key => $val) {
            $gal = PortafolioGaleria::find($val['id']);
            $gal -> order = $val['orden'];
            $gal -> save();
        }

        return 'true';
    }

    /**
     * Delete image gallery
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroyImageGallery(Request $request)
    {
        Helpers::deleteFileStorage('portafolio_galeria', 'img', $request -> id);
        PortafolioGaleria::where('id', $request -> id) -> delete();

        return 'true';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Portafolio  $portafolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Int $id)
    {
        return view('panel.portafolio.edit', [
            'title' => 'Portafolio',
            'breadcrumb' => [
                [
                    'title' => 'Listado portafolio',
                    'route' => 'panel.portafolio.index',
                    'active' => false
                ],
                [
                    'title' => 'Editar portafolio',
                    'route' => 'panel.portafolio.edit',
                    'params' => [
                        'id' => $id
                    ],
                    'active' => true
                ]
            ],
            'data' => Portafolio::find($id),
            'categorias' => Categorias::where([['seccion', '=', 'portafolio'], ['status', '=', 1]]) -> orderBy('title', 'desc') -> get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Portafolio  $portafolio
     * @return \Illuminate\Http\Response
     */
    public function update(Int $id, Request $request)
    {
        $upd = Portafolio::find($id);
        if($request -> hasFile('cover')) {
            Helpers::deleteFileStorage('portafolio', 'cover', $id);
            $cover = Helpers::addFileStorage($request -> file('cover'), $this -> directorio);
            $upd -> cover = $cover;
            $upd -> save();
        }
        if($request -> hasFile('portada')) {
            Helpers::deleteFileStorage('portafolio', 'portada', $id);
            $portada = Helpers::addFileStorage($request -> file('portada'), $this -> directorio);
            $upd -> portada = $portada;
            $upd -> save();
        }

        $upd -> nombre = $request -> nombre;
        $upd -> categoria_id = $request -> categoria_id;
        $upd -> descripcion = $request -> descripcion;
        $upd -> save();

        return redirect() -> back() -> with('success', 'Registro actualizado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Portafolio  $portafolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Int $id)
    {
        Helpers::deleteFileStorage('portafolio', 'cover', $id);
        Helpers::deleteFileStorage('portafolio', 'portada', $id);

        $galeria = PortafolioGaleria::where('portafolio_id', $id) -> get();
        foreach ($galeria as $val) {
            Helpers::deleteFileStorage('portafolio_galeria', 'img', $val -> id);
        }

        Portafolio::where('id', $id) -> delete();
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
        Helpers::changeStatus('portafolio', $request -> id, $request -> status);
        return 'true';
    }
}
