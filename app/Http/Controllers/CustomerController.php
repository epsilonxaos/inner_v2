<?php

namespace App\Http\Controllers;

use App\DataTableHelper;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    public function index ()
    {
        return view('panel.customer.index', [
            "title" => "Clientes",
            "breadcrumb" => [
                [
                    'title' => 'Listado',
                    'route' => 'panel.customer.index',
                    'active' => true
                ]
            ]
        ]);
    }

    public function getData()
    {
        
        $dataGet = User::join('customer', 'customer.id_user', '=', 'users.id')
            -> select([
                'users.id',
                DB::raw("CONCAT(customer.name,' ',customer.lastname) AS completeName"),
                'customer.email',
                'customer.phone'
            ]);


        return DataTables::of($dataGet)
            -> filterColumn('completeName', function($query, $keyword) {
                $query -> whereRaw("CONCAT(customer.name,' ',customer.lastname) like ?", ["%{$keyword}%"]);
            })
            -> addColumn('acciones', function($data) {
                $acciones = "";
                
                $acciones .= '<a href="'.route("panel.customer.edit", ["id" => $data -> id]).'" class="btn btn-info btn-sm"><i class="fas fa-edit mr-2"></i> Editar</a>';
                $acciones .= '<a href="'.route("panel.customer.edit", ["id" => $data -> id]).'" class="btn btn-primary btn-sm"><i class="fas fa-user mr-2"></i> Perfil</a>';
                $acciones .= '<a href="'.route("panel.customer.destroy", ["id" => $data -> id]).'" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>';

                return $acciones;
            })
            ->rawColumns(['acciones'])
            -> make();
    }
}
