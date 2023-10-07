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
        <div class="w-full min-h-screen p-5 md:p-20 flex items-center justify-center">
            <div class="w-96 intro-y">
                <img class="mx-auto w-32" alt="Logo udg" src="{{ asset('build/assets/images/logo.png') }}">
                <div class="text-white dark:text-slate-300 text-2xl font-medium text-center mt-6">Titulación CUCEI</div>
                <div class="text-white text-lg font-medium text-center">¡Ingrese a su cuenta!</div>
                <div class="box px-5 py-8 mt-10 max-w-[450px] relative before:content-[''] before:z-[-1] before:w-[95%] before:h-full before:bg-slate-200 before:border before:border-slate-200 before:-mt-5 before:absolute before:rounded-lg before:mx-auto before:inset-x-0 before:dark:bg-darkmode-600/70 before:dark:border-darkmode-500/60">
                    <form id="login-form" method="POST" action={{ route('log.siiau') }}>
                        @csrf
                        <input id="codigo" name="codigo" type="text" class="form-control py-3 px-4 block" placeholder="Código SIIAU">
                        <div id="error-codigo" class="login__input-error text-danger mt-2"></div>
                        <input id="password" name="password" type="password" class="form-control py-3 px-4 block mt-4" placeholder="Nip">
                        <div id="error-password" class="login__input-error text-danger mt-2"></div>
                           
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
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
    </script>
@endsection
