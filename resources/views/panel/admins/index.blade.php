@extends('layouts.panel.app')

@push('link')
    <style>
        .bg {
            width: 80px;
            height: 80px;
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
            border-radius: 80px;
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
                        {{-- <h3 class="mb-0">Light table</h3> --}}
                        <div class="row">
                            <div class="col-12 col-sm-6"></div>
                            <div class="col-12 col-sm-6 text-center text-sm-right">
                                @can(PermissionKey::Admin['permissions']['create']['name'])
                                    <a href="{{route('panel.admins.create')}}" class="btn btn-success pt-2 pb-2"><i class="fas fa-plus mr-2"></i> Agregar</a>
                                @endcan
                                @can(PermissionKey::Role['permissions']['index']['name'])
                                    <a href="{{route('panel.roles.index')}}" class="btn btn-primary pt-2 pb-2"><i class="fas fa-key mr-2"></i> Permisos</a>
                                @endcan
                            </div>
                        </div>
					</div>
                    <!-- Light table -->
					<div class="table-responsive pb-3">
						<table class="table align-items-center table-flush" id="dataTable">
							<thead class="thead-light">
								<tr>
									<th width="20px">
                                        {{-- <input type="checkbox" class="" id="customCheck1"> --}}
                                        {{-- <div class="custom-control custom-checkbox">
                                            <label class="custom-control-label" for="customCheck1"></label>
                                        </div> --}}
                                    </th>
									<th scope="col" class="sort" data-sort="budget">Avatar</th>
									<th scope="col" class="sort" data-sort="status">Nombre</th>
									<th scope="col">Correo</th>
									<th scope="col">Acciones</th>
								</tr>
							</thead>
							<tbody class="list">
								@if ((isset($data)) && (count($data) > 0))
                                    @foreach ($data as $row)
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="" id=""><span style="opacity:0;">{{ $row->id}}</span>
                                            </td>
                                            <td><div class="bg" style="background-image: url({{asset($row -> avatar)}});"></div></td>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->email }}</td>
                                            <td class="text-center">
                                                @can(PermissionKey::Admin['permissions']['edit']['name'])
                                                    <a class="btn btn-sm btn-info" href="{{ route('panel.admins.edit', ['id' => $row->id]) }}"><i class="fas fa-user-edit mr-2"></i> Editar</a>
                                                @endcan
                                                @can(PermissionKey::Admin['permissions']['destroy']['name'])
                                                    <a class="btn btn-sm btn-danger btn-delete" data-axios-method="delete" data-route="{{ route('panel.admins.destroy', ['id' => $row->id]) }}" data-action="location.reload()" href="javascript:;"><i class="fas fa-user-times"></i></a>
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