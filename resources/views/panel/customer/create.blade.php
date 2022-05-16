@extends('layouts.panel.app')

@section('content')
    <!-- Header -->
    @include('includes.panel.header')

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <form action="{{route('panel.customer.store')}}" method="POST" enctype="multipart/form-data" class="form-submit-alert-wait">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-12 col-sm-6"><h3>Agregar nuevo cliente</h3></div>
                                <div class="col-12 col-sm-6 text-center text-sm-right">
                                    @can(PermissionKey::Noticias['permissions']['create']['name'])
                                        <button type="submit" class="btn btn-primary pt-2 pb-2"><i class="fas fa-save mr-2"></i> Guardar</button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="font-weight-bold">Informacion del cliente</h4>
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-4 mb-2">
                                        <div class="form-group">
                                            <label for="name">Nombre <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" value="{{old('name')}}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-4 mb-2">
                                        <div class="form-group">
                                            <label for="lastname">Apellidos <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="lastname" value="{{old('lastname')}}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-4 mb-2">
                                        <div class="form-group">
                                            <label for="email">E-mail <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" name="email" value="{{old('email')}}" required>
                                            @error('email')
                                                <div class="alert alert-danger small py-1 mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-4 mb-2">
                                        <div class="form-group">
                                            <label for="phone">Telefono <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="phone" value="{{old('phone')}}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-4 mb-2">
                                        <div class="form-group">
                                            <label for="password">Contraseña <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="password" value="{{old('password')}}" required>
                                            @error('password')
                                                <div class="alert alert-danger small py-1 mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-4 mb-2">
                                        <div class="form-group">
                                            <label for="password_confirmation">Confirmar contraseña <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="password_confirmation" value="{{old('password_confirmation')}}" required>
                                            @error('password_confirmation')
                                                <div class="alert alert-danger small py-1 mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-4 mb-2">
                                        <div class="form-group">
                                            <label for="birthday">Fecha nacimiento</label>
                                            <input type="text" class="form-control" name="birthday" value="{{old('birthday')}}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <h4 class="font-weight-bold">Informacion de direccion</h4>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="form-group">
                                            <label for="address">Direccion</label>
                                            <input type="text" class="form-control" name="address" value="{{old('address')}}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-4 mb-2">
                                        <div class="form-group">
                                            <label for="colony">Colonia</label>
                                            <input type="text" class="form-control" name="colony" value="{{old('colony')}}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-4 mb-2">
                                        <div class="form-group">
                                            <label for="city">Ciudad</label>
                                            <input type="text" class="form-control" name="city" value="{{old('city')}}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-4 mb-2">
                                        <div class="form-group">
                                            <label for="state">Estado</label>
                                            <input type="text" class="form-control" name="state" value="{{old('state')}}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-4 mb-2">
                                        <div class="form-group">
                                            <label for="country">Pais</label>
                                            <input type="text" class="form-control" name="country" value="{{old('country')}}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-4 mb-2">
                                        <div class="form-group">
                                            <label for="zip">Codigo postal</label>
                                            <input type="text" class="form-control" name="zip" value="{{old('zip')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            @can(PermissionKey::Noticias['permissions']['create']['name'])
                                <button type="submit" class="btn btn-primary pt-2 pb-2"><i class="fas fa-save mr-2"></i> Guardar</button>
                            @endcan
                        </div>
                    </div>
                </form>
			</div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $('.dropify').dropify();

        function limitText(limitField, limitNum) {
            if (limitField.value.length > limitNum) {
                limitField.value = limitField.value.substring(0, limitNum);
            } else {
                document.querySelector('.limitText').innerHTML = limitNum - limitField.value.length;
            }
        }
    </script>
@endpush
