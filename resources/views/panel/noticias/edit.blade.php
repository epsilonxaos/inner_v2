@extends('layouts.panel.app')

@section('content')
    <!-- Header -->
    @include('includes.panel.header')

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <form action="{{route('panel.noticias.update', ["id" => $noticia -> id])}}" method="POST" enctype="multipart/form-data" class="form-submit-alert-wait">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-12 col-sm-6"><h3>Editar noticia - <span class="text-primary">{{$noticia -> titulo}}</h3></div>
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
                                    <div class="col-12 mb-4">
                                        <label for="portada">Portada</label>
                                        <input type="file" name="portada" class="dropify" data-height="300" data-max-file-size="2M"  data-allowed-file-extensions="jpg jpeg png" data-default-file="{{asset($noticia -> portada)}}" />
                                        <small>Las medidas recomendadas son 670 x 396 px, solo se aceptan .jpg, .jpeg y .png con un maximo de peso de 2MB.</small>
                                    </div>
                                    <div class="col-12 col-sm-6 mb-4">
                                        <div class="form-group">
                                            <label for="titulo">Titulo <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="titulo" value="{{old('titulo') == '' ? $noticia -> titulo : old('titulo')}}">
                                            @if($errors -> has('titulo'))
                                                <small class="text-danger pt-1">{{ $errors -> first('titulo') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 mb-4">
                                        <div class="form-group">
                                            <label for="categoria_id">Categoria <span class="text-danger">*</span></label>
                                            <select class="form-control" name="categorias_id" id="categoria_id" required>
                                                <option value="">Selecciona una opción</option>
                                                @foreach ($categorias as $item)
                                                    <option {{$noticia -> categorias_id === $item -> id ? 'selected' : ''}} value="{{$item -> id}}">{{$item -> title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-4">
                                        <div class="form-group">
                                            <label for="descripcion_corta">Descripción corta</label>
                                            <small class="pb-2 d-block">Breve descripción o introducción a la noticia</small>
                                            <textarea class="form-control" name="descripcion_corta" rows="6" style="resize: none" onKeyDown="limitText(this.form.descripcion_corta, 150);" onKeyUp="limitText(this.form.descripcion_corta, 150);" maxlength="150">{{old('descripcion_corta') == '' ? $noticia -> descripcion_corta : old('descripcion_corta')}}</textarea>
                                            <small>Caracteres disponibles: <span class="limitText text-primary font-weight-bold">{{150 - strlen($noticia -> descripcion_corta)}}</span></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <label for="">Contenido</label>
                                        <small class="pb-2 d-block">Recomendamos siempre que al copiar y pegar información desde algun sitio o archivo <b>eliminar el formato</b> de los textos para un optimo funcionamiento, esto se puede realizar desde el mismo editor de texto presionando el siguiente botón <img src="{{asset('panel/img/clear-format.png')}}" alt="Clear format"></small>
                                        <textarea name="contenido" class="trumbowyg-panel" cols="30" rows="10">{{old('contenido') == '' ? $noticia -> contenido : old('contenido')}}</textarea>
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
