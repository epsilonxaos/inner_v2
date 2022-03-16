@extends('layouts.panel.app')

@section('content')
    <!-- Header -->
    @include('includes.panel.header')

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <form action="{{route('panel.portafolio.update', ['id' => $data -> id])}}" method="POST" enctype="multipart/form-data" class="form-submit-alert-wait">
                    @csrf
                    <input type="hidden" name="tipo" value="producto">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-12 col-sm-6"><h3>Editar registro</h3></div>
                                <div class="col-12 col-sm-6 text-center text-sm-right">
                                    <a href="{{route('panel.portafolio.galeria.acciones', ['accion' => 'edit', 'id' => $data -> id])}}" class="btn btn-default pt-2 pb-2"><i class="fas fa-images mr-2"></i> Editar galería</a>
                                    <button type="submit" class="btn btn-primary pt-2 pb-2"><i class="fas fa-save mr-2"></i> Guardar</button>
                                    {{-- @can(PermissionKey::Portafolio['permissions']['create']['name'])
                                    @endcan --}}
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-sm-6 mb-4">
                                        <label for="cover">Cover<span class="text-danger">*</span></label>
                                        <input type="file" name="cover" class="dropify" data-height="300" data-max-file-size="2M"  data-allowed-file-extensions="jpg jpeg png" data-default-file="{{asset($data -> cover)}}" />
                                        <small>Las medidas recomendadas son 670 x 396 px, solo se aceptan .jpg, .jpeg y .png con un maximo de peso de 2MB.</small>
                                    </div>
                                    <div class="col-12 col-sm-6 mb-4">
                                        <label for="portada">Portada <span class="text-danger">*</span></label>
                                        <input type="file" name="portada" class="dropify" data-height="300" data-max-file-size="2M"  data-allowed-file-extensions="jpg jpeg png" data-default-file="{{asset($data -> portada)}}" />
                                        <small>Las medidas recomendadas son 670 x 396 px, solo se aceptan .jpg, .jpeg y .png con un maximo de peso de 2MB.</small>
                                    </div>
                                    <div class="col-12 col-lg-6 mb-4">
                                        <div class="form-group">
                                            <label for="nombre">Titulo <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="nombre" value="{{(old('nombre')) ? old('nombre') :  $data -> nombre}}" required>
                                            @if($errors -> has('nombre'))
                                                <small class="text-danger pt-1">{{ $errors -> first('nombre') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 mb-4">
                                        <div class="form-group">
                                            <label for="categoria_id">Categoria <span class="text-danger">*</span></label>
                                            <select class="form-control" name="categoria_id" required>
                                                <option value="">Seleccione una opción</option>
                                                @php
                                                    $categorias_id = (old('categoria_id')) ? old('categoria_id') : $data -> categoria_id;
                                                @endphp
                                                @foreach ($categorias as $item)
                                                    <option {{$categorias_id == $item -> id ? 'selected' : ''}} value="{{$item -> id}}">{{$item -> title}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors -> has('categorias_id'))
                                                <small class="text-danger pt-1">{{ $errors -> first('categorias_id') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 mb-4">
                                        <label for="">Descripción</label>
                                        <small class="pb-2 d-block">Recomendamos siempre que al copiar y pegar información desde algun sitio o archivo <b>eliminar el formato</b> de los textos para un optimo funcionamiento, esto se puede realizar desde el mismo editor de texto presionando el siguiente botón <img src="{{asset('panel/img/clear-format.png')}}" alt="Clear format"></small>
                                        <textarea name="descripcion" class="trumbowyg-panel" cols="30" rows="10">{{(old('descripcion')) ? old('descripcion') : $data -> descripcion}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-primary pt-2 pb-2"><i class="fas fa-save mr-2"></i> Guardar</button>
                            {{-- @can(PermissionKey::Portafolio['permissions']['create']['name'])
                            @endcan --}}
                        </div>
                    </div>
                </form>
			</div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>    <link rel="stylesheet" href="/path/to/select2.css">

    <script type="text/javascript">
        $('.dropify').dropify();
        // $('.select-select2').select2({
        //     placeholder: 'Selecciona una opción',
        //     theme: 'bootstrap4'
        // });

        // function limitText(limitField, limitNum) {
        //     if (limitField.value.length > limitNum) {
        //         limitField.value = limitField.value.substring(0, limitNum);
        //     } else {
        //         document.querySelector('.limitText').innerHTML = limitNum - limitField.value.length;
        //     }
        // }
    </script>
@endpush
