@extends('../layout/' . $layout)

@section('subhead')
    <title>Usuarios - Titulación CUCEI</title>
@endsection

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">USUARIOS</h2>
        <div class="w-full sm:w-auto flex flex-wrap gap-y-3 mt-4 sm:mt-0">
            <a class="btn btn-facebook shadow-md mr-2" href="javascript:;" data-tw-toggle="modal" data-tw-target="#modal-division">
                <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2 blanco" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"><style>.blanco{fill:#ffffff}</style><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H322.8c-3.1-8.8-3.7-18.4-1.4-27.8l15-60.1c2.8-11.3 8.6-21.5 16.8-29.7l40.3-40.3c-32.1-31-75.7-50.1-123.9-50.1H178.3zm435.5-68.3c-15.6-15.6-40.9-15.6-56.6 0l-29.4 29.4 71 71 29.4-29.4c15.6-15.6 15.6-40.9 0-56.6l-14.4-14.4zM375.9 417c-4.1 4.1-7 9.2-8.4 14.9l-15 60.1c-1.4 5.5 .2 11.2 4.2 15.2s9.7 5.6 15.2 4.2l60.1-15c5.6-1.4 10.8-4.3 14.9-8.4L576.1 358.7l-71-71L375.9 417z"/></svg>
                <span>Editar Director y Secretario de Division</span>
            </a>
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
                            @elseif($usuario->admin_type == 2)
                                <span class="text-success">Coordinador</span>
                            @elseif($usuario->admin_type == 3)
                                <span class="text-success">Biblioteca</span>
                            @elseif($usuario->admin_type == 4)
                                <span class="text-success">Control Escolar</span>
                            @elseif($usuario->admin_type == 5)
                                <span class="text-success">División</span>
                            @elseif($usuario->is_teacher == 1)
                                <span class="">Maestro</span>
                            @elseif($usuario->is_admin == 0 && $usuario->is_teacher == 0)
                                <span class="badge badge-secondary">Alumno</span>
                            @endif
                            @if(isset($usuario->coordinador)) {{"(".$usuario->coordinador->carrera->clave.")"}} @endif
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
     <!-- BEGIN: Modal Division --> 
     <div id="modal-division" class="modal" tabindex="-1" aria-hidden="true"> 
        <div class="modal-dialog"> 
            <div class="modal-content"> 
                <!-- BEGIN: Modal Header --> 
                <div class="modal-header"> 
                    <h2 class="font-medium text-base mr-auto">Editar Director y Secretario de Division</h2>                        
                </div> <!-- END: Modal Header --> 
                <form method="POST" action="{{ route('editar_director_secretario') }}">
                    @csrf
                    <!-- BEGIN: Modal Body --> 
                    <div class="modal-body grid grid-cols-12 gap-4 gap-y-3"> 
                        <div class="col-span-12 sm:col-span-12">
                            <label class="font-bold" for="division">División:</label>
                            <select id="division" name="division" data-placeholder="Seleccione la división" class="tom-select w-full">
                                @foreach($divisiones as $division)
                                    <option value="{{$division->id}}" data-director="{{$division->director_id}}">{{$division->nombre_division}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-span-12 sm:col-span-12">
                            <label for="director">Director de División:</label>
                            <select id="director" name="director" data-placeholder="Selecciona el presidente" class="form-control w-full">
                                <option value="0">Seleccione al Director...</option>
                                @foreach($maestros as $director)
                                    <option value="{{$director->id}}" @if($div->director_id == $director->id) selected @endif>{{$director->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-12 sm:col-span-12">
                            <label for="secretario">Secretario de División:</label>
                            <select id="secretario" name="secretario" data-placeholder="Selecciona el presidente" class="form-select w-full">
                                <option value="0">Seleccione al Secretario...</option>
                                @foreach($maestros as $director)
                                    <option value="{{$director->id}}" @if($div->secretario_id == $director->id) selected @endif>{{$director->nombre}}</option>
                                @endforeach
                            </select>
                        </div>               
                    </div> <!-- END: Modal Body --> 
                    <!-- BEGIN: Modal Footer --> 
                    <div class="modal-footer"> 
                        <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancelar</button> 
                        <button type="submit" class="btn btn-primary w-20">Confirmar</button> 
                    </div> <!-- END: Modal Footer --> 
                </form>
            </div> 
        </div> 
    </div> <!-- END: Modal Division -->  
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
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $('#division').on('change', function(){
                let id = $(this).val();
                console.log('Valor de id:', id);
                
                // Definir la variable de maestros como un objeto JSON válido
                var maestros = <?= json_encode($maestros); ?>;
                
                jQuery.ajax({
                    type: 'GET',
                    url: '/maestros/'+id,
                    success: function(data){
                        // Conserva las opciones preexistentes en los campos "Director" y "Secretario"
                        // si es necesario
                        var directorSelect = jQuery('#director');
                        var secretarioSelect = jQuery('#secretario');
                        
                        // Limpia las opciones, pero mantén las opciones preexistentes
                        directorSelect.find('option').not('[value="0"]').remove();
                        secretarioSelect.find('option').not('[value="0"]').remove();
    
                        jQuery.each(maestros, function(index, maestro){
                            if(data.director_id == maestro.id) {
                                directorSelect.append('<option value="' + maestro.id + '" selected>' + maestro.nombre + '</option>');
                            } else {
                                directorSelect.append('<option value="' + maestro.id + '">' + maestro.nombre + '</option>');
                            }
    
                            if(data.secretario_id == maestro.id) {
                                secretarioSelect.append('<option value="' + maestro.id + '" selected>' + maestro.nombre + '</option>');
                            } else {
                                secretarioSelect.append('<option value="' + maestro.id + '">' + maestro.nombre + '</option>');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
