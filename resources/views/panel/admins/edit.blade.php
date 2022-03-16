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
                            <div class="col-8">
                                <h6 class="heading-small text-muted mb-4">Información del usuario</h6>
                            </div>
                            <div class="col-4 text-right">
                                <div class="dropdown">
                                    <a href="#!" class="btn btn-sm btn-default" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones</a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" style="">
                                        <a class="dropdown-item" href="{{ route('panel.admins.edit.password', ['id' => $admin->id]) }}">Actualizar contraseña</a>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
                    <!-- Light table -->
                    <div class="card-body">
                        <form action="{{ route('panel.admins.update', ['id' => $admin->id]) }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="dropzone-avatar" class="form-control-label">Avatar</label>
                                            {{-- <input class="form-control unfocus" type="text" name="avatar" id="avatar" value="{{ (old('avatar')) ? old('avatar') : $admin->avatar }}" data-asset="{{ asset('') }}" required>
                                            <a href="#modal-media" data-dropzone="image" data-toggle="modal" data-target="#modal-media" class="btn btn-default float-right mt-1">Escoger del multimedia</a>
                                            <div id="dropzone-avatar" data-route="{{ route('images.store') }}" data-target="#avatar" class="dropzone" style="border:0px">
                                                <div class="dz-default dz-message">Seleccionar archivo</div>
                                            </div> --}}
                                            {{$admin -> avatar}}
                                            <input type="file" name="avatar" class="dropify" data-height="300" data-default-file="{{asset($admin -> avatar)}}" />
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="role">Rol <span class="text-danger">*</span></label>
                                            <select name="role" id="role" class="form-control" required>
                                                <option value="">Selecciona una opción</option>
                                                @if ((isset($roles)) && (count($roles) > 0))
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}" {{ ($admin->hasRole($role->id)) ? 'selected' : '' }}>{{ $role->name }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="">sin contenido...</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="name">Nombre <span class="text-danger">*</span></label>
                                            <input type="text" name="name" id="name" class="form-control" required autocomplete="off" value="{{ $admin->name }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="email">Email <span class="text-danger">*</span></label>
                                            <input type="email" id="email" name="email" class="form-control" required autocomplete="off" value="{{ $admin->email }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    @can(PermissionKey::Admin['permissions']['update']['name'])
                                        <div class="col-lg-12 text-center">
                                            <button class="btn btn-default">Confirmar</button>
                                        </div>
                                    @endcan
                                </div>
                            </div>
                        </form>
                    </div>
				</div>
			</div>
        </div>
    </div>
    {{-- @include('includes.panel.media') --}}
@endsection

@push('js')
    <script type="text/javascript">
        $('.dropify').dropify();
    </script>
@endpush