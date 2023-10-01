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
            <input type="text" class="search__input form-control" placeholder="Buscar... (Ctrl+k)">
            <i data-lucide="search" class="search__icon"></i>
        </div>
        <a class="notification sm:hidden" href="">
            <i data-lucide="search" class="notification__icon dark:text-slate-500 mr-5"></i>
        </a>
    </div>
    <!-- END: Search -->
    <!-- BEGIN: Search Result 
    <div id="search-result-modal" class="modal flex items-center justify-center" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="relative border-b border-slate-200/60">
                        <i data-lucide="search" class="w-5 h-5 absolute inset-y-0 my-auto ml-4 text-slate-500"></i>
                        <input type="text" class="form-control border-0 shadow-none focus:ring-0 py-5 px-12" placeholder="Quick Search...">
                        <div class="h-6 text-xs bg-slate-200 text-slate-500 px-2 flex items-center rounded-md absolute inset-y-0 right-0 my-auto mr-4">ESC</div>
                    </div>
                    <div class="p-5">
                        <div class="font-medium mb-3">Applications</div>
                        <div class="mb-5">
                            <a href="" class="flex items-center mt-3 first:mt-0">
                                <div class="w-7 h-7 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                                    <i class="w-3.5 h-3.5" data-lucide="inbox"></i>
                                </div>
                                <div class="ml-3 truncate">Compose New Mail</div>
                                <div class="ml-auto w-48 truncate text-slate-500 text-xs flex justify-end items-center">
                                    <i class="w-3.5 h-3.5 mr-2" data-lucide="link"></i> Quick Access
                                </div>
                            </a>
                            <a href="" class="flex items-center mt-3 first:mt-0">
                                <div class="w-7 h-7 bg-pending/10 text-pending flex items-center justify-center rounded-full">
                                    <i class="w-3.5 h-3.5" data-lucide="users"></i>
                                </div>
                                <div class="ml-3 truncate">Contacts</div>
                                <div class="ml-auto w-48 truncate text-slate-500 text-xs flex justify-end items-center">
                                    <i class="w-3.5 h-3.5 mr-2" data-lucide="link"></i> Quick Access
                                </div>
                            </a>
                            <a href="" class="flex items-center mt-3 first:mt-0">
                                <div class="w-7 h-7 bg-primary/10 dark:bg-primary/20 text-primary/80 flex items-center justify-center rounded-full">
                                    <i class="w-3.5 h-3.5" data-lucide="credit-card"></i>
                                </div>
                                <div class="ml-3 truncate">Product Reports</div>
                                <div class="ml-auto w-48 truncate text-slate-500 text-xs flex justify-end items-center">
                                    <i class="w-3.5 h-3.5 mr-2" data-lucide="link"></i> Quick Access
                                </div>
                            </a>
                        </div>
                        <div class="font-medium mb-3">Contacts</div>
                        <div class="mb-5">
                            @foreach (array_slice($fakers, 0, 4) as $faker)
                                <a href="" class="flex items-center mt-3 first:mt-0">
                                    <div class="w-7 h-7 image-fit">
                                        <img alt="Rocketman - HTML Admin Template" class="rounded-full" src="{{ asset('build/assets/images/' . $faker['photos'][0]) }}">
                                    </div>
                                    <div class="w-36 truncate ml-3">{{ $faker['users'][0]['name'] }}</div>
                                    <div class="ml-auto w-36 truncate text-slate-500 text-xs text-right">{{ $faker['users'][0]['email'] }}</div>
                                </a>
                            @endforeach
                        </div>
                        <div class="font-medium mb-3">Products</div>
                        <div>
                            @foreach (array_slice($fakers, 0, 4) as $faker)
                                <a href="" class="flex items-center mt-3 first:mt-0">
                                    <div class="w-7 h-7 image-fit">
                                        <img alt="Rocketman - HTML Admin Template" class="rounded-full" src="{{ asset('build/assets/images/' . $faker['images'][0]) }}">
                                    </div>
                                    <div class="w-36 truncate ml-3">{{ $faker['products'][0]['name'] }}</div>
                                    <div class="ml-auto w-36 truncate text-slate-500 text-xs text-right">{{ $faker['products'][0]['category'] }}</div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
    <!-- END: Search Result -->
    <!-- BEGIN: Manual de Usuario -->
    <div class="intro-x dropdown mr-5 sm:mr-6">
        <div class="dropdown-toggle notification  cursor-pointer" role="button" aria-expanded="false" data-tw-toggle="dropdown">
            <a href="#" class="tooltip">
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
                        <i data-lucide="toggle-right" class="w-4 h-4 mr-2"></i> Cerrar Sesión
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- END: Account Menu -->
</div>
<!-- END: Top Bar -->
