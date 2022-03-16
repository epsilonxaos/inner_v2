@extends('layouts.panel.app')

@push('link')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js" integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <style>
        .bg {
            width: 100%;
            height: auto;
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .bg img {
            width: 100%;
            opacity: 0;
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
                {{-- <form action="{{route('panel.portafolio.store')}}" method="POST" enctype="multipart/form-data" class="form-submit-alert-wait">
                    @csrf
                    @method('PUT') --}}
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-12 col-sm-6"><h3>Galeria de imágenes (Ópcional)</h3></div>
                                <div class="col-12 col-sm-6 text-center text-sm-right">
                                    @if ($accion === 'edit')
                                        <a href="{{route('panel.portafolio.index')}}" class="btn btn-primary pt-2 pb-2"><i class="fas fa-save mr-2"></i> Guardar y regresar</a>
                                    @else
                                        <a href="{{route('panel.portafolio.create')}}" class="btn btn-primary pt-2 pb-2"><i class="fas fa-save mr-2"></i> Guardar y finalizar</a>
                                    @endif
                                    {{-- @can(PermissionKey::Portafolio['permissions']['create']['name'])
                                    @endcan --}}
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <p>Las medidas recomendadas son 670 x 396 px, solo se aceptan los formatos .jpg, .jpeg y .png con un maximo de peso de <span class="text-danger font-weight-bold">2MiB</span>. Solo se permite subir un <span class="text-danger font-weight-bold">máximo de 20 imágenes por carga</span>, para continuar presione el boton de <span class="text-defautl font-weight-bold">guardar imagenes</span> para subir nuevas imágenes.</p>
                                        <form action="{{route('panel.portafolio.galeria.store')}}" method="POST" enctype="multipart/form-data" id="my-dropzone" class="dropzone mt-3" style="border: 2px dashed #d6d6d6;">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$id}}">
                                            <div class="dz-message">
                                                Suelta tus archivos aquí
                                            </div>
                                        </form>
                                        <div class="text-center pt-3">
                                            @if ($accion === 'edit')
                                                <a href="{{route('panel.portafolio.galeria.acciones', ['accion' => 'edit', 'id' => $id])}}" class="btn btn-default"><i class="fas fa-save mr-2"></i> Guardar imágenes</a>
                                            @else
                                                <a href="{{route('panel.portafolio.galeria.acciones', ['accion' => 'create', 'id' => $id])}}" class="btn btn-default"><i class="fas fa-save mr-2"></i> Guardar imágenes</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12"> <hr> </div>
                                    <div class="col-12">
                                        <div class="row" id="sortable-items" data-url="{{route('panel.portafolio.galeria.ordenamiento')}}">
                                            @if (count($galeria) > 0)
                                                @foreach ($galeria as $item)
                                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3 position-relative sort px-2" data-orden="{{$item -> order}}" data-idx="{{$item -> id}}">
                                                        <div class="options-flotting d-flex align-items-center justify-content-end pr-3">
                                                            <div class="item drag" title="Mover"><i class="fas fa-arrows-alt fa-lg text-default"></i></div>
                                                            <div class="item delete delete-axios" data-url="{{route('panel.portafolio.galeria.destroy')}}" data-idx="{{$item -> id}}" title="Eliminar"><i class="fas fa-trash fa-lg text-white"></i></div>
                                                        </div>
                                                        <div class="bg" style="background-image: url({{asset($item -> img)}})">
                                                            <img src="{{asset('panel/img/blank.gif')}}" alt="Base" class="w-100">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            @if ($accion === 'edit')
                                <a href="{{route('panel.portafolio.index')}}" class="btn btn-primary pt-2 pb-2"><i class="fas fa-save mr-2"></i> Guardar y regresar</a>
                            @else
                                <a href="{{route('panel.portafolio.create')}}" class="btn btn-primary pt-2 pb-2"><i class="fas fa-save mr-2"></i> Guardar y finalizar</a>
                            @endif
                            {{-- @can(PermissionKey::Portafolio['permissions']['create']['name'])
                            @endcan --}}
                        </div>
                    </div>
                {{-- </form> --}}
			</div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        Dropzone.options.myDropzone = {
            paramName: 'file',
            maxFiles: 20,
            maxFilesize: 2,
            maxThumbnailFilesize: 2,
            autoProcessQueue: true,
            acceptedFiles: ".png,.jpg,.jpeg",
            init: function() {
                this.on("error", function (file, errorMessage) {
                    // this.removeFile(file);
                    console.log(errorMessage);

                    let msg = document.querySelector('.messages-alerts');
                    msg.innerHTML = `<div class="alert alert-danger" role="alert"> <small> ${errorMessage}</small>  </div>`;

                    setTimeout(() => {
                        msg.innerHTML = '';
                    }, 4000);
                });
                // this.on("queuecomplete", function(file) {
                //     setTimeout(() => {
                //         this.removeAllFiles();
                //     }, 4000);
                // });
                // this.on("success",
                //     this.processQueue.bind(this)
                // );
            }
        };
    </script>
@endpush
