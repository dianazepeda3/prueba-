<!-- BEGIN: Top Bar -->
<div class="top-bar">
    <!-- BEGIN: Breadcrumb -->
    <nav aria-label="breadcrumb" class="-intro-x hidden xl:flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
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
            <input type="text" class="search__input form-control" placeholder="Buscar... ">
            <i data-lucide="search" class="search__icon"></i>
        </div>
        <a class="notification sm:hidden" href="">
            <i data-lucide="search" class="notification__icon dark:text-slate-500 mr-5"></i>
        </a>
    </div>
    <!-- END: Search -->
    <!-- BEGIN: Manual de Usuario -->
    <div class="intro-x dropdown mr-5 sm:mr-6">
        <div class="dropdown-toggle notification  cursor-pointer" role="button" aria-expanded="false" data-tw-toggle="dropdown">
            <a href="{{ route('manual_usuario', $user) }}" class="tooltip" title="Manual de Usuario">
                <svg class="svg-inline--fa fa-book h-5 w-5" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="book" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M96 0C43 0 0 43 0 96V416c0 53 43 96 96 96H384h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V384c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H384 96zm0 384H352v64H96c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16zm16 48H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16s7.2-16 16-16z"></path></svg><!-- <i class="fa fa-book h-5 w-5"></i> Font Awesome fontawesome.com -->
            </a>
        </div>              
    </div>    
    
    <!-- END: Notifications -->
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
                        <i data-lucide="log-out" class="w-4 h-4 mr-2"></i> Cerrar Sesión
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- END: Account Menu -->
</div>
<!-- END: Top Bar -->
