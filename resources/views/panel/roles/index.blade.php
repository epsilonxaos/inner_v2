@extends('layouts.panel.app')
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
                        <div class="row">
                            <div class="col-12 col-sm-6"></div>
                            <div class="col-12 col-sm-6 text-center text-sm-right">
                                @can(PermissionKey::Role['permissions']['create']['name'])
                                    <a href="{{ route('panel.roles.create') }}" class="btn btn-success pt-2 pb-2" width="200px"><i class="fas fa-plus mr-2"></i> Nuevo rol</a>
                                @endcan
                            </div>
                        </div>
					</div>
					<div class="table-responsive pb-3">
						<table class="table align-items-center table-flush" id="dataTable">
							<thead class="thead-light">
								<tr>
									<th scope="col" class="sort" data-sort="status">Nombre</th>
									<th scope="col">Acciones</th>
								</tr>
							</thead>
							<tbody class="list">
								@if ((isset($data)) && (count($data) > 0))
                                    @foreach ($data as $row)
                                        <tr>
                                            <td>{{ $row->name }}</td>
                                            <td class="text-right">
                                                @can(PermissionKey::Role['permissions']['edit']['name'])
                                                    <a href="{{ route('panel.roles.edit', ['id' => $row->id]) }}" class="btn btn-default btn-sm"><i class="far fa-edit"></i> Editar</button>
                                                @endcan
                                                @can(PermissionKey::Role['permissions']['destroy']['name'])
                                                    <a href="javascript:;" class="btn btn-danger btn-sm btn-delete" data-axios-method="delete" data-route="{{ route('panel.roles.destroy', ['id' => $row->id]) }}" data-action="location.reload()"><i class="fas fa-trash-alt fa-lg"></i></button>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
							</tbody>
						</table>
					</div>
				</div>
			</div>
        </div>
    </div>
@endsection