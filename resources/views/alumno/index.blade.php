@extends('../layout/' . $layout)

@section('subhead')
    <title>Mis Datos - Titulación CUCEI</title>
@endsection

@section('subcontent')            
    <h1 class="titulo titulo--separado uppercase text-3xl mt-5">PROCESO DE TITULACIÓN</h1>
    <h3 class="descripcion">Para poder iniciar tu trámite de titulación</h3>

    <!-- Contenedor pasos -->
    <div class="pasos hidable-obj">
        <!-- Imagen laptop -->
        <img class="invisible sm:visible h-0 sm:h-60 md:h-72 lg:h-96" alt="Ilustración Prácticas Profesionales" src="{{ asset('build/assets/images/alumno-index2.png') }}">

        <!-- Contenedor "Fácil de empezar" -->
        <div class="pasos__contenedor">

            <!-- Wrap pasos -->
            <div class="space-y-2">
                <!-- Contenedor paso 1 -->
                <div class="pasos__item box p-2 zoom-in intro-x">
                    <h2 class="pasos__item-numero"> 01</h2>
                    <div>
                        <h1 class="pasos__item-titulo"><a href="https://practicas.cucei.udg.mx/empresa/convenio">Elige tu modalidad de titulación</a></h1>
                        <!--<h3 class="pasos__item-desc">Carga tu CV y tu NSS <a href="/alumno/documentos">-->
                        <!-- <i class="fa-solid fa-upload"></i></a></h3>-->
                    </div>
                </div>
                <!-- Contenedor paso 2 -->
                <div class="pasos__item box p-2 zoom-in intro-x">
                    <h2 class="pasos__item-numero"> 02</h2>
                    <div>
                        <h1 class="pasos__item-titulo"><a href="{{ route('show-documentos') }}" > Sube tus documentos</a></h1>                        
                    </div>
                </div>
                <!-- Contenedor paso 3 -->
                <div class="pasos__item box p-2 zoom-in intro-x">
                    <h2 class="pasos__item-numero"> 03</h2>
                    <div>
                        <h1 class="pasos__item-titulo">Recibe respuesta</h1>
                        <h3 class="pasos__item-desc">Validación de tus documentos o solicitud de correcciones</h3>
                    </div>
                </div>
                <!-- Contenedor paso 4 -->
                <div class="pasos__item box p-2 zoom-in intro-x">
                    <h2 class="pasos__item-numero"> 04</h2>
                    <div>
                        <h1 class="pasos__item-titulo"> Donec tincidunt, orci et mattis iaculis</h1>
                    </div>
                </div>
                <!-- Contenedor paso 5 -->
                <div class="pasos__item box p-2 zoom-in intro-x">
                    <h2 class="pasos__item-numero"> 05</h2>
                    <div>
                        <h1 class="pasos__item-titulo">Ut convallis efficitur mauris ut blandit</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
