<?php

namespace App\Http\Controllers;

use App\Galeria;
use App\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class GaleriaController extends Controller
{

    private $directorio = "public/galerias";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(String $seccion)
    {
        return view("panel.galeria.index", [
            "title" => "Galeria - ". Str::title($seccion),
            "breadcrumb" => [
                [
                    'title' => 'Listado',
                    'route' => 'panel.galeria.index',
                    'active' => true,
                    'params' => [
                        'seccion' => $seccion
                    ]
                ]
            ],
            "lista" => Galeria::where("seccion", $seccion) -> orderBy('created_at', 'desc') -> get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(String $seccion)
    {
        return view("panel.galeria.create", [
            "title" => "Galeria - ". Str::title($seccion),
            "breadcrumb" => [
                [
                    'title' => 'Listado galeria',
                    'route' => 'panel.galeria.index',
                    'active' => false,
                    'params' => [
                        'seccion' => $seccion
                    ]
                ],
                [
                    'title' => 'Nuevas imagenes',
                    'route' => 'panel.galeria.create',
                    'active' => true,
                    'params' => [
                        'seccion' => $seccion
                    ]
                ]
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(String $seccion, Request $request)
    {
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
        $cover = Helpers::addFileStorage($file, $this -> directorio);
        $add = new Galeria();
        $add -> cover = $cover;
        $add -> titulo = $request -> titulo;
        $add -> save();
        $add -> order = $add -> id;
        $add -> save();

        return Response::json('success', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Galeria  $galeria
     * @return \Illuminate\Http\Response
     */
    public function show(Galeria $galeria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Galeria  $galeria
     * @return \Illuminate\Http\Response
     */
    public function edit(Galeria $galeria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Galeria  $galeria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Galeria $galeria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Galeria  $galeria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Galeria $galeria)
    {
        //
    }
}
