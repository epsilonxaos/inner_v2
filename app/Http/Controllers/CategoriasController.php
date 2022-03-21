<?php

namespace App\Http\Controllers;

use App\Categorias;
use App\DataTableHelper;
use App\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CategoriasController extends Controller
{
    private $directorio = "public/categorias";

    public function index(String $seccion)
    {
        return view("panel.categorias.index", [
            "title" => "Categorias - ". Str::title($seccion),
            "breadcrumb" => [
                [
                    'title' => 'Listado',
                    'route' => 'panel.categorias.index',
                    'active' => true,
                    'params' => [
                        'seccion' => $seccion
                    ]
                ]
            ],
            "urlGetData" => route('panel.categorias.getData', ['seccion' => $seccion])
        ]);
    }

    public function getData(String $seccion)
    {
        $dataGet = Categorias::select(['id', 'title', 'created_at', 'status'])
            -> where('seccion', $seccion);

        return DataTables::of($dataGet)
        -> editColumn('created_at', function($data){
            return Helpers::dateSpanishShort($data -> created_at);
        })
        -> addColumn('visualizar', function($data) {
            $accion = '<div class="wp"> <input class="tgl tgl-light chkbx-toggle" type="checkbox" disabled/> <label class="tgl-btn toggle_'.$data -> id.'" for="toggle_'.$data -> id.'"></label> </div>';
            
            $accion = '<div class="wp">
                    <input class="tgl tgl-light chkbx-toggle" id="toggle_'.$data -> id.'" type="checkbox" value="'.$data -> id.'" '.($data -> status == 1 ? 'checked="checked"' : '').'"/>
                    <label class="tgl-btn toggle_'.$data -> id.'" for="toggle_'.$data -> id.'" onclick="changeStatusGeneral(\'toggle_'.$data -> id.'\', '.$data -> id.', '.($data -> status == 1 ? 0 : 1).', \''.route('panel.categorias.status') .'\')"></label>
                </div>';

            return $accion;
        })
        -> addColumn('acciones', function($data) use ($seccion) {
            $acciones = "";
            
            $acciones .= '<a href="'.route("panel.categorias.edit", ["id" => $data -> id, "seccion" => $seccion]).'" class="btn btn-info btn-sm"><i class="fas fa-edit mr-2"></i> Editar</a>';
            $acciones .= '<button type="button" data-url="'.route("panel.categorias.destroy", ["id" => $data -> id]).'" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>';

            return $acciones;
        })
        ->rawColumns(['visualizar', 'acciones'])
        -> make();
    }


    public function create(String $seccion)
    {
        return view("panel.categorias.create", [
            "title" => "Categorias - ". Str::title($seccion),
            "breadcrumb" => [
                [
                    'title' => 'Listado categorias',
                    'route' => 'panel.categorias.index',
                    'active' => false,
                    'params' => [
                        'seccion' => $seccion
                    ]
                ],
                [
                    'title' => 'Nueva categoria',
                    'route' => 'panel.categorias.create',
                    'active' => true,
                    'params' => [
                        'seccion' => $seccion
                    ]
                ]
            ],
        ]);
    }

    public function store(String $seccion, Request $request)
    {
        $add = new Categorias();

        if($request -> hasFile('cover')){
            $cover = Helpers::addFileStorage($request -> file('cover'), $this -> directorio);
            $add -> cover = $cover;
        }

        $add -> title = $request -> title;
        $add -> description = $request -> description;
        $add -> seccion = $seccion;
        $add -> save();

        return redirect() -> back() -> with('success', 'Registro creado correctamente!');
    }

    public function edit(String $seccion, Int $id)
    {
        return view("panel.categorias.edit", [
            "title" => "Categorias - ". Str::title($seccion),
            "breadcrumb" => [
                [
                    'title' => 'Listado categorias',
                    'route' => 'panel.categorias.index',
                    'active' => false,
                    'params' => [
                        'seccion' => $seccion
                    ]
                ],
                [
                    'title' => 'Editar categoria',
                    'route' => 'panel.categorias.edit',
                    'active' => true,
                    'params' => [
                        'seccion' => $seccion,
                        'id' => $id
                    ]
                ]
            ],
            'data' => Categorias::find($id)
        ]);
    }

    public function update(String $seccion, Int $id, Request $request)
    {
        $add = Categorias::find($id);

        if($request -> hasFile('cover')){
            Helpers::deleteFileStorage('categorias', 'cover', $id);
            $cover = Helpers::addFileStorage($request -> file('cover'), $this -> directorio);
            $add -> cover = $cover;
            $add -> save();
        }

        $add -> title = $request -> title;
        $add -> description = $request -> description;
        $add -> seccion = $seccion;
        $add -> save();

        return redirect() -> back() -> with('success', 'Registro actualizado correctamente!');
    }

    public function destroy(Int $id)
    {
        Helpers::deleteFileStorage('categorias', 'cover', $id);
        Categorias::find($id) -> delete();

        return redirect() -> back() -> with('success', 'Registro eliminado correctamente!');
    }

    public function changeStatus(Request $request)
    {
        Helpers::changeStatus('categorias', $request -> id, $request -> status);
        return 'true';
    }
}
