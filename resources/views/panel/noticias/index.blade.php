@extends('layouts.panel.app')

@push('link')
    <style>
        .bg {
            width: 170px;
            height: 100px;
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
        }

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
                                <h3 class="mb-0 mr-4">Listado de noticias</h3>
                            </div>
                            <div class="col-12 col-sm-6 text-center text-sm-right">
                                @can(PermissionKey::Noticias['permissions']['create']['name'])
                                    <a href="{{route('panel.noticias.create')}}" class="btn btn-success pt-2 pb-2"><i class="fas fa-plus mr-2"></i> Agregar</a>
                                @endcan
                            </div>
                        </div>
					</div>
                    <!-- Light table -->
					<div class="table-responsive pb-3">
						<table class="table align-items-center table-flush" id="dataTableInit" style="width:100%;">
							<thead class="thead-light">
								<tr>
									<th scope="col" class="sort" data-sort="portada" width="200px">Portada</th>
                                    <th scope="col" class="sort" data-sort="titulo">Titulo</th>
                                    <th scope="col" class="sort" data-sort="categoria">Categoria</th>
									<th scope="col" class="sort text-center" data-sort="fecha">Fecha publicación</th>
									<th scope="col" class="no-sort text-center" width="200px">Visualizar</th>
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
            'urlAjax': "{{ route('panel.noticias.getData') }}",
            'columns': [
                {  
                    data: 'portada',
                    name: 'noticias.portada',
                    orderable: false,
                    render: function(cover){
                        return `<div class="bg" style="background-image: url(${PATH+cover});"></div>`;
                    }
                },
                { data: 'titulo', name: 'noticias.titulo' },
                { data: 'title', name: 'categorias.title'  },
                { data: 'created_at', name: 'noticias.created_at' },
                { data: 'visualizar', name: 'visualizar' },
                { data: 'acciones', name: 'acciones' },
            ]
        }
    </script>
@endpush
