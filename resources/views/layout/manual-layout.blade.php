@extends('../layout/main')

@section('head')
    @yield('subhead')
@endsection

@section('content')
<style>html{background-color: #000000;}</style>
    <div class="flex h-screen xl:pl-5 xl:py-5">
        <!-- BEGIN: Side Menu -->
        <nav class="[&>div]:opacity-0 side-nav">
            <div class="pt-4 mb-4">
                <div class="flex items-center side-nav__header">
                    <a href="" class="flex items-center intro-x">
                        <img alt="Rocketman Tailwind HTML Admin Template" class="side-nav__header__logo" src="{{ !$dark_mode ? asset('build/assets/images/logo.png') : asset('build/assets/images/logo.svg') }}">
                        <span class="side-nav__header__text pt-0.5 text-lg ml-2.5">
                            Titulación CUCEI
                        </span>
                    </a>
                    <a href="javascript:;" class="hidden pr-5 ml-auto transition-all duration-300 ease-in-out side-nav__header__toggler xl:block text-primary dark:text-slate-500 text-opacity-70 hover:text-opacity-100">
                        <i data-lucide="arrow-left-circle" class="w-5 h-5"></i>
                    </a>
                    <a href="javascript:;" class="pr-5 ml-auto transition-all duration-300 ease-in-out mobile-menu-toggler xl:hidden text-primary dark:text-slate-500 text-opacity-70 hover:text-opacity-100">
                        <i data-lucide="x-circle" class="w-5 h-5"></i>
                    </a>
                </div>
            </div>
            <div class="scrollable">
                <ul class="scrollable__content">                    
                    @foreach ($main_menu2 as $menuKey => $menu)
                        @if (is_string($menu))
                            <li class="mb-4 side-nav__devider">{{ $menu }}</li>
                        @else
                            <li>
                                <a href="{{ isset($menu['route_name']) ? route($menu['route_name'], $menu['params']) : 'javascript:;' }}" class="{{ $first_level_active_index == $menuKey ? 'side-menu side-menu--active' : 'side-menu' }}">
                                    <div class="side-menu__icon">
                                        <i data-lucide="{{ $menu['icon'] }}"></i>
                                    </div>
                                    <div class="side-menu__title">
                                        {{ $menu['title'] }}
                                        @if (isset($menu['sub_menu']))
                                            <div class="side-menu__sub-icon {{ $first_level_active_index == $menuKey ? 'transform rotate-180' : '' }}">
                                                <i data-lucide="chevron-down"></i>
                                            </div>
                                        @endif
                                    </div>
                                </a>
                                @if (isset($menu['sub_menu']))
                                    <ul class="{{ $first_level_active_index == $menuKey ? 'side-menu__sub-open' : '' }}">
                                        @foreach ($menu['sub_menu'] as $subMenuKey => $subMenu)
                                            <li>
                                                <a href="{{ isset($subMenu['route_name']) ? route($subMenu['route_name'], $subMenu['params']) : 'javascript:;' }}" class="{{ $second_level_active_index == $subMenuKey ? 'side-menu side-menu--active' : 'side-menu' }}">
                                                    <div class="side-menu__icon">
                                                        <i data-lucide="activity"></i>
                                                    </div>
                                                    <div class="side-menu__title">
                                                        {{ $subMenu['title'] }}
                                                        @if (isset($subMenu['sub_menu']))
                                                            <div class="side-menu__sub-icon {{ $second_level_active_index == $subMenuKey ? 'transform rotate-180' : '' }}">
                                                                <i data-lucide="chevron-down"></i>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </a>
                                                @if (isset($subMenu['sub_menu']))
                                                    <ul class="{{ $second_level_active_index == $subMenuKey ? 'side-menu__sub-open' : '' }}">
                                                        @foreach ($subMenu['sub_menu'] as $lastSubMenuKey => $lastSubMenu)
                                                            <li>
                                                                <a href="{{ isset($lastSubMenu['route_name']) ? route($lastSubMenu['route_name'], $lastSubMenu['params']) : 'javascript:;' }}" class="{{ $third_level_active_index == $lastSubMenuKey ? 'side-menu side-menu--active' : 'side-menu' }}">
                                                                    <div class="side-menu__icon">
                                                                        <i data-lucide="zap"></i>
                                                                    </div>
                                                                    <div class="side-menu__title">{{ $lastSubMenu['title'] }}</div>
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </nav>
        <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
        <div class="wrapper">
            <div class="[&>div]:opacity-0 content">
                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <nav aria-label="breadcrumb" class="-intro-x hidden xl:flex">
                        <ol class="breadcrumb">
                            <!--<li class="breadcrumb-item"><a href="#">Inicio</a></li>-->
                            <!--<li class="breadcrumb-item"><a href="#">Administrator</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>-->
                        </ol>
                    </nav>
                    <!-- END: Breadcrumb -->
                    <!-- BEGIN: Mobile Menu -->
                    <div class="-intro-x xl:hidden mr-3 sm:mr-6">
                        <div class="mobile-menu-toggler cursor-pointer">
                            <i data-lucide="bar-chart-2" class="mobile-menu-toggler__icon transform rotate-90 dark:text-slate-500"></i>
                        </div>
                    </div>
                    <!-- END: Mobile Menu -->
                    <!-- BEGIN: Search -->
                    <div class="intro-x relative ml-auto sm:mx-auto">
                        <div class="search hidden sm:block">
                            <input type="text" class="search__input form-control" placeholder="Buscar... (Ctrl+k)">
                            <i data-lucide="search" class="search__icon"></i>
                        </div>
                        <a class="notification sm:hidden" href="">
                            <i data-lucide="search" class="notification__icon dark:text-slate-500 mr-5"></i>
                        </a>
                    </div>
                    <!-- END: Search -->   
                    @if(auth()->check())
                        <!-- BEGIN: Sistema Titulación -->
                        <div class="intro-x dropdown mr-5 sm:mr-6">
                            <div class="dropdown-toggle notification  cursor-pointer" role="button" aria-expanded="false" data-tw-toggle="dropdown">
                                <a @can('alumno') href="{{ route('inicio_alumno') }}" @else href="{{ route('inicio') }}" @endcan class="tooltip" title="Sistema Titulación">
                                    <svg class="svg-inline--fa fa-venus-mars w-6 h-6 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="currentColor" d="M320 32c-8.1 0-16.1 1.4-23.7 4.1L15.8 137.4C6.3 140.9 0 149.9 0 160s6.3 19.1 15.8 22.6l57.9 20.9C57.3 229.3 48 259.8 48 291.9v28.1c0 28.4-10.8 57.7-22.3 80.8c-6.5 13-13.9 25.8-22.5 37.6C0 442.7-.9 448.3 .9 453.4s6 8.9 11.2 10.2l64 16c4.2 1.1 8.7 .3 12.4-2s6.3-6.1 7.1-10.4c8.6-42.8 4.3-81.2-2.1-108.7C90.3 344.3 86 329.8 80 316.5V291.9c0-30.2 10.2-58.7 27.9-81.5c12.9-15.5 29.6-28 49.2-35.7l157-61.7c8.2-3.2 17.5 .8 20.7 9s-.8 17.5-9 20.7l-157 61.7c-12.4 4.9-23.3 12.4-32.2 21.6l159.6 57.6c7.6 2.7 15.6 4.1 23.7 4.1s16.1-1.4 23.7-4.1L624.2 182.6c9.5-3.4 15.8-12.5 15.8-22.6s-6.3-19.1-15.8-22.6L343.7 36.1C336.1 33.4 328.1 32 320 32zM128 408c0 35.3 86 72 192 72s192-36.7 192-72L496.7 262.6 354.5 314c-11.1 4-22.8 6-34.5 6s-23.5-2-34.5-6L143.3 262.6 128 408z"/></svg>
                                </a>
                            </div>              
                        </div>                        
                    @endif
                    <!-- END: Notifications -->
                    @if(auth()->check())
                    <!-- BEGIN: Account Menu -->
                    <div class="intro-x dropdown h-10">
                        <div class="h-full dropdown-toggle flex items-center" role="button" aria-expanded="false" data-tw-toggle="dropdown">
                            <div class="w-10 h-10 image-fit">
                                <img alt="Imagen perfil" class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" src="{{ asset('build/assets/images/profile-circle.png') }}">
                            </div>                        
                            <div class="hidden md:block ml-3">
                                <div class="max-w-[7rem] truncate font-medium">{{ $user->name }}</div>
                                <div class="text-xs text-slate-400">
                                    @can('alumno') Alumno @endcan 
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-menu w-56">
                            <ul class="dropdown-content">
                                <li>
                                    <a href="" class="dropdown-item">
                                        <i data-lucide="user" class="w-4 h-4 mr-2"></i> Perfil
                                    </a>
                                </li>
                                <!--<li>
                                    <a href="" class="dropdown-item">
                                        <i data-lucide="edit" class="w-4 h-4 mr-2"></i> Add Account
                                    </a>
                                </li>
                                <li>
                                    <a href="" class="dropdown-item">
                                        <i data-lucide="lock" class="w-4 h-4 mr-2"></i> Reset Password
                                    </a>
                                </li>-->
                                <li>
                                    <a href="" class="dropdown-item">
                                        <i data-lucide="help-circle" class="w-4 h-4 mr-2"></i> Ayuda
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a href="{{ route('logout') }}" class="dropdown-item">
                                        <i data-lucide="toggle-right" class="w-4 h-4 mr-2"></i> Cerrar Sesión
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- END: Account Menu -->
                    @else
                        <div class="intro-x mr-5 sm:mr-6 font-bold">  
                            <div >
                            <a class="form-inline" href="{{ route('login') }}" role="button" aria-expanded="false" data-tw-toggle="dropdown" fill="white">
                                <svg class="svg-inline--fa fa-venus-mars w-5 h-6 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="currentColor" d="M217.9 105.9L340.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L217.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1L32 320c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM352 416l64 0c17.7 0 32-14.3 32-32l0-256c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l64 0c53 0 96 43 96 96l0 256c0 53-43 96-96 96l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32z"/></svg>
                                Iniciar Sesión
                            </a> 
                            </div>
                        </div>
                    @endif
                </div>
                <!-- END: Top Bar -->

                <div class="xl:px-6 mt-2.5">
                    @yield('subcontent')
                </div>
            </div>
        </div>
        <!-- END: Content -->
    </div>
@endsection
