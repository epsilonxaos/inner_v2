@extends('layouts.panel.app')
@section('content')
    <!-- Header -->
    @include('includes.panel.header')
    <!-- Page content -->

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    @if ($errors->any())
                        <div class="alert alert-danger  pb-0 mb-0 mt-5 mr-5 ml-5" role="alert">  
                            @foreach ($errors->all() as $error)
                                <p class="">{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <div class="card-body mt-0">
                        <form action="{{ route('panel.seo.update', ['id' => $setting->id]) }}" method="POST" class="needs-validation" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <ul class="nav nav-pills mb-5 mt-lm-5 ml-lm-5" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-seo-tab" data-toggle="pill" href="#pills-seo" role="tab" aria-controls="pills-seo" aria-selected="true">General SEO</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-facebook-tab" data-toggle="pill" href="#pills-facebook" role="tab" aria-controls="pills-facebook" aria-selected="false">Facebook</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-analytics-tab" data-toggle="pill" href="#pills-analytics" role="tab" aria-controls="pills-analytics" aria-selected="false">Google Analytics</a>
                                </li>
                            </ul>
                            <div class="tab-content  ml-lm-5 mr-lm-5" id="pills-tabContent">
                                {{--APARTADO DE SEO--}}
                                <div class="tab-pane fade show active" id="pills-seo" role="tabpanel" aria-labelledby="pills-seo-tab">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-lg-8 col-md-8 col-sm-12">

                                            <div  class="form-group">
                                                <label for="nomuser" class=" control-label">Meta Autor</label>
                                                <div  class="input-group">
                                                    <input id="Author" name="metaAuthor" type="text" class="form-control" placeholder="Porfavor Ingrese el nombre del sitio" value="{{ (old('metaAuthor')) ? old('metaAuthor') : $setting->metaAuthor }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="ni ni-single-02 form-control-feedback"></i></span>
                                                    </div>
                                                </div>
                                             </div>

                                            <div id="e-check" class="form-group">
                                                <label for="tags" class=" control-label">Palabras Claves</label>
                                                <input type="text"  data-role="tagsinput" class="form-control" name="metaKeywords" style="display: none;" value="{{ (old('metaKeywords')) ? old('metaKeywords') : $setting->metaKeywords }}">
                                                <small class="text-muted form-help-text">Separar palabras por comas.</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="seo-descr" class=" control-label">Descripción</label>
                                                <textarea name="metaDescription" class="form-control" rows="3" id="seo-descr" data-counter="#seo-descr + small > strong">{{ (old('metaDescription')) ? old('metaDescription') : $setting->metaDescription }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="seo-cod" class=" control-label">Código</label>
                                                <textarea name="code" class="form-control" rows="5" id="seo-code" data-counter="#seo-code + small > strong">{{ (old('code')) ? old('code') : $setting->code }}</textarea>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                {{--FIN DEL APARTADO DE SEO--}}

                                {{--APARTADO DE FACEBOOK--}}
                                <div class="tab-pane fade" id="pills-facebook" role="tabpanel" aria-labelledby="pills-facebook-tab">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-lg-8 col-md-8 col-sm-12">
                                            <div  class="form-group">
                                                <label for="metaOgTitle" class=" control-label">Título</label>
                                                <div  class="input-group">
                                                    <input id="tituloFb" name="metaOgTitle" type="text" class="form-control" value="{{ (old('metaOgTitle')) ? old('metaOgTitle') : $setting->metaOgTitle }}" placeholder="Porfavor Ingrese el nombre del sitio">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="ni ni-single-02 form-control-feedback"></i></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="e-check" class="form-group">
                                                <label for="metaOgUrl" class=" control-label">URL del Sitio</label>
                                                <div  class="input-group">
                                                    <input id="metaOgUrl" name="metaOgUrl" value="{{ (old('metaOgUrl')) ? old('metaOgUrl') : $setting->metaOgUrl }}" type="text" class="form-control" placeholder="Porfavor Ingrese el nombre del sitio">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="ni ni-world-2 form-control-feedback"></i></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="metaOgDescription" class="control-label">Descripción</label>
                                                <div class=" form-message-dark has-feedback">
                                                    <textarea name="metaOgDescription" class="form-control" rows="3" id="seofb-descr" data-counter="#seofb-descr + small > strong">{{ (old('metaOgDescription')) ? old('metaOgDescription') : $setting->metaOgDescription }}</textarea>
                                                </div>
                                            </div>

                                            <div class="">
                                                <div class="form-group">
                                                    <input type="hidden" name="archivoFavicon" value="{{ asset( $setting->archivoFavicon) }}" id="previewFavicon-preset_file">
                                                    
                                                    <div class="custom-file-container fileWithPreview-elms" id="previewFavicon" data-upload-id="previewFavicon">
                                                        <label>*Favicon <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">&times;</a></label>
                                                        <label class="custom-file-container__custom-file" >
                                                            <input type="file" name="archivoFavicon" class="custom-file-container__custom-file__custom-file-input" accept=".ico" aria-label="Escoger archivo" >
                                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                                                        </label>
                                                        <small class="text-muted form-help-text">Subir Imagen para compartir, formato .ico</small>
                                                        <div class="custom-file-container__image-preview"></div>
                                                    </div>
                                                </div>
                                            </div>
                                          
                                            <div class="">
                                                <div class="form-group">
                                                    <input type="hidden" name="archivoOgImagen" value="{{ asset($setting->archivoOgImagen) }}" id="fileWithPreview-preset_file">
                                                    <div class="custom-file-container fileWithPreview-elms" id="fileWithPreview" data-upload-id="fileWithPreview">
                                                    <label>Subir Imagen Para Compartir en Facebook <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">&times;</a></label>
                                                        <label class="custom-file-container__custom-file" >
                                                            <input type="file" name="archivoOgImagen" class="custom-file-container__custom-file__custom-file-input" accept="" aria-label="Escoger archivo">
                                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                                                        </label>
                                                        <div class="custom-file-container__image-preview"></div>
                                                    
                                                    </div>
                                                </div>
                                            </div>

                                    </div>
                                    </div>
                                </div>
                                {{--FIN DEL APARTADO DE FACEBOOK--}}
                                
                                {{--APARTADO DE ANAKYTICS--}}
                                <div class="tab-pane fade" id="pills-analytics" role="tabpanel" aria-labelledby="pills-analytics-tab">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-lg-8 col-md-8 col-sm-12">
                                            <div  class="form-group">
                                                <label for="AnalytisID" class=" control-label">UA-ID</label>
                                                    <div  class="input-group">
                                                        <input id="AnalytisID" name="idAnalitics" type="text" class="form-control" placeholder="Ingrese el id de analytics, ej: UA-24233015-24"  value="{{ (old('idAnalitics')) ? old('idAnalitics') : $setting->idAnalitics }}">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="ni ni-tag form-control-feedback"></i></span>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div  class="form-group">
                                                <label for="sitemapxml" class="control-label">Sitemaps</label>
                                                <div class="form-message-dark has-feedback mb-4">
                                                    <label id="sitemapxml" class="custom-file px-file" for="px-file-sitemapxml">
                                                        <input type="file" id="px-file-sitemapxml" class="form-control" name="sitemap" value="{{ (old('sitemap')) ? old('sitemap') : $setting->sitemap }}">
                                                        <small class="text-muted">Subir archivo .XML </small>
                                                    </label>
                                                </div>
                                                <small class="text-muted">Su URL quedá así: <strong>{{(Request::root())}}/{{$setting->sitemap}}</strong></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--FIN DEL APARTADO DE ANAKYTICS--}}

                            </div>

                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-8 col-md-8 col-sm-12 ">
                                    @can(PermissionKey::Seo['permissions']['update']['name'])
                                        <button class="btn btn-default">Guardar</button>
                                    @endcan
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <div>
        </div>
    </div>
@endsection
