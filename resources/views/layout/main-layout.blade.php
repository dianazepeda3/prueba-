@extends('../layout/main')

@section('head')
    @yield('subhead')
@endsection

@section('content')
    <div class="flex h-screen xl:pl-5 xl:py-5">
        <!-- BEGIN: Side Menu -->
        <nav class="[&>div]:opacity-0 side-nav">
            <div class="pt-4 mb-4">
                <div class="flex items-center side-nav__header">
                    <a href="{{ route('inicio-visitante') }}" class="flex items-center intro-x">
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
                    <!--@foreach ($main_menu as $menuKey => $menu)
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
                    @endforeach -->                    
                    @can('alumno')
                        @foreach ($main_menu_alumno as $menuKey => $menu)
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
                    @elsecan('coordinador')
                        @foreach ($main_menu_coordi as $menuKey => $menu)
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
                    @elsecan('biblioteca-ce')
                        @foreach ($main_menu_biblio_ce as $menuKey => $menu)
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
                    @else
                        @foreach ($main_menu_admin as $menuKey => $menu)
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
                    @endcan             
                    
                </ul>
            </div>
        </nav>
        <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
        <div class="wrapper">
            <div class="[&>div]:opacity-0 content">
                @include('../layout/components/top-bar')
                <div class="xl:px-6 mt-2.5">
                    @yield('subcontent')
                </div>
            </div>
        </div>
        <!-- END: Content -->
    </div>
@endsection
