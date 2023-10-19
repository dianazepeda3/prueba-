@extends('../layout/' . $layout)

@section('subhead')
    <title>Usuarios - Titulación CUCEI</title>
@endsection

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">USUARIOS</h2>
        <div class="w-full sm:w-auto flex flex-wrap gap-y-3 mt-4 sm:mt-0">
            <a class="btn btn-primary shadow-md mr-2" href="{{route('usuarios-form')}}">
                <i class="w-4 h-4 mr-2" data-lucide="plus"></i> Agregar Nuevo Usuario
            </a>
        </div>
    </div>
     {{-- ERRORES --}}
     <div class="grid grid-cols-12 gap-12 mt-3"> 
        <div class="intro-y col-span-12 lg:col-span-12">  
            {{-- Mensaje Alerta --}}
            @if (session('info'))
                <div class="alert alert-danger-soft show flex items-center mb-2">
                    <i data-lucide="alert-octagon" class="w-6 h-6 mr-2"></i>
                    {{ session('info') }}
                </div>
            @endif
            {{-- Mensaje Exito --}}                 
            @if (session('success'))
                <div class="alert alert-success-soft show flex items-center mb-2">
                    {{ session('success') }}
                </div>
            @endif 
            @if ($errors->any())
                {{-- Mostrar error --}}
                <div class="alert alert-danger-soft show flex items-center mb-2">
                    <i data-lucide="alert-octagon" class="w-6 h-6 mr-2"></i>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>   
            @endif 
        </div> 
    </div>
    <!-- BEGIN: Filter -->
    <div class="intro-y box p-5 mt-7 flex flex-col xl:flex-row gap-y-3">
        <div class="form-inline flex-1 flex-col xl:flex-row items-start xl:items-center gap-y-2 xl:mr-6">
            <label for="crud-form-1" class="form-label">Nombre del Usuario</label>
            <input id="crud-form-1" type="text" class="form-control w-full" placeholder="Nombre de usuario..">
        </div>
        <!--<div class="form-inline flex-1 flex-col xl:flex-row items-start xl:items-center gap-y-2 xl:mr-6">
            <label for="crud-form-2" class="form-label">Rol</label>
            <select class="tom-select w-full flex-1" id="crud-form-2" multiple>
                @foreach (array_slice($fakers, 0, 10) as $key => $faker)
                    <option value="{{ $faker['products'][0]['category'] }}" {{ $key < 1 ? 'selected' : '' }}>{{ $faker['products'][0]['category'] }}</option>
                @endforeach
            </select>
        </div>-->
        <div class="form-inline flex-1 flex-col xl:flex-row items-start xl:items-center gap-y-2 xl:mr-6">
            <label for="crud-form-1" class="form-label">Rol</label>
            <select class="form-select w-full" aria-label="Default select example">
                <option>Todos</option>
                <option>Administrador</option>
                <option>Coordinador</option>
                <option>Biblioteca</option>
                <option>Control Escolar</option>
            </select>
        </div>
        <button class="btn btn-primary shadow-md">
            <i class="w-4 h-4 mr-2" data-lucide="search"></i> Filtrar
        </button>
    </div>
    <!-- END: Filter -->
    <!-- BEGIN: Data List -->
    <div class="intro-y overflow-auto lg:overflow-visible">
        <table class="table table-report">
            <tbody>
                <tr>
                    <th>NOMBRE</th>
                    <th>EMAIL</th>
                    <th>FECHA DE CREACIÓN</th>
                    <th>ROL</th>
                    <th>ACCIONES</th>
                </tr>
                @foreach ($usuarios as $usuario)
                    @if ($usuario->is_admin)                                            
                    <tr class="intro-x">
                        <!--<td class="w-40 !py-5">
                            <div class="flex">
                                <div class="w-10 h-10 image-fit zoom-in">
                                    <img alt="Rocketman - HTML Admin Templateate" class="tooltip rounded-full" src="{{ asset('build/assets/images/' . $faker['images'][0]) }}" title="Uploaded at {{ $faker['dates'][0] }}">
                                </div>
                                <div class="w-10 h-10 image-fit zoom-in -ml-5">
                                    <img alt="Rocketman - HTML Admin Templateate" class="tooltip rounded-full" src="{{ asset('build/assets/images/' . $faker['images'][1]) }}" title="Uploaded at {{ $faker['dates'][0] }}">
                                </div>
                                <div class="w-10 h-10 image-fit zoom-in -ml-5">
                                    <img alt="Rocketman - HTML Admin Templateate" class="tooltip rounded-full" src="{{ asset('build/assets/images/' . $faker['images'][2]) }}" title="Uploaded at {{ $faker['dates'][0] }}">
                                </div>
                            </div>
                        </td>-->
                        <td>
                            <a href="" class="font-medium whitespace-nowrap">{{ $usuario->name}}</a>
                            <!--<div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{ $usuario->codigo }}</div>-->
                        </td>
                        <!--
                        text-success
                        text-danger                        
                        -->
                        <td class="">{{ $usuario->codigo }}</td>
                        <td class="">{{ $usuario->created_at }}</td>
                        <td class="content-center ">
                            @if($usuario->admin_type == 1)
                                <span class="text-danger ">Administrador</span>
                            @elseif($usuario->admin_type == 2 )
                                <span class="text-success">Coordinador</span>
                            @elseif($usuario->admin_type == 3 )
                                <span class="text-success">Biblioteca</span>
                            @elseif($usuario->admin_type == 4 )
                                <span class="text-success">Control Escolar</span>
                            @elseif($usuario->is_teacher == 1)
                                <span class="">Maestro</span>
                            @elseif($usuario->is_admin == 0 && $usuario->is_teacher == 0)
                                <span class="badge badge-secondary">Alumno</span>
                            @endif
                        </td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <a class="flex items-center mr-3" href="{{ route('usuarios-edit',$usuario) }}">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Editar
                                </a>
                                <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-modal-preview{{$usuario->id}}">
                                    <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Eliminar
                                </a>
                            </div>
                        </td>
                         <!-- BEGIN: Modal Eliminar --> 
                         <div id="delete-modal-preview{{$usuario->id}}" class="modal" tabindex="-1" aria-hidden="true"> 
                            <div class="modal-dialog"> 
                                <div class="modal-content"> 
                                    <div class="modal-body p-0"> 
                                        <div class="p-5 text-center"> 
                                            <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i> 
                                        <div class="text-3xl mt-5">¿Segur@ que deseas eliminar el usuario de {{$usuario->name}}? 
                                    </div> 
                                    <div class="text-slate-500 mt-2 text-justify">                                                
                                        Tenga en cuenta que al eliminar el usuario estará eliminando sus datos y los documentos registrados. Ingrese la contraseña de su usuario para borrarlo.
                                    </div> 
                                    <form method="POST" action="{{ route('eliminar_usuario',$usuario) }}">
                                        @csrf
                                        @method('DELETE')
                                        <input id="password" class="form-control mt-2" type="password" name="password" placeholder="Contraseña..." required autofocus />
                                        @foreach ($errors->all() as $error)
                                            <p class="text-danger mt-2">{{ $error }}</p>
                                        @endforeach
                                        <div class="px-5 pb-8 text-center mt-5"> 
                                            <button type="button" data-tw-dismiss="modal" class="btn btn-secondary w-24 mr-1">Cancelar</button> 
                                            <button type="submit" class="btn btn-danger w-24">Eliminar</button> 
                                        </div> 
                                    </form>
                                </div>                                         
                            </div> 
                        </div> <!-- END: Modal Eliminar -->  
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- END: Data List -->
    <!-- BEGIN: Pagination -->
    <div class="intro-y flex flex-wrap sm:flex-row sm:flex-nowrap items-center mt-5 mb-12">
        <nav class="w-full sm:w-auto sm:mr-auto">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#">
                        <i class="w-4 h-4" data-lucide="chevrons-left"></i>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">
                        <i class="w-4 h-4" data-lucide="chevron-left"></i>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">...</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">1</a>
                </li>
                <li class="page-item active">
                    <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">3</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">...</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">
                        <i class="w-4 h-4" data-lucide="chevron-right"></i>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">
                        <i class="w-4 h-4" data-lucide="chevrons-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <select class="w-20 form-select box mt-3 sm:mt-0">
            <option>10</option>
            <option>25</option>
            <option>35</option>
            <option>50</option>
        </select>
    </div>
    <!-- END: Pagination -->
@endsection
