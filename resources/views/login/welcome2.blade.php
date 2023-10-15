@extends('../layout/index-layout')   

@section('subhead')
    <title>Trámites - Titulación CUCEI {{$layout}}</title>
@endsection

@section('subcontent')
    <div class="w-full fixed z-20 shadow-md">
        <div class="bg-primary flex items-center h-16">
            <!-- Logo de cucei -->
            <div class="pl-5">
                <img class="h-[2rem] sm:h-[2.8rem]" alt="Logo CUCEI" src="{{asset('build/assets/images/logo_cucei-udg_blanco.png')}}">
            </div>
            <div class="m-2 sm:m-4 h-10 w-[1px] bg-white"></div>
            <!-- Logo prácticas profesionales -->
            <a href="{{ route('inicio-visitante') }}" class="pr-5 flex flex-1 items-center">
                <img class="h-[1.9rem] sm:h-[2.5rem]" alt="Logo prácticas profesionales" src="{{asset('build/assets/images/Escudo_CUCEI.png')}}">
                <div class="logo font-medium text-golden text-xs sm:text-base ml-2 sm:ml-4 py-2 leading-4 sm:leading-5 w-3">
                    Titulación <span class="text-white">CUCEI</span>
                </div>
            </a>
            <!-- Logos de manual/iniciar sesión -->
            <div class="flex flex-1 justify-end space-x-1 mr-2">
                <a class="flex items-center text-white mr-1 sm:mr-5" href="{{ route('manual_usuario') }}">
                    <svg class="svg-inline--fa fa-book mr-1 sm:mr-2 text-xl sm:text-xl" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="book" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M96 0C43 0 0 43 0 96V416c0 53 43 96 96 96H384h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V384c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H384 96zm0 384H352v64H96c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16zm16 48H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16s7.2-16 16-16z"></path></svg><!-- <i class="mr-1 sm:mr-2 text-xl sm:text-xl fa-solid fa-book"></i> Font Awesome fontawesome.com -->
                    <span class="float-right sm:float-none invisible sm:visible text-[0px] sm:text-sm">Manual de usuario</span>
                </a>
                <!-- Autentificación para mostrar la opción "Iniciar sesión" o "Sistema" -->
                <a class="flex items-center text-white mr-1 sm:mr-5" href="{{ route('login') }}">
                    <svg class="svg-inline--fa fa-right-to-bracket mr-0 sm:mr-2 text-xl" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="right-to-bracket" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M352 96h64c17.7 0 32 14.3 32 32V384c0 17.7-14.3 32-32 32H352c-17.7 0-32 14.3-32 32s14.3 32 32 32h64c53 0 96-43 96-96V128c0-53-43-96-96-96H352c-17.7 0-32 14.3-32 32s14.3 32 32 32zm-7.5 177.4c4.8-4.5 7.5-10.8 7.5-17.4s-2.7-12.9-7.5-17.4l-144-136c-7-6.6-17.2-8.4-26-4.6s-14.5 12.5-14.5 22v72H32c-17.7 0-32 14.3-32 32v64c0 17.7 14.3 32 32 32H160v72c0 9.6 5.7 18.2 14.5 22s19 2 26-4.6l144-136z"></path></svg><!-- <i class="mr-0 sm:mr-2 text-xl fas fa-right-to-bracket"></i> Font Awesome fontawesome.com -->
                    <span class="float-right sm:float-none invisible sm:visible text-[0px] sm:text-sm">Iniciar sesión</span>
                </a>                                                        
            </div>
            <!--<a class="mx-1 sm:mx-5" href="https://practicas.cucei.udg.mx/oferta-programas">
                <div class="px-3 sm:px-5 py-2 w-fit rounded-b-xl rounded-t-xl drop-shadow font-extrabold text-sm sm:text-base bg-gradient-to-r from-yellow-500 to-golden text-elecBlue">
                Programas
                </div>
            </a>-->
        </div>                
    </div>
    <div class="relative z-10 pt-16">
        <div class="body-pagina bg-white">                        
            <div>
                <!-- Encabezado prácticas (Imagen + info) -->
                <div class="encabezado">
                    <!-- Contenedor para la imagen de fondo -->
                    <div style="background-image: url(/build/assets/images/cucei-fondo.jpg);" class="encabezado__fondo">
                </div>
                <!-- Wrap título y botón -->
                <div class="encabezado__wrap ">
                    <div class="text-center flex-row">
                        <h1 class="encabezado__titulo">Proceso de Titulación</h1>
                        <h2 class="encabezado__desc">
                           Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque congue erat eu lorem volutpat, sit amet mattis felis semper. Etiam gravida dictum elementum. 
                        </h2>
                    </div>
                    <!-- Contenedor botón 1 
                    <div class=".encabezado__btn-posicion">
                        <div style="width: 40.33%; padding:10px;"> </div>
                        <div class="encabezado__btn">
                            <a href="">
                                <div style="border: 0px;">
                                    <button class="encabezado__btn-titulo"> ¿Eres 
                                        <span class="font-extrabold">una empresa</span>? <br>
                                        <span class="encabezado__btn-subtitulo">¡Haz click aquí!</span>
                                    </button>
                                </div>
                            </a>
                        </div>
                        <a href="">
                            <div style="width: 60.33%; padding:78px; margin-right: 35px;"> </div>
                        </a>
                    </div>-->
                    <a href=""></a>
                </div>
                <a href=""></a>
            </div><a href=""></a>
        </div>
        <a href="">
            <!-- Divisor "Información para empresas" -->
            <div class="separador">
                <h1 class="separador__titulo">
                    Proceso de Titulación       
                </h1>
            </div>
        </a>
    </div>
    <a href=""></a>
    <section class="min-w-0 min-h-full"><a href="">
        <!--<h1 class="titulo titulo--separado uppercase text-2xl sm:text-3xl">M o d a l i d a d e s</h1>
        <h3 class="descripcion">Existen <span class="font-bold">dos modalidades</span> para la acreditación de la práctica
            profesional:
        </h3>
        <hr class="divisor">-->
        <!-- Sección oficio de asignación  
        <div class="mt-10 m-7 flex flex-col items-center text-center">
            <div class="contenedor-color">
                <h1 class="titulo2">Liberación de prácticas por 
                    <span class="font-bold">Oficio de Asignación</span>
                </h1>
            </div>
            <div class="mt-5 max-w-4xl">
                <h3 class="descripcion text-left">En esta modalidad, las prácticas profesionales son liberadas a través
                    de un 
                    <span class="font-bold">Oficio de Asignación</span> 
                    emitido por una empresa en la que realizas tu estancia.
                </h3>
            </div>
        </div>-->
        </a>
            <div class="pasos hidable-obj">
                <a href="">
                    <!-- Imagen videoconferencia? -->
                    <img class="invisible sm:visible max-h-[0rem] sm:max-h-[20rem] lg:max-h-[26rem]" alt="Ilustración Prácticas profesionales" src="https://practicas.cucei.udg.mx/dist/imagenes/practicas_oficio.jpg">
                    <!-- Contenedor "Empieza tus prácticas:" -->
                </a>
            <div class="pasos__contenedor">
                <a href="">
                    <span class="text-slate-500">Comienza </span>
                    <span class="text-primary"> tu proceso de titulación:</span>
                    <!-- Wrap pasos -->
                </a>
                <div class="mt-2 lg:mt-6 space-y-2">
                    <a href="">
                        <!-- Contenedor paso 1 -->
                    </a>
                    <div class="pasos__item">
                        <a href="">
                            <h2 class="pasos__item-numero"> 01</h2>
                        </a>
                        <div>
                            <a href="">
                                <h1 class="pasos__item-titulo">Registro</h1>
                            </a>
                            <h3 class="pasos__item-desc pasos__item-desc--hover">
                                <a href=""></a>
                                <a href="{{ route('manual_usuario_login') }}">Inicia sesión con tus credenciales de siiau para crear tu cuenta.</a>
                            </h3>
                        </div>
                    </div>
                    <!-- Contenedor paso 2 -->
                    <div class="pasos__item">
                        <h2 class="pasos__item-numero"> 02</h2>
                        <div class="flex flex-col justify-center">
                            <h1 class="pasos__item-titulo"><a href="{{ route('manual_usuario_modalidad') }}">Elige tu modalidad de titulación</a></h1>
                        </div>
                    </div>
                    <!-- Contenedor paso 3 -->
                    <div class="pasos__item">
                        <h2 class="pasos__item-numero"> 03</h2>
                        <div>
                            <h1 class="pasos__item-titulo">Carga tus Documentos</h1>
                            <h3 class="pasos__item-desc">Sube los documentos solicitados para tu modalidad</h3>
                        </div>
                    </div>
                    <!-- Contenedor paso 4 -->
                    <div class="pasos__item">
                        <h2 class="pasos__item-numero"> 04</h2>
                        <div>
                            <h1 class="pasos__item-titulo">Lorem ipsum dolor sit amet</h1>
                        </div>
                    </div>
                    <!-- Contenedor paso 5 -->
                    <div class="pasos__item">
                        <h2 class="pasos__item-numero"> 05</h2>
                        <div>
                            <h1 class="pasos__item-titulo">Duis dignissim.</h1>
                            <h3 class="pasos__item-desc">Nulla vel mi auctor, lobortis quam in, malesuada ante. Maecenas non orci quis.
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr class="divisor">
    <!-- Convenios vigentes 
    <section class="mt-10 min-w-0 min-h-full bg-gradient-to-t from-[#caddf5] relative">
        <div class="pt-16 mb-2 sm:mb-5 md:mb-10 text-center">
            <h3 class="text-base md:text-lg text-slate-500">Conoce nuestro listado de </h3>
            <h2 class="px-5 text-2xl sm:text-3xl md:text-4xl font-bold text-elecBlue tracking-widest">Convenios vigentes</h2>
        </div>
        <!-- Carrusel de imágenes     
            <div class="pt-10">
                <div class="px-0 sm:px-5 md:px-10 lg:px-32 pb-8">
                    <div class="tns-outer" id="tns1-ow">
                        <button type="button" data-action="stop">
                            <span class="tns-visually-hidden">stop animation</span> stop
                        </button>
                        <div class="tns-liveregion tns-visually-hidden" aria-live="polite" aria-atomic="true">slide 
                            <span class="current">4 to 9</span>  of 21
                        </div>
                        <div id="tns1-mw" class="tns-ovh">
                            <div class="tns-inner" id="tns1-iw">
                                <div class="multiple-items p-0 m-0 place-items-center flex sm:flex-none justify-center  tns-slider tns-carousel tns-subpixel tns-calc tns-horizontal" id="tns1" style="transform: translate3d(-9.09091%, 0px, 0px); transition-duration: 0s;">
                                    <div class="h-10 md:h-16 tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                                        <img class="carrusel__item object-cover w-full mr-5 lg:w-24" alt="Logo MOTORES ELECTROMEX DE MÉXICO S.A DE C.V." src="https://practicas.cucei.udg.mx/public/images/Empresa/790/5cflR8LUFPlUe4pjlN3XWaQDH0rQcHHkKxwjdT3K.png">
                                    </div>
                                    <div class="h-10 md:h-16 tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                                        <img class="carrusel__item object-cover w-full mr-5 lg:w-24" alt="Logo COMPAÑIA DULCERA MIVESA S.A. DE C.V." src="https://practicas.cucei.udg.mx/public/images/Empresa/791/cQjP0FWRKaYcKi4ZiPGgBFQdh6mjWpi5ooqxHj7z.jpg">
                                    </div>
                                    <div class="h-10 md:h-16 tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                                        <img class="carrusel__item object-cover w-full mr-5 lg:w-24" alt="Logo AMPERE CONSULTORÍA ELÉCTRICA MEXICANA " src="https://practicas.cucei.udg.mx/public/images/Empresa/793/zqCtDNQxkxg4IdJltE6fth76BqsLiX7kcQod5BFW.jpg">
                                    </div>
                                    <div class="h-10 md:h-16 tns-item tns-slide-cloned tns-slide-active">
                                        <img class="carrusel__item object-cover w-full mr-5 lg:w-24" alt="Logo RS CONSULTORES INGENIERIA SISMICA" src="https://practicas.cucei.udg.mx/public/images/Empresa/799/y1iMRdLhnB1MLXGPafx8IfwNswJY7CLVJYBt93OU.pdf">
                                    </div>
                                    <div class="h-10 md:h-16 tns-item tns-slide-cloned tns-slide-active">
                                        <img class="carrusel__item object-cover w-full mr-5 lg:w-24" alt="Logo CAMARENA AUTOMOTRIZ DE OCCIDENTE" src="https://practicas.cucei.udg.mx/public/images/Empresa/801/naglD117ycHZAHAT4cRLNz9BmV7WbvjCnzWajkIE.jpg">
                                    </div>
                                    <div class="h-10 md:h-16 tns-item tns-slide-cloned tns-slide-active">
                                        <img class="carrusel__item object-cover w-full mr-5 lg:w-24" alt="Logo LOGIFLEKK " src="https://practicas.cucei.udg.mx/public/images/Empresa/824/NIsXWbiJZh74wF2Tmtf0s6rKkR1nmHCL2yaw4l6b.jpg">
                                    </div>
                                    <div class="h-10 md:h-16 tns-item tns-slide-active" id="tns1-item0">
                                        <img class="carrusel__item object-cover w-full mr-5 lg:w-24" alt="Logo Henniges Automotive" src="https://practicas.cucei.udg.mx/public/images/Empresa/205/opoOGHCVCZQYyzUXMEAY3KKHZcHQotqD9lZLjkKl.jpg">
                                    </div>
                                    <div class="h-10 md:h-16 tns-item tns-slide-active" id="tns1-item1">
                                        <img class="carrusel__item object-cover w-full mr-5 lg:w-24" alt="Logo Oracle De México, S.A. De C.V." src="https://practicas.cucei.udg.mx/public/images/Empresa/301/I6RMmvPVvU6JhjzLhGOjgeWcEUhFYN2p1HKyazAL.jpg">
                                    </div>
                                    <div class="h-10 md:h-16 tns-item tns-slide-active" id="tns1-item2">
                                        <img class="carrusel__item object-cover w-full mr-5 lg:w-24" alt="Logo FR Autopartes" src="https://practicas.cucei.udg.mx/public/images/Empresa/457/s3kGlsJBgQKPbEMrLw7JdTEDqx7UQN6w6w8TqizJ.jpg">
                                    </div>
                                    <div class="h-10 md:h-16 tns-item" id="tns1-item3" aria-hidden="true" tabindex="-1">
                                        <img class="carrusel__item object-cover w-full mr-5 lg:w-24" alt="Logo DITRA ESTRATEGIAS DIGITALES S.A. DE C.V." src="https://practicas.cucei.udg.mx/public/images/Empresa/548/7d5b3Qu9C357rwcO9J0S3Cbgg657ypVrOxCxV0u7.png">
                                    </div>
                                    <div class="h-10 md:h-16 tns-item" id="tns1-item4" aria-hidden="true" tabindex="-1">
                                        <img class="carrusel__item object-cover w-full mr-5 lg:w-24" alt="Logo Uniformes Lazzar" src="https://practicas.cucei.udg.mx/public/images/Empresa/646/1XPN1oer3oTAWueYt7JKT7BG5ZXHmBHmGFPMG2hJ.jpg">
                                    </div>
                                    <div class="h-10 md:h-16 tns-item" id="tns1-item5" aria-hidden="true" tabindex="-1">
                                        <img class="carrusel__item object-cover w-full mr-5 lg:w-24" alt="Logo Rey Botanero" src="https://practicas.cucei.udg.mx/public/images/Empresa/730/PuTEp75fzzws0lvViANJSujaTjX6iOjYGV817RY5.png">
                                    </div>
                                    <div class="h-10 md:h-16 tns-item" id="tns1-item6" aria-hidden="true" tabindex="-1">
                                        <img class="carrusel__item object-cover w-full mr-5 lg:w-24" alt="Logo Smarttie Digital Lab" src="https://practicas.cucei.udg.mx/public/images/Empresa/752/UnoOBlcObpQjAVXOPBaXuVyJAkBx0GmMdVVjFQE4.png">
                                    </div>
                                    <div class="h-10 md:h-16 tns-item" id="tns1-item7" aria-hidden="true" tabindex="-1">
                                        <img class="carrusel__item object-cover w-full mr-5 lg:w-24" alt="Logo Equipos Tácticos y Tecnologicos de Seguridad" src="https://practicas.cucei.udg.mx/public/images/Empresa/754/BBQ4ARdCWDX4KXytg7bVqONZGkKyxL5LlSNzZymO.png">
                                    </div>
                                    <div class="h-10 md:h-16 tns-item" id="tns1-item8" aria-hidden="true" tabindex="-1">
                                        <img class="carrusel__item object-cover w-full mr-5 lg:w-24" alt="Logo LOGIS PACK" src="https://practicas.cucei.udg.mx/public/images/Empresa/767/nMRVTUIfLOtOH596mV37YEkoLfzenscfjekTfLct.png">
                                    </div>
                                    <div class="h-10 md:h-16 tns-item" id="tns1-item9" aria-hidden="true" tabindex="-1">
                                        <img class="carrusel__item object-cover w-full mr-5 lg:w-24" alt="Logo Sunningdale Tech" src="https://practicas.cucei.udg.mx/public/images/Empresa/768/JzzJEpjnTA4ftBV2nGe0FTeX5LdLkBCSoVBSTxyA.png">
                                    </div>
                                    <div class="h-10 md:h-16 tns-item" id="tns1-item10" aria-hidden="true" tabindex="-1">
                                        <img class="carrusel__item object-cover w-full mr-5 lg:w-24" alt="Logo SANSTORE" src="https://practicas.cucei.udg.mx/public/images/Empresa/773/qsBz4HLnrhYrkjSrqwgVnAbB89b25P8NUWZ6uAOW.png">
                                    </div>
                                    <div class="h-10 md:h-16 tns-item" id="tns1-item11" aria-hidden="true" tabindex="-1">
                                        <img class="carrusel__item object-cover w-full mr-5 lg:w-24" alt="Logo LABORATORIO DE ANALISIS CLINICOS Y MICROBIOLOGICOS INFECTIO" src="https://practicas.cucei.udg.mx/public/images/Empresa/775/HPBLW6RHYdFwqrg4kPl0JqBpDDu32kfapNTQzWwO.png">
                                    </div>
                                    <div class="h-10 md:h-16 tns-item" id="tns1-item12" aria-hidden="true" tabindex="-1">
                                        <img class="carrusel__item object-cover w-full mr-5 lg:w-24" alt="Logo Moti Digital" src="https://practicas.cucei.udg.mx/public/images/Empresa/777/ZtUOlmTLsEYx8NS0BycxTUhVa2b8TfrsFHbm74Zy.jpg">
                                    </div>
                                    <div class="h-10 md:h-16 tns-item" id="tns1-item13" aria-hidden="true" tabindex="-1">
                                        <img class="carrusel__item object-cover w-full mr-5 lg:w-24" alt="Logo DESARROLLO LOGISTICO, S.A. DE C.V." src="https://practicas.cucei.udg.mx/public/images/Empresa/784/G3UJK44MTu78m9MJEsCqNhlgA2MlKcCAUWAwKnLJ.png">
                                    </div>
                                    <div class="h-10 md:h-16 tns-item" id="tns1-item14" aria-hidden="true" tabindex="-1">
                                        <img class="carrusel__item object-cover w-full mr-5 lg:w-24" alt="Logo GRUPO CONVERTIDORA DE PAPEL" src="https://practicas.cucei.udg.mx/public/images/Empresa/789/L5w1zN4UozjRXLy8suwd7hiszUkjHwrY6CBMoXi6.png">
                                    </div>
                                    <div class="h-10 md:h-16 tns-item" id="tns1-item15" aria-hidden="true" tabindex="-1">
                                        <img class="carrusel__item object-cover w-full mr-5 lg:w-24" alt="Logo MOTORES ELECTROMEX DE MÉXICO S.A DE C.V." src="https://practicas.cucei.udg.mx/public/images/Empresa/790/5cflR8LUFPlUe4pjlN3XWaQDH0rQcHHkKxwjdT3K.png">
                                    </div>
                                    <div class="h-10 md:h-16 tns-item" id="tns1-item16" aria-hidden="true" tabindex="-1">
                                        <img class="carrusel__item object-cover w-full mr-5 lg:w-24" alt="Logo COMPAÑIA DULCERA MIVESA S.A. DE C.V." src="https://practicas.cucei.udg.mx/public/images/Empresa/791/cQjP0FWRKaYcKi4ZiPGgBFQdh6mjWpi5ooqxHj7z.jpg">
                                    </div>
                                    <div class="h-10 md:h-16 tns-item" id="tns1-item17" aria-hidden="true" tabindex="-1">
                                        <img class="carrusel__item object-cover w-full mr-5 lg:w-24" alt="Logo AMPERE CONSULTORÍA ELÉCTRICA MEXICANA " src="https://practicas.cucei.udg.mx/public/images/Empresa/793/zqCtDNQxkxg4IdJltE6fth76BqsLiX7kcQod5BFW.jpg">
                                    </div>
                                    <div class="h-10 md:h-16 tns-item" id="tns1-item18" aria-hidden="true" tabindex="-1">
                                        <img class="carrusel__item object-cover w-full mr-5 lg:w-24" alt="Logo RS CONSULTORES INGENIERIA SISMICA" src="https://practicas.cucei.udg.mx/public/images/Empresa/799/y1iMRdLhnB1MLXGPafx8IfwNswJY7CLVJYBt93OU.pdf">
                                    </div>
                                    <div class="h-10 md:h-16 tns-item" id="tns1-item19" aria-hidden="true" tabindex="-1">
                                        <img class="carrusel__item object-cover w-full mr-5 lg:w-24" alt="Logo CAMARENA AUTOMOTRIZ DE OCCIDENTE" src="https://practicas.cucei.udg.mx/public/images/Empresa/801/naglD117ycHZAHAT4cRLNz9BmV7WbvjCnzWajkIE.jpg">
                                    </div>
                                    <div class="h-10 md:h-16 tns-item" id="tns1-item20" aria-hidden="true" tabindex="-1">
                                        <img class="carrusel__item object-cover w-full mr-5 lg:w-24" alt="Logo LOGIFLEKK " src="https://practicas.cucei.udg.mx/public/images/Empresa/824/NIsXWbiJZh74wF2Tmtf0s6rKkR1nmHCL2yaw4l6b.jpg">
                                    </div>
                                    <div class="h-10 md:h-16 tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                                        <img class="carrusel__item object-cover w-full mr-5 lg:w-24" alt="Logo Henniges Automotive" src="https://practicas.cucei.udg.mx/public/images/Empresa/205/opoOGHCVCZQYyzUXMEAY3KKHZcHQotqD9lZLjkKl.jpg">
                                    </div>
                                    <div class="h-10 md:h-16 tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                                        <img class="carrusel__item object-cover w-full mr-5 lg:w-24" alt="Logo Oracle De México, S.A. De C.V." src="https://practicas.cucei.udg.mx/public/images/Empresa/301/I6RMmvPVvU6JhjzLhGOjgeWcEUhFYN2p1HKyazAL.jpg">
                                    </div>
                                    <div class="h-10 md:h-16 tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                                        <img class="carrusel__item object-cover w-full mr-5 lg:w-24" alt="Logo FR Autopartes" src="https://practicas.cucei.udg.mx/public/images/Empresa/457/s3kGlsJBgQKPbEMrLw7JdTEDqx7UQN6w6w8TqizJ.jpg">
                                    </div>
                                    <div class="h-10 md:h-16 tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                                        <img class="carrusel__item object-cover w-full mr-5 lg:w-24" alt="Logo DITRA ESTRATEGIAS DIGITALES S.A. DE C.V." src="https://practicas.cucei.udg.mx/public/images/Empresa/548/7d5b3Qu9C357rwcO9J0S3Cbgg657ypVrOxCxV0u7.png">
                                    </div>
                                    <div class="h-10 md:h-16 tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                                        <img class="carrusel__item object-cover w-full mr-5 lg:w-24" alt="Logo Uniformes Lazzar" src="https://practicas.cucei.udg.mx/public/images/Empresa/646/1XPN1oer3oTAWueYt7JKT7BG5ZXHmBHmGFPMG2hJ.jpg">
                                    </div>
                                    <div class="h-10 md:h-16 tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                                        <img class="carrusel__item object-cover w-full mr-5 lg:w-24" alt="Logo Rey Botanero" src="https://practicas.cucei.udg.mx/public/images/Empresa/730/PuTEp75fzzws0lvViANJSujaTjX6iOjYGV817RY5.png">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- Carrusel de imágenes 
    </section>
    <hr class="divisor">-->
    <!-- Sección Experiencia Laboral  
    <section class="relative">
        <div class="pt-24 sm:pt-36 flex flex-col items-center text-center">
            <div class="contenedor-color">
                <h1 class="titulo2">Liberación de prácticas por <span class="font-bold">Experiencia
                        Laboral</span></h1>
            </div>
            <div class="mt-5 max-w-4xl">
                <h2 class="descripcion text-left">Si eres 
                    <span class="font-bold">trabajador en un área afín a tu perfil de programa de estudio</span>
                    , puedes solicitar esta modalidad de liberación.
                </h2>
            </div>
        </div>

        <div class="flex flex-initial justify-center items-center align-middle hidable-obj">
            <!-- Contenedor "Empieza tus prácticas:" 
            <div class="ml-10 mt-4 text-[27px] md:text-3xl lg:text-4xl¿ font-extrabold leading-none">
                <span class="text-slate-500">Libera </span>
                <span class="text-primary"> tus prácticas:</span>
                <!-- Wrap pasos 
                <div id="faq-accordion-2" class="accordion space-y-4 mt-10">
                    <!-- Botón Requisitos laborales 
                    <div class="accordion-item text-base">
                        <div id="faq-accordion-content-2" class="accordion-header accordion__content w-fit">
                            <button class="accordion-button" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-2" aria-expanded="true" aria-controls="faq-accordion-collapse-2">
                                <div class="flex">
                                    <div class="accordion__numero">01</div>
                                    <div class="max-w-[410px] flex flex-col justify-center">
                                        <span class="accordion__title text-darkElecBlue font-extrabold">Requisitos
                                            laborales</span>
                                        <span class="accordion__desc">Consulta si eres candidato
                                            para liberar tus
                                            prácticas por esta modalidad.
                                        </span>
                                    </div>
                                </div>
                            </button>
                        </div>
                        <!-- Para mostrar un listado se agrega la clase "show" 
                        <div id="faq-accordion-collapse-2" class="accordion-collapse collapse" aria-labelledby="faq-accordion-content-2" data-tw-parent="#faq-accordion-2">
                            <div class="accordion-body accordion__collapse">
                                ● Tener como mínimo 3 y medio meses laborando.
                                <br> ● La empresa tiene que estar dada de alta como persona moral.
                            </div>
                        </div>
                    </div>

                    <!-- Botón Entrega tu documentación 
                    <div class="accordion-item text-base">
                        <div id="faq-accordion-content-3" class="accordion-header accordion__content w-fit">
                            <button class="accordion-button" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-3" aria-expanded="true" aria-controls="faq-accordion-collapse-3">
                                <div class="flex">
                                    <div class="accordion__numero">02</div>
                                    <div class="max-w-[410px] flex flex-col justify-center">
                                        <span class="accordion__title text-darkElecBlue font-extrabold">Entrega
                                            tu documentación
                                        </span>
                                        <span class="accordion__desc">Entrega a la 
                                            <span class="font-bold">Unidad de Vinculación</span> 
                                            tus cartas, fichas y bitácora.
                                            Consulta los formatoshaciendo 
                                            <span class="font-extrabold text-elecBlue">clickaquí.</span>
                                        </span>
                                    </div>
                                </div>
                            </button>
                        </div>
                        <!-- Para mostrar un listado se agrega la clase "show" 
                        <div id="faq-accordion-collapse-3" class="accordion-collapse collapse" aria-labelledby="faq-accordion-content-3" data-tw-parent="#faq-accordion-3">
                            <div class="accordion-body accordion__collapse">
                                <a href="dist/documentos_descarga/13-ficha-de-registro-laboral.docx" class="pasos__item-desc--hover" download="13-ficha-de-registro-laboral.docx"><svg class="svg-inline--fa fa-link text-elecBlue" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="link" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg=""><path fill="currentColor" d="M579.8 267.7c56.5-56.5 56.5-148 0-204.5c-50-50-128.8-56.5-186.3-15.4l-1.6 1.1c-14.4 10.3-17.7 30.3-7.4 44.6s30.3 17.7 44.6 7.4l1.6-1.1c32.1-22.9 76-19.3 103.8 8.6c31.5 31.5 31.5 82.5 0 114L422.3 334.8c-31.5 31.5-82.5 31.5-114 0c-27.9-27.9-31.5-71.8-8.6-103.8l1.1-1.6c10.3-14.4 6.9-34.4-7.4-44.6s-34.4-6.9-44.6 7.4l-1.1 1.6C206.5 251.2 213 330 263 380c56.5 56.5 148 56.5 204.5 0L579.8 267.7zM60.2 244.3c-56.5 56.5-56.5 148 0 204.5c50 50 128.8 56.5 186.3 15.4l1.6-1.1c14.4-10.3 17.7-30.3 7.4-44.6s-30.3-17.7-44.6-7.4l-1.6 1.1c-32.1 22.9-76 19.3-103.8-8.6C74 372 74 321 105.5 289.5L217.7 177.2c31.5-31.5 82.5-31.5 114 0c27.9 27.9 31.5 71.8 8.6 103.9l-1.1 1.6c-10.3 14.4-6.9 34.4 7.4 44.6s34.4 6.9 44.6-7.4l1.1-1.6C433.5 260.8 427 182 377 132c-56.5-56.5-148-56.5-204.5 0L60.2 244.3z"></path></svg> Ficha de
                                    registro laboral</a>
                                <a href="dist\documentos_descarga\14-carta-de-solicitud.docx" class="pasos__item-desc--hover" download="14-carta-de-solicitud.docx"> <br><svg class="svg-inline--fa fa-link text-elecBlue" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="link" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg=""><path fill="currentColor" d="M579.8 267.7c56.5-56.5 56.5-148 0-204.5c-50-50-128.8-56.5-186.3-15.4l-1.6 1.1c-14.4 10.3-17.7 30.3-7.4 44.6s30.3 17.7 44.6 7.4l1.6-1.1c32.1-22.9 76-19.3 103.8 8.6c31.5 31.5 31.5 82.5 0 114L422.3 334.8c-31.5 31.5-82.5 31.5-114 0c-27.9-27.9-31.5-71.8-8.6-103.8l1.1-1.6c10.3-14.4 6.9-34.4-7.4-44.6s-34.4-6.9-44.6 7.4l-1.1 1.6C206.5 251.2 213 330 263 380c56.5 56.5 148 56.5 204.5 0L579.8 267.7zM60.2 244.3c-56.5 56.5-56.5 148 0 204.5c50 50 128.8 56.5 186.3 15.4l1.6-1.1c14.4-10.3 17.7-30.3 7.4-44.6s-30.3-17.7-44.6-7.4l-1.6 1.1c-32.1 22.9-76 19.3-103.8-8.6C74 372 74 321 105.5 289.5L217.7 177.2c31.5-31.5 82.5-31.5 114 0c27.9 27.9 31.5 71.8 8.6 103.9l-1.1 1.6c-10.3 14.4-6.9 34.4 7.4 44.6s34.4 6.9 44.6-7.4l1.1-1.6C433.5 260.8 427 182 377 132c-56.5-56.5-148-56.5-204.5 0L60.2 244.3z"></path></svg>Carta de
                                    solicitud</a>
                                <a href="dist\documentos_descarga\15-carta-de-acreditacion.docx" class="pasos__item-desc--hover" download="15-carta-de-acreditacion.docx"> <br><svg class="svg-inline--fa fa-link text-elecBlue" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="link" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg=""><path fill="currentColor" d="M579.8 267.7c56.5-56.5 56.5-148 0-204.5c-50-50-128.8-56.5-186.3-15.4l-1.6 1.1c-14.4 10.3-17.7 30.3-7.4 44.6s30.3 17.7 44.6 7.4l1.6-1.1c32.1-22.9 76-19.3 103.8 8.6c31.5 31.5 31.5 82.5 0 114L422.3 334.8c-31.5 31.5-82.5 31.5-114 0c-27.9-27.9-31.5-71.8-8.6-103.8l1.1-1.6c10.3-14.4 6.9-34.4-7.4-44.6s-34.4-6.9-44.6 7.4l-1.1 1.6C206.5 251.2 213 330 263 380c56.5 56.5 148 56.5 204.5 0L579.8 267.7zM60.2 244.3c-56.5 56.5-56.5 148 0 204.5c50 50 128.8 56.5 186.3 15.4l1.6-1.1c14.4-10.3 17.7-30.3 7.4-44.6s-30.3-17.7-44.6-7.4l-1.6 1.1c-32.1 22.9-76 19.3-103.8-8.6C74 372 74 321 105.5 289.5L217.7 177.2c31.5-31.5 82.5-31.5 114 0c27.9 27.9 31.5 71.8 8.6 103.9l-1.1 1.6c-10.3 14.4-6.9 34.4 7.4 44.6s34.4 6.9 44.6-7.4l1.1-1.6C433.5 260.8 427 182 377 132c-56.5-56.5-148-56.5-204.5 0L60.2 244.3z"></path></svg>Carta de
                                    acreditación</a>
                                <a href="dist\documentos_descarga\16-bitacora-de-actividades.docx" class="pasos__item-desc--hover" download="16-bitacora-de-actividades.docx"> <br><svg class="svg-inline--fa fa-link text-elecBlue" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="link" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg=""><path fill="currentColor" d="M579.8 267.7c56.5-56.5 56.5-148 0-204.5c-50-50-128.8-56.5-186.3-15.4l-1.6 1.1c-14.4 10.3-17.7 30.3-7.4 44.6s30.3 17.7 44.6 7.4l1.6-1.1c32.1-22.9 76-19.3 103.8 8.6c31.5 31.5 31.5 82.5 0 114L422.3 334.8c-31.5 31.5-82.5 31.5-114 0c-27.9-27.9-31.5-71.8-8.6-103.8l1.1-1.6c10.3-14.4 6.9-34.4-7.4-44.6s-34.4-6.9-44.6 7.4l-1.1 1.6C206.5 251.2 213 330 263 380c56.5 56.5 148 56.5 204.5 0L579.8 267.7zM60.2 244.3c-56.5 56.5-56.5 148 0 204.5c50 50 128.8 56.5 186.3 15.4l1.6-1.1c14.4-10.3 17.7-30.3 7.4-44.6s-30.3-17.7-44.6-7.4l-1.6 1.1c-32.1 22.9-76 19.3-103.8-8.6C74 372 74 321 105.5 289.5L217.7 177.2c31.5-31.5 82.5-31.5 114 0c27.9 27.9 31.5 71.8 8.6 103.9l-1.1 1.6c-10.3 14.4-6.9 34.4 7.4 44.6s34.4 6.9 44.6-7.4l1.1-1.6C433.5 260.8 427 182 377 132c-56.5-56.5-148-56.5-204.5 0L60.2 244.3z"></path></svg> Bitácora</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Imagen certificado -
            <img class="ml-5 invisible sm:visible max-h-[0rem] sm:max-h-[20rem] lg:max-h-[26rem]" alt="Ilustración Prácticas profesionales" src="https://practicas.cucei.udg.mx/dist/imagenes/certificado.jpg">
        </div>

        <!--<div class="waves">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
                <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
                <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
            </svg>
        </div>
    </section>     -->                   
    <!-- El encabezado va aquí -->
    <!-- Footer -->
    <footer>
        <div class="footer">
            <div class="footer__info">
                <div class="flex justify-center shrink-0 items-center">
                    <img class="footer__info-img" alt="Logo CUCEI" src="{{asset('build/assets/images/logo_cucei-udg_blanco.png')}}">
                </div>

                <div class="flex justify-center">
                    <div class="flex flex-col justify-center items-center mx-4">
                        <span class="footer__info-titulo">Unidad de Vinculación</span><br>
                        <span class="footer__info-subtitulo"><span class="text-golden font-bold">Correo:</span> uvinc@cucei.udg.mx</span><br>
                        <!-- <span class="footer__info-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span> -->
                    </div>
                    <!--<div class="footer__info-wrap-links">
                        <a href="https://practicas.cucei.udg.mx">Información para <span class="font-bold text-golden">practicantes</span></a>
                        <span>|</span>
                        <a href="">Información para <span class="font-bold text-golden">empresas</span></a>
                    </div>-->
                </div>

                <!-- <span class="px-5 footer__info-desc leading-4">
                    <br> UNIVERSIDAD DE GUADALAJARA
                    <br> <span class="font-bold">CENTRO UNIVERSITARIO DE CIENCIAS EXACTAS E INGENIERÍAS</span>
                    <br> Blvd. Marcelino García Barragán #1421, esq Calzada Olímpica, C.P. 44430, Guadalajara, Jalisco, México.
                    <br> <span class="font-bold">Teléfono: +52 (33) 1378 5900.</span>
                </span> -->
            </div>
            <!-- <div class="pb-5 flex items-center justify-between">
                <div class="flex w-fit justify-center text-center py-3 px-0 md:px-3 mx-8 mr-28 mb-5 bg-[#F1A544] rounded-l-[30px] rounded-tr-[30px] animate-bounce">
                    <span class="px-2 md:px-4 text-base md:text-lg font-bold">¿Necesitas ayuda?</span>
                </div>
            </div> -->
            <div class="footer__info-leyenda">
                <span>Derechos reservados ©2022 - 2023. Universidad de Guadalajara. </span>
            </div>
        </div>
    </footer>

    <!-- Ícono de chat 
    <div class="chat-icon__position">
        <button class="chat-icon">
            <svg class="svg-inline--fa fa-comment-dots chat-icon__img intro-y" aria-hidden="true" focusable="false" data-prefix="far" data-icon="comment-dots" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M144 208C126.3 208 112 222.2 112 239.1C112 257.7 126.3 272 144 272s31.1-14.25 31.1-32S161.8 208 144 208zM256 207.1c-17.75 0-31.1 14.25-31.1 32s14.25 31.1 31.1 31.1s31.1-14.25 31.1-31.1S273.8 207.1 256 207.1zM368 208c-17.75 0-31.1 14.25-31.1 32s14.25 32 31.1 32c17.75 0 31.99-14.25 31.99-32C400 222.2 385.8 208 368 208zM256 31.1c-141.4 0-255.1 93.12-255.1 208c0 47.62 19.91 91.25 52.91 126.3c-14.87 39.5-45.87 72.88-46.37 73.25c-6.624 7-8.373 17.25-4.624 26C5.818 474.2 14.38 480 24 480c61.49 0 109.1-25.75 139.1-46.25c28.87 9 60.16 14.25 92.9 14.25c141.4 0 255.1-93.13 255.1-207.1S397.4 31.1 256 31.1zM256 400c-26.75 0-53.12-4.125-78.36-12.12l-22.75-7.125L135.4 394.5c-14.25 10.12-33.87 21.38-57.49 29c7.374-12.12 14.37-25.75 19.87-40.25l10.62-28l-20.62-21.87C69.81 314.1 48.06 282.2 48.06 240c0-88.25 93.24-160 207.1-160s207.1 71.75 207.1 160S370.8 400 256 400z"></path></svg>
        </button>
    </div>-->
    </div>        
@endsection