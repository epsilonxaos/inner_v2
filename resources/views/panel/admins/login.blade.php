@extends('layouts.panel.login')
@section('content')
    <!-- Header -->
    <div class="header py-7 py-lg-8 pt-lg-9" style="    background: linear-gradient(87deg,#dadada 0,#ffffff 100%)!important;">
        <div class="container">
            <div class="header-body  text-center mb-5">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-6 col-md-8 py-3 bg-dark">
                        {{-- <h1 class="text-white">Welcome!</h1>
                        <p class="text-lead text-white">Use these awesome forms to login or create new account in your project for free.</p> --}}
                        <img class="col-md-12" src="{{ asset('img/logo.svg') }}" alt="Logo">
                    </div>
                </div>
            </div>
        </div>
        <div class="separator  separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-default" style="fill:#1f1f1f!important;" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary border-0 mb-0">
                    {{-- <div class="card-header bg-transparent pb-5">
                        <div class="text-muted text-center mt-2 mb-3">
                            <small>Inicia sesión</small>
                        </div>
                    </div> --}}
                    <div class="card-body px-lg-5 py-lg-5">
                        <form role="form" method="POST" action="{{ route('panel.admins.login') }}">
                            {{ csrf_field() }}
                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    <strong>Ups!</strong> El correo o contraseña son inválidos!
                                </div>
                            @endif
                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                <input name="email" class="form-control" placeholder="Email" type="email" value="{{ (old('email')) ? old('email') : '' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input name="password" class="form-control" placeholder="Contraseña" type="password">
                                </div>
                            </div>
                            <div class="custom-control custom-control-alternative custom-checkbox">
                                <input class="custom-control-input" name="remember" id=" customCheckLogin" type="checkbox">
                                <label class="custom-control-label" for=" customCheckLogin">
                                    <span class="text-muted">Recordarme</span>
                                </label>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-default my-4" style="background-color:#1f1f1f!important;">Continuar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <a href="{{ route('panel.admins.password.reset') }}" class="text-light"><small>Recuperar Contraseña?</small></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection