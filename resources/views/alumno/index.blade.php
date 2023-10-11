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
        <img class="" alt="Ilustración Prácticas Profesionales" src="{{ asset('build/assets/images/alumno-index2.png') }}">

        <!-- Contenedor "Fácil de empezar" 
        <div class="pasos__contenedor">

            <!-- Wrap pasos 
            <div class="space-y-2">
                <!-- Contenedor paso 1
                <div class="pasos__item box p-2 zoom-in intro-x">
                    <h2 class="pasos__item-numero"> 01</h2>
                    <div>
                        <h1 class="pasos__item-titulo"><a href="https://practicas.cucei.udg.mx/empresa/convenio">Carga Documentos</a></h1>
                        <!--<h3 class="pasos__item-desc">Carga tu CV y tu NSS <a href="/alumno/documentos"><svg class="svg-inline--fa fa-upload" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="upload" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M288 109.3V352c0 17.7-14.3 32-32 32s-32-14.3-32-32V109.3l-73.4 73.4c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l128-128c12.5-12.5 32.8-12.5 45.3 0l128 128c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L288 109.3zM64 352H192c0 35.3 28.7 64 64 64s64-28.7 64-64H448c35.3 0 64 28.7 64 64v32c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V416c0-35.3 28.7-64 64-64zM432 456c13.3 0 24-10.7 24-24s-10.7-24-24-24s-24 10.7-24 24s10.7 24 24 24z"></path></svg><!-- <i class="fa-solid fa-upload"></i> Font Awesome fontawesome.com --></a></h3>-->
                    </div>
                </div>
                <!-- Contenedor paso 2 
                <div class="pasos__item box p-2 zoom-in intro-x">
                    <h2 class="pasos__item-numero"> 02</h2>
                    <div>
                        <h1 class="pasos__item-titulo">Inscríbete a un programa</h1>
                        <h3 class="pasos__item-desc text-center"><a href="oferta-programas"><span class="inline-flex items-center rounded-full px-2 mx-2 badge badge-warning text-m">
                            ¡Ver oferta!
                        </span></a></h3>
                    </div>
                </div>
                <!-- Contenedor paso 3 
                <div class="pasos__item box p-2 zoom-in intro-x">
                    <h2 class="pasos__item-numero"> 03</h2>
                    <div>
                        <h1 class="pasos__item-titulo">Recibe respuesta</h1>
                        <h3 class="pasos__item-desc">Espera a que la empresa se contacte</h3>
                    </div>
                </div>
                <!-- Contenedor paso 4 
                <div class="pasos__item box p-2 zoom-in intro-x">
                    <h2 class="pasos__item-numero"> 04</h2>
                    <div>
                        <h1 class="pasos__item-titulo">Genera tus reportes</h1>
                    </div>
                </div>
                <!-- Contenedor paso 5 
                <div class="pasos__item box p-2 zoom-in intro-x">
                    <h2 class="pasos__item-numero"> 05</h2>
                    <div>
                        <h1 class="pasos__item-titulo">Libera tus prácticas</h1>
                    </div>
                </div>
            </div>
        </div>-->
    </div>
@endsection
