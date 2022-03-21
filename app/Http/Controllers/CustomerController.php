<?php

namespace App\Http\Controllers;

use App\Customer;
use App\DataTableHelper;
use App\Http\Requests\StoreCustomer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
            ])
            -> orderBy('users.id','desc');


        return DataTables::of($dataGet)
            -> filterColumn('completeName', function($query, $keyword) {
                $query -> whereRaw("CONCAT(customer.name,' ',customer.lastname) like ?", ["%{$keyword}%"]);
            })
            -> addColumn('acciones', function($data) {
                $acciones = "";
                
                $acciones .= '<a data-tippy-content="Editar" href="'.route("panel.customer.edit", ["id" => $data -> id]).'" class="btn btn-info btn-sm"><i class="fas fa-edit fa-lg"></i></a>';
                $acciones .= '<a data-tippy-content="Ver perfil" href="'.route("panel.customer.edit", ["id" => $data -> id]).'" class="btn btn-primary btn-sm"><i class="far fa-address-card fa-lg"></i></a>';
                $acciones .= '<a data-tippy-content="Eliminar" href="'.route("panel.customer.destroy", ["id" => $data -> id]).'" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-lg"></i></a>';

                return $acciones;
            })
            ->rawColumns(['acciones'])
            -> make();
    }

    public function create()
    {
        return view("panel.customer.create", [
            "title" => "Cliente",
            "breadcrumb" => [
                [
                    'title' => 'Listado clientes',
                    'route' => 'panel.customer.index',
                    'active' => false
                ],
                [
                    'title' => 'Nuevo cliente',
                    'route' => 'panel.customer.create',
                    'active' => true
                ]
            ],
        ]);
    }

    public function store(StoreCustomer $request)
    {
        $request->validated();

        $id = User::insertGetId([
            'name' => $request -> name.' '.$request -> lastname,
            'email' => $request -> email,
            'email_verified_at' => now(),
            'password' => Hash::make($request -> password),
            'remember_token' => Str::random(10),
            'type' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Customer::insert([
            'id_user' => $id,
            'name' => $request -> name,
            'lastname' => $request -> lastname,
            'phone' => $request -> phone,
            'email' => $request -> email,
            'address' => $request -> address,
            'city' => $request -> city,
            'state' => $request -> state,
            'country' => $request -> country,
            'zip' => $request -> zip,
            'colony' => $request -> colony,
            'birthday' => $request -> birthday,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect() -> back() -> with('success', 'Registro creado correctamente');
    }
}
