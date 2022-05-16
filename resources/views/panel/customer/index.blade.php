@extends('layouts.panel.app')

@push('link')
    <style>
        tbody {
            min-height: 300px;
        }
    </style>
@endpush

@section('content')
    <!-- Header -->
    @include('includes.panel.header')

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
				<div class="card">
				<!-- Card header -->
					<div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-12 col-sm-6">
                                <h3 class="mb-0 mr-4">Listado de clientes</h3>
                            </div>
                            <div class="col-12 col-sm-6 text-center text-sm-right">
                                @can(PermissionKey::Noticias['permissions']['create']['name'])
                                    <a href="{{route('panel.customer.create')}}" class="btn btn-success pt-2 pb-2"><i class="fas fa-plus mr-2"></i> Agregar</a>
                                @endcan
                            </div>
                        </div>
					</div>
                    <!-- Light table -->
					<div class="table-responsive pb-3">
						<table class="table align-items-center table-flush" id="dataTableInit" style="width:100%;">
							<thead class="thead-light">
								<tr>
                                    <th scope="col" class="sort" data-sort="titulo">Nombre</th>
                                    <th scope="col" class="sort" data-sort="categoria">Correo</th>
									<th scope="col" class="sort text-center" data-sort="fecha">Telefono</th>
									<th scope="col" class="no-sort text-center" width="150px">Acciones</th>
								</tr>
							</thead>
                            <tbody class="list"></tbody>
						</table>
					</div>
				</div>
			</div>
        </div>
    </div>
@endsection

@push('configDataTable')
    <script type="text/javascript">
        const dataTableOptions = {
            'urlAjax': "{{ route('panel.customer.getData') }}",
            'columns': [
                { data: 'completeName', name: 'completeName' },
                { data: 'email', name: 'customer.email' },
                { data: 'phone', name: 'customer.phone' },
                { data: 'acciones', name: 'acciones', orderable: false, searchable: false }
            ]
        }
    </script>
@endpush
