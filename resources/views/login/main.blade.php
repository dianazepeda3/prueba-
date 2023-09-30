@extends('../layout/' . $layout)

@section('head')
    <title>Titulación CUCEI</title>
@endsection

@section('content')
    <div class="container">
        <div class="w-full min-h-screen p-5 md:p-20 flex items-center justify-center">
            <div class="w-96 intro-y">
                <img class="mx-auto w-32" alt="Logo udg" src="{{ asset('build/assets/images/logo.png') }}">
                <div class="text-white dark:text-slate-300 text-2xl font-medium text-center mt-6">Titulación CUCEI</div>
                <div class="text-white text-lg font-medium text-center">¡Ingrese a su cuenta!</div>
                <div class="box px-5 py-8 mt-10 max-w-[450px] relative before:content-[''] before:z-[-1] before:w-[95%] before:h-full before:bg-slate-200 before:border before:border-slate-200 before:-mt-5 before:absolute before:rounded-lg before:mx-auto before:inset-x-0 before:dark:bg-darkmode-600/70 before:dark:border-darkmode-500/60">
                    <form id="login-form">
                        <input id="codigo" type="text" class="form-control py-3 px-4 block" placeholder="Código SIIAU">
                        <div id="error-codigo" class="login__input-error text-danger mt-2"></div>
                        <input id="password" type="password" class="form-control py-3 px-4 block mt-4" placeholder="Nip">
                        <div id="error-password" class="login__input-error text-danger mt-2"></div>
                    </form>                   
                    <div class="mt-5 xl:mt-8 text-center xl:text-left">
                        <button id="btn-login" class="btn btn-primary w-full xl:mr-3">Iniciar Sesión</button>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="module">
        (function () {
            async function login() {
                // Reset state
                $('#login-form').find('.login__input').removeClass('border-danger')
                $('#login-form').find('.login__input-error').html('')

                // Post form
                let codigo = $('#codigo').val()
                let password = $('#password').val()

                // Loading state
                $('#btn-login').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>')
                tailwind.svgLoader()
                await helper.delay(1500)

                axios.post(`login`, {
                    codigo: codigo,
                    password: password
                }).then(res => {
                    location.href = '/'
                }).catch(err => {
                    $('#btn-login').html('Iniciar Sesión')
                    if (err.response.data.message != 'Codigo o Nip incorrecto.') {
                        for (const [key, val] of Object.entries(err.response.data.errors)) {
                            $(`#${key}`).addClass('border-danger')
                            $(`#error-${key}`).html(val)
                        }
                    } else {
                        $(`#password`).addClass('border-danger')
                        $(`#error-password`).html(err.response.data.message)
                    }
                })
            }

            $('#login-form').on('keyup', function(e) {
                if (e.keyCode === 13) {
                    login()
                }
            })

            $('#btn-login').on('click', function() {
                login()
            })
        })()
    </script>
@endsection
