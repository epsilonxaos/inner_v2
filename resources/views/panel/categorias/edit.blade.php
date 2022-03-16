@extends('layouts.panel.app')

@section('content')
    <!-- Header -->
    @include('includes.panel.header')

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <form action="{{route('panel.categorias.update', ['seccion' => request('seccion'), 'id' => $data -> id])}}" method="POST" enctype="multipart/form-data" class="form-submit-alert-wait">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-12 col-sm-6"><h3>Editar categoria - <span class="text-primary">{{$data -> title}}</span></h3></div>
                                <div class="col-12 col-sm-6 text-center text-sm-right">
                                    <button type="submit" class="btn btn-primary pt-2 pb-2"><i class="fas fa-save mr-2"></i> Guardar</button>
                                    {{-- @can(PermissionKey::Noticias['permissions']['create']['name'])
                                    @endcan --}}
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    @if (request('seccion') === 'indefinido')
                                        <div class="col-12 mb-4">
                                            <label for="cover">Portada <span class="text-danger">*</span></label>
                                            <input type="file" name="cover" class="dropify" data-height="300" data-max-file-size="2M" data-default-file="{{asset($data -> cover)}}" data-allowed-file-extensions="jpg jpeg png" />
                                            <small>Las medidas recomendadas son 670 x 396 px, solo se aceptan .jpg, .jpeg y .png con un maximo de peso de 2MB.</small>
                                            @if($errors -> has('cover'))
                                                <br>
                                                <small class="text-danger pt-1">{{ $errors -> first('cover') }}</small>
                                            @endif
                                        </div>
                                    @endif
                                    <div class="col-12 col-sm-12 mb-4">
                                        <div class="form-group">
                                            <label for="title">Titulo <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="title" value="{{old('title') == '' ? $data -> title : old('title')}}" required>
                                            @if($errors -> has('title'))
                                                <small class="text-danger pt-1">{{ $errors -> first('title') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    @if (request('seccion') === 'indefinido')
                                        <div class="col-12 mb-4">
                                            <div class="form-group">
                                                <label for="description">Descripción corta</label>
                                                <small class="pb-2 d-block">Breve descripción o introducción sobre la categoria</small>
                                                <textarea class="form-control" name="description" rows="6" style="resize: none" onKeyDown="limitText(this.form.description, 150);" onKeyUp="limitText(this.form.description, 150);" maxlength="150">{{old('description') == '' ? $data -> description : old('description')}}</textarea>
                                                <small>Caracteres disponibles: <span class="limitText text-primary font-weight-bold">{{150 - strlen($data -> description)}}</span></small>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-primary pt-2 pb-2"><i class="fas fa-save mr-2"></i> Guardar</button>
                            {{-- @can(PermissionKey::Noticias['permissions']['create']['name'])
                            @endcan --}}
                        </div>
                    </div>
                </form>
			</div>
        </div>
    </div>
@endsection
