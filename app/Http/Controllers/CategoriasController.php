<?php

namespace App\Http\Controllers;

use App\Categorias;
use App\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
            "lista" => Categorias::where("seccion", $seccion) -> orderBy('created_at', 'desc') -> get()
        ]);
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
