@extends('../layout/' . $layout)

@section('head')
    <title>Titulación CUCEI</title>
@endsection

@section('content')
    <style>
        @-webkit-keyframes spinner-border {
        to {
            transform: rotate(360deg);
        }
        }

        @keyframes spinner-border {
        to {
            transform: rotate(360deg);
        }
        }
        .spinner-border {
        display: inline-block;
        width: 2rem;
        height: 2rem;
        vertical-align: text-bottom;
        border: 0.25em solid currentColor;
        border-right-color: transparent;
        border-radius: 50%;
        -webkit-animation: .75s linear infinite spinner-border;
        animation: .75s linear infinite spinner-border;
        }        

        .spinner-border-sm {
        width: 1rem;
        height: 1rem;
        border-width: 0.2em;
        }
    </style>
    <div class="container">
        <div class="  fixed z-20  flex items-center h-16">              
            <a class="flex items-center text-white mr-1 sm:mr-5" href="{{ route('inicio-visitante') }}">
                <svg class="svg-inline--fa fa-venus-mars w-6 h-6 text-slate-500 mr-2 blanco" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>.blanco{fill:#ffffff}</style><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>                                                   
                <span class="float-right sm:float-none invisible sm:visible text-[0px] sm:text-sm">Atrás</span>
            </a>
            <a class="flex text-white mr-1 sm:mr-5" href="{{ route('manual_usuario') }}">
                <svg class="svg-inline--fa fa-book h-5 w-5 mr-3" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="book" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M96 0C43 0 0 43 0 96V416c0 53 43 96 96 96H384h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V384c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H384 96zm0 384H352v64H96c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16zm16 48H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16s7.2-16 16-16z"></path></svg><!-- <i class="mr-1 sm:mr-2 text-xl sm:text-xl fa-solid fa-book"></i> Font Awesome fontawesome.com -->
                <span class="float-right sm:float-none invisible sm:visible text-[0px] sm:text-sm">Manual de usuario</span>
            </a>
        </div>
         
        <div class="w-full min-h-screen p-5 flex items-center justify-center">
            <div class="w-96 intro-y">
                <img class="mx-auto w-32" alt="Logo udg" src="{{ asset('build/assets/images/logo.png') }}">
                <div class="text-white dark:text-slate-300 text-2xl font-medium text-center mt-6">Titulación CUCEI</div>
                <div class="text-white text-lg font-medium text-center">¡Ingrese a su cuenta!</div>
                <div class="box px-5 py-8 mt-10 max-w-[450px] relative before:content-[''] before:z-[-1] before:w-[95%] before:h-full before:bg-slate-200 before:border before:border-slate-200 before:-mt-5 before:absolute before:rounded-lg before:mx-auto before:inset-x-0 before:dark:bg-darkmode-600/70 before:dark:border-darkmode-500/60">
                    <ul class="nav nav-link-tabs" role="tablist">
                        <li id="example-5-tab" class="nav-item flex-1" role="presentation">
                            <button id="btnDocsEntregados" class="nav-link w-full py-2 active" data-tw-toggle="pill" data-tw-target="#example-tab-5" type="button" role="tab" aria-controls="example-tab-5" aria-selected="true">
                                Acceso SIIAU
                            </button>
                        </li>
                        <li id="example-6-tab" class="nav-item flex-1" role="presentation">
                            <button id="btnDocsGenerados" class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#example-tab-6" type="button" role="tab" aria-controls="example-tab-6" aria-selected="false">
                                Acceso
                            </button>
                        </li>
                    </ul>
                    <div class="mt-5" id="docs-entregados">
                        <form method="POST" action={{ route('log.siiau') }}>
                            @csrf
                            <input id="codigo" name="codigo" type="text" class="form-control py-3 px-4 block" placeholder="Código SIIAU">
                            <div id="error-codigo" class="login__input-error text-danger mt-2"></div>
                            <input id="password" name="password" type="password" class="form-control py-3 px-4 block mt-4" placeholder="Nip">
                            <div id="error-password" class="login__input-error text-danger mt-2"></div>
                            
                            @if ($errors->any())
                                <!--<div class="alert text-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>-->
                                <div id="error-nip" class="login__input-error text-danger mt-2">Credenciales Invalidas</div>
                            @endif

                            <div class="mt-5 xl:mt-8 text-center xl:text-left">
                                <button id="btn-login" class="btn btn-primary w-full xl:mr-3" type="submit" onclick="submitForm()">                                 
                                    Iniciar Sesión
                                </button>                        
                            </div>
                        </form>
                    </div>
                    <div class="mt-5" id="docs-generados" style="display: none">
                        <form method="POST" action={{ route('log.admin') }}>
                            @csrf
                            <input id="codigo" name="codigo" type="text" class="form-control py-3 px-4 block" placeholder="Correo Electrónico">
                            <div id="error-codigo" class="login__input-error text-danger mt-2"></div>
                            <input id="password" name="password" type="password" class="form-control py-3 px-4 block mt-4" placeholder="Contraseña">
                            <div id="error-password" class="login__input-error text-danger mt-2"></div>
                            
                            @if ($errors->any())
                                <!--<div class="alert text-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>-->
                                <div id="error-nip" class="login__input-error text-danger mt-2">Credenciales Invalidas</div>
                            @endif

                            <div class="mt-5 xl:mt-8 text-center xl:text-left">
                                <button id="btn-login" class="btn btn-primary w-full xl:mr-3" type="submit" onclick="submitForm()">                                 
                                    Iniciar Sesión
                                </button>                        
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function submitForm() {
            // Cambiar contenido del botón
            //$('#btn-login').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i> Comprobando tus datos...');
            $('#btn-login').html('<span class="spinner-border spinner-border-sm mr-2"></span> Comprobando tus datos...');
            // Deshabilitar el botón
            $('#btn-login').prop('disabled', true);
    
            // Enviar el formulario
            $('#login-form').submit();
        }
        document.getElementById("btnDocsEntregados").addEventListener("click", function () {
            document.getElementById("docs-entregados").style.display = "block";            
            document.getElementById("docs-generados").style.display = "none";
        });
        
        document.getElementById("btnDocsGenerados").addEventListener("click", function () {
            document.getElementById("docs-entregados").style.display = "none";
            document.getElementById("docs-generados").style.display = "block";
        });
    </script>
@endsection
