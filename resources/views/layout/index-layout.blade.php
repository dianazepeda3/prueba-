<!DOCTYPE html>
<!--
Template Name: Rocketman - HTML Admin Dashboard Template
Author: Left4code
Website: http://www.left4code.com/
Contact: muhammadrizki@left4code.com
Purchase: https://themeforest.net/user/left4code/portfolio
Renew Support: https://themeforest.net/user/left4code/portfolio
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{'dark'}}{{""}}">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="{{ asset('build/assets/images/logo.png') }}" rel="shortcut icon">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Rocketman admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
        <meta name="keywords" content="admin template, Rocketman Admin Template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="LEFT4CODE">       
        
        @yield('head')

        <!-- BEGIN: CSS Assets-->
        @vite('resources/css/app.css')
        @vite('resources/css/styles.css')
        <!-- END: CSS Assets-->

        <style>
            .top-bar{margin-left:0px;margin-right:0px;position:sticky;top:0px;}.top-bar:after{border-radius:0px}
            html{background-image:url(/build/assets/bg-main.3423f63e.jpg);
                background-size: cover;
                background-color: #ffffff
            };
            @media (min-width: 1024px) {
            html.dark:after {
                background-color:rgb(var(--color-primary) / .3);
            }
            }
            .text-golden {
                --tw-text-opacity: 1;
                color: rgb(241 165 68/var(--tw-text-opacity));
            }
            @media (min-width: 640px){
            .sm\:h-\[2\.8rem\] {
                height: 2.8rem; 
            }}

            .h-\[2rem\] {
                height: 2.8rem; 
            }
        </style>
    </head>
    <!-- END: Head -->
    <body class="">
        <!-- BEGIN: Top Bar -->
        <div class="top-bar" style="">            
            <div class="-intro-x hidden sm:mr-20 xl:flex"> 
                <img class="h-[2rem]" alt="Logo udg-cucei" src="{{asset('build/assets/images/logo_cucei-udg_blanco.png')}}">                                 
            </div>
            <div class="-intro-x sm:ml-40 sm:mr-6 "> 
                <img class="h-[2rem]" alt="Logo cucei" src="{{asset('build/assets/images/Escudo_CUCEI.png')}}">                  
            </div>
            <div class="-intro-x sm:mr-40 mr-5 font-bold"> 
                <div class="form-inline logo text-lg text-golden ">
                    Titulación&nbsp;<div class="text-white">CUCEI</div>
                </div>
            </div>
            <!-- BEGIN: Manual de Usuario -->
            <div class="intro-x mr-5 sm:ml-20 sm:mr-10 font-bold">                
                <a href="{{ route('manual_usuario') }}" class="form-inline " role="button" aria-expanded="false" data-tw-toggle="dropdown" fill="white">
                    <svg class="svg-inline--fa fa-venus-mars w-4 h-6 text-slate-500 mr-2 blanco" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>.blanco{fill:#ffffff}</style><path d="M96 0C43 0 0 43 0 96V416c0 53 43 96 96 96H384h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V384c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H384 96zm0 384H352v64H96c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16zm16 48H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>
                    Manual de Usuario
                </a>           
            </div>    
            <!-- BEGIN: Manual de Usuario -->
            <div class="intro-x mr-5 sm:mr-6 font-bold">                
                <a href="{{ route('login.index') }}" class="form-inline " role="button" aria-expanded="false" data-tw-toggle="dropdown" fill="white">
                    <svg class="svg-inline--fa fa-venus-mars w-5 h-6 text-slate-500 mr-2 blanco" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>.blanco{fill:#ffffff}</style><path d="M217.9 105.9L340.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L217.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1L32 320c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM352 416l64 0c17.7 0 32-14.3 32-32l0-256c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l64 0c53 0 96 43 96 96l0 256c0 53-43 96-96 96l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32z"/></svg>
                    Iniciar Sesión
                </a>           
            </div>                
        </div>

        <!-- END: Top Bar -->
        <div class="xl:px-6 mt-2.5">
            @yield('subcontent')            
        </div>    

        <!-- BEGIN: JS Assets-->
        @vite('resources/js/app.js')
        <!-- END: JS Assets-->

        @yield('script')
    </body>

</html>
