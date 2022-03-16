<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Panel Administrativo para controlar los recursos">
    <meta name="author" content="Locker Agencia">
    <title>Panel</title>
    <!-- Favicon -->
    <link rel="icon" href="{{asset('panel/img/brand/favicon.png')}}" type="image/png">
    <!-- Fonts -->
    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700"> --}}
    <!-- Icons -->
    <link rel="stylesheet" href="{{asset('panel/vendor/nucleo/css/nucleo.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('panel/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" type="text/css">

    <link rel="stylesheet" href="{{asset('panel/dropify/css/dropify.min.css')}}">
    <link rel="stylesheet" href="{{asset('panel/dropify/css/dropify-multiple.min.css')}}">
    <link rel="stylesheet" href="{{asset('panel/alertify/alertify.min.css')}}">
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{asset('panel/css/custom.css?v=1.2.0')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('panel/css/main.css?v=1.2.0')}}" type="text/css">
    <style>
        .breadcrumb {
            padding: 6px 15px
        }
        .breadcrumb a {
            color: inherit !important;
            font-size: 12px;
        }
    </style>
    <style>
        .chtg {
            position: relative;
            z-index: 1;
        }
        .chtg input[type=checkbox],
        .chtg input[type=radio] {
        position: absolute;
        opacity: 0;
        z-index: -1;
        }

        .chtg label {
            position: relative;
            margin-right: 1em;
            padding-left: 2em;
            padding-right: 1em;
            line-height: 2;
            cursor: pointer;
            color: #525f7f;
            font-size: 14px;
        }
        .chtg label:before {
        box-sizing: border-box;
        content: " ";
        position: absolute;
        top: 0.3em;
        left: 0;
        display: block;
        width: 1.4em;
        height: 1.4em;
        border: 1px solid #adb6ca;
        border-radius: 0.25em;
        z-index: -1;
        }

        .chtg input[type=radio] + label::before {
        border-radius: 1em;
        }

        /* Checked */
        .chtg input[type=checkbox]:checked + label,
        .chtg input[type=radio]:checked + label {
        padding-left: 1em;
        color: #fff;
        }
        .chtg input[type=checkbox]:checked + label:before,
        .chtg input[type=radio]:checked + label:before {
        top: 0;
        width: 100%;
        height: 2em;
        background: #172b4d;
        border-color: #172b4d;
        }

        /* Transition */
        .chtg label,
        .chtg label::before {
        transition: 0.25s all ease;
        }
    </style>
    {{-- <link rel="stylesheet" href="{{asset('css/panel.css')}}"> --}}
    <style>
        .alertify-notifier.ajs-right .ajs-message.ajs-visible {
            padding: 9px 15px;
            color: #fff !important;
            background-color: #2dce89 !important;
        }

        .options-flotting {
            position: absolute;
            top: 5px;
            right: 5px;
            width: 100%;
            z-index: 1;
        }

        .options-flotting .item {
            height: 30px;
            width: 30px;
            margin-left: 5px;
            background-color: white;
            box-shadow: 0px 0px 10px -4px rgba(0, 0, 0, 0.278);
            border-radius: 3px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: .8;
            transition: all .3s ease
        }

        .options-flotting .item:hover {
            opacity: 1;
        }

        .options-flotting .item.delete {
            background-color: crimson;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js" integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>

        .dropzone {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
        }
        .dropzone .dz-message {
            margin: 0px;
            border-color: transparent;
            width: 100%;
        }
    </style>
    @stack('link')

</head>

<body>
    @include('includes.panel.sidebar')
    <!-- Main content -->
    <div class="main-content" id="panel">
        @include('includes.panel.navbar')
        @yield('content')
    </div>
    <script>
        const PATH = '{{asset('/')}}';
    </script>
    <script src="{{mix('panel/js/main.js')}}"></script>
    <script src="{{asset('panel/dropify/js/dropify.min.js')}}"></script>
    <script src="{{asset('panel/dropify/js/dropify-multiple.min.js')}}"></script>
    <script src="{{asset('panel/alertify/alertify.min.js')}}"></script>
    <script src="{{asset('panel/sweetalert/sweetalert.min.js')}}"></script>
    @stack('js')
    <script>

        alertify.set('notifier','position', 'top-right');

        $('.dropify').dropify();

        function limitText(limitField, limitNum) {
            if (limitField.value.length > limitNum) {
                limitField.value = limitField.value.substring(0, limitNum);
            } else {
                document.querySelector('.limitText').innerHTML = limitNum - limitField.value.length;
            }
        }

        function deleteSubmitForm(id){
            swal({
                title: "¿Finalizar eliminación?",
                icon: "warning",
                buttons: ["Cancelar", "Eliminar"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    alertify.alert('Espere un momento porfavor...').set({'frameless': true, 'closable': false, 'movable': false});
                    document.querySelector('.delete-form-'+id).submit();
                }
            });
        }
    </script>
</body>

</html>
