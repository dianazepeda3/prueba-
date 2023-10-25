@extends('../layout/' . $layout)

@section('subhead')
    <title>Trámites - Titulación CUCEI</title>
@endsection

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto color-claro">TRÁMITES</h2>
        <div class="w-full sm:w-auto flex flex-wrap gap-y-3 mt-4 sm:mt-0">
            <a class="btn btn-primary-fuera shadow-md mr-2" href="{{route('crear_tramite')}}">
                <i class="w-4 h-4 mr-2" data-lucide="plus"></i> Crear Trámite
            </a>
        </div>
    </div>    
     {{-- ERRORES --}}
     <div class="grid grid-cols-12 gap-12 mt-3"> 
        <div class="intro-y col-span-12 lg:col-span-12">  
            {{-- Mensaje Alerta --}}
            @if (session('info'))
                <div class="alert alerta-error show flex items-center mb-2">
                    <i data-lucide="alert-octagon" class="w-6 h-6 mr-2"></i>
                    {{ session('info') }}
                </div>
            @endif
            {{-- Mensaje Exito --}}                 
            @if (session('success'))
                <div class="alert alerta-exito show flex items-center mb-2">
                    {{ session('success') }}
                </div>
            @endif 
            @if ($errors->any())
                {{-- Mostrar error --}}
                <div class="alert alerta-error show flex items-center mb-2">
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
    <div class="intro-y box p-5 mt-3 flex flex-col xl:flex-row gap-y-3">
        <form class="form" method="POST" action="{{ route('filtrar_tramites') }}">
            @csrf 
            <div class="form-inline flex-1 flex-col xl:flex-row items-start xl:items-center gap-y-2 xl:mr-6">
                <label for="nombre" class="form-label">Nombre del Alumno</label>
                <input id="nombre" name="nombre" type="text" class="form-control mr-5" placeholder="Nombre del alumno.." 
                    @if ($nombre != "") value="{{ $nombre }}" @endif>
                <label for="fitrar" class="form-label espacio-form">Estado</label>
                <select id="filtrar" name="filtrar"  class="form-control tom-select campo-rol mr-5" aria-label="Default select example">
                    <option value="0" @if ($filtrar == 0) selected @endif>Todos</option>
                    <option value="1" @if ($filtrar == 1) selected @endif>Datos No Registrados</option>
                    <option value="2" @if ($filtrar == 2) selected @endif>Datos Registrados</option>
                    <option value="3" @if ($filtrar == 3) selected @endif>Documentos Entregados</option>
                    <option value="4" @if ($filtrar == 4) selected @endif>Documentos Validados</option>
                    <option value="5" @if ($filtrar == 5) selected @endif>Documentos No Aprobados</option>
                    <option value="6" @if ($filtrar == 6) selected @endif>2da Etapa</option>
                    <option value="7" @if ($filtrar == 7) selected @endif>Documentos Entregados - 2da Etapa</option>
                    <option value="8" @if ($filtrar == 8) selected @endif>3ra Etapa</option>
                    <option value="9" @if ($filtrar == 9) selected @endif>Documentos No Aprobados - 2da Etapa</option>
                    <option value="10" @if ($filtrar == 10) selected @endif>Documentos Entregados - 3ra Etapa</option>
                    <option value="11" @if ($filtrar == 11) selected @endif>Documentos Validados - 3ra Etapa</option>
                    <option value="12" @if ($filtrar == 12) selected @endif>Documentos No Aprobados - 3ra Etapa</option>
                    <option value="13" @if ($filtrar == 13) selected @endif>Datos de Titulación Generados</option>
                </select>            
                <button class="btn btn-primary shadow-md boton-100 espacio-form" type="submit">
                    <i class="w-4 h-4 mr-2" data-lucide="search"></i> Filtrar
                </button>
            </div>
        </form>
    </div>
    <!-- END: Filter -->
    <div class="intro-y overflow-auto lg:overflow-visible">
        <table class="table table-report -mt-2">
            <thead>
                <tr>
                    <th class="whitespace-nowrap color-claro">CONSECUTIVO</th>
                    <th class="whitespace-nowrap color-claro">ID</th>
                    <th class="whitespace-nowrap color-claro">NOMBRE</th>
                    <th class="whitespace-nowrap color-claro">CÓDIGO</th>
                    <th class="whitespace-nowrap color-claro">CARRERA</th>
                    <th class="text-center whitespace-nowrap color-claro">ESTADO</th>
                    <th class="text-center whitespace-nowrap color-claro">ERROR</th>
                    <th class="text-center whitespace-nowrap color-claro">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <!--foreach ($tramites as $tramite) -->
                    @foreach ($alumnos as $alumno)
                        @if (/*$tramite->alumno_id == $alumno->id &&*/ (!isset($user->coordinador) 
                            || $alumno->id_carrera == $user->coordinador->id_carrera) && ($filtrar == 0 || $filtrar == $alumno->tramite->estado) && ($nombre == "" || stripos($alumno->user->name, $nombre) !== false))                                                                                                                                    
                            @if ($alumno->alumno_docs->solicitud_constancia_no_adeudo_biblioteca && $user->admin_type == 3 || $alumno->alumno_docs->solicitud_constancia_no_adeudo_universidad && $user->admin_type == 4 || ($user->admin_type != 3 && $user->admin_type != 4))
                                <tr class="intro-x">                                
                                    <td>
                                        <a href="" class="font-medium whitespace-nowrap">{{ $alumno->consecutivo }}</a>
                                    </td>
                                    <td>{{ $alumno->tramite->id }}</td>
                                    <td>{{ $alumno->user->name }}</td>
                                    <td>{{ $alumno->user->codigo }}</td>
                                    <td>{{$alumno->carrera->clave}}</td>
                                    <td class="flex items-center ">
                                        @switch($alumno->tramite->estado)
                                            @case(0)
                                                <div class="text-center w-40 px-3 py-1 alert-danger-soft border border-primary/10 rounded-full mr-2 mb-2">ERROR</div>                                                                                                                                                                                                                               
                                                @break
                                            @case(1)
                                                <div class="text-center w-40 px-3 py-1 alert-pending-soft border border-primary/10 rounded-full mr-2 mb-2">Datos No Registrados</div>
                                                @break
                                            @case(2)
                                                <div class="text-center w-40 px-3 py-1 alert-primary-soft border border-primary/10 rounded-full mr-2 mb-2">Datos Registrados</div>
                                                @break
                                            @case(3)
                                                <div class="text-center w-40 px-3 py-1 alert-warning-soft border border-primary/10 rounded-full mr-2 mb-2">Documentos Entregados</div>
                                                @break
                                            @case(4)
                                                <div class="text-center w-40 px-3 py-1 alert-success-soft border border-primary/10 rounded-full mr-2 mb-2">Documentos Validados</div>
                                                @break
                                            @case(5)
                                                <div class="text-center w-40 px-3 py-1 alert-danger-soft border border-primary/10 rounded-full mr-2 mb-2">Documentos No Aprobados</div> 
                                                @break
                                            @case(6)
                                                <div class="text-center w-40 px-3 py-1 alert-primary-soft border border-primary/10 rounded-full mr-2 mb-2">Etapa 2</div>
                                                @break
                                            @case(7)
                                                <div class="text-center w-40 px-3 py-1 alert-warning-soft border border-primary/10 rounded-full mr-2 mb-2">Documentos Entregados - Etapa 2</div>                                                                                                                                                                                                                                                                  
                                                @break 
                                            @case(8)
                                                <div class="text-center w-40 px-3 py-1 alert-success-soft border border-primary/10 rounded-full mr-2 mb-2">3ra - Etapa</div>                                                                                                                                                                                                                                                                    
                                                @break 
                                            @case(9)
                                                <div class="text-center w-40 px-3 py-1 alert-danger-soft border border-primary/10 rounded-full mr-2 mb-2">Documentos No Aprobados - Etapa 2</div>                                                                                                                                                                                                                                                                            
                                                @break 
                                            @case(10)
                                                <div class="text-center w-40 px-3 py-1 alert-warning-soft border border-primary/10 rounded-full mr-2 mb-2">Documentos Entregados - Etapa 3</div>                                                                                                                                                                                                                                                                            
                                                @break 
                                            @case(11)
                                                <div class="text-center w-40 px-3 py-1 alert-success-soft border border-primary/10 rounded-full mr-2 mb-2">Documentos Validados - Etapa 3</div>                                                                                                                                                                                                                                                                                                                   
                                                @break                                                        
                                            @case(12)
                                                <div class="text-center w-40 px-3 py-1 alert-danger-soft border border-primary/10 rounded-full mr-2 mb-2">Documentos No Aprobados - Etapa 3</div>                                                                                                                                                                                                                                                                                                                       
                                                @break 
                                            @case(13)
                                                <div class="text-center w-40 px-3 py-1 alert-warning-soft border border-primary/10 rounded-full mr-2 mb-2">Datos de Titulación Generados</div>                                                                                                                                                                                                                                                                                                                       
                                                @break                                                                                                                          
                                            @default                                                            
                                        @endswitch  
                                    </td>
                                    <td>
                                        @if($alumno->tramite->error != null)
                                            {{ $alumno->tramite->error }}
                                        @endif
                                    </td>
                                    <td class="table-report__action w-56">
                                        <div class="flex justify-center items-center">                                       
                                            <!--Boton de ver-->
                                            <a class="flex items-center whitespace-nowrap justify-center mx-2" href="{{ route('showTramite', $alumno) }}">
                                                <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="currentColor" d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg>                                                         
                                                Ver
                                            </a>
                                            @cannot('biblioteca-ce')                                                                                    
                                                <a class="flex items-center whitespace-nowrap justify-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-modal-preview{{$alumno->id}}">
                                                    <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="rgb(var(--color-danger)" d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/></svg>                                                         
                                                    Eliminar
                                                </a>
                                            @endcannot
                                        </div>
                                    </td>
                                    <!-- BEGIN: Modal Eliminar --> 
                                    <div id="delete-modal-preview{{$alumno->id}}" class="modal" tabindex="-1" aria-hidden="true"> 
                                        <div class="modal-dialog"> 
                                            <div class="modal-content"> 
                                                <div class="modal-body p-0"> 
                                                    <div class="p-5 text-center"> 
                                                        <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i> 
                                                    <div class="text-3xl mt-5">¿Segur@ que deseas eliminar el tramite de {{$alumno->user->name}}? 
                                                </div> 
                                                <div class="text-slate-500 mt-2 text-justify">                                                
                                                    Tenga en cuenta que al eliminar su trámite estará eliminando sus datos y los documentos registrados. Ingrese la contraseña de su usuario para borrarlo.
                                                </div> 
                                                <form method="POST" action="{{ route('eliminar_tramites',$alumno) }}">
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
                        @endif
                    @endforeach
                <!--endforeach-->
            </tbody>
        </table>
    </div>
    <!-- END: Data List -->
    <!-- BEGIN: Pagination -->
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
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
    </div>       
@endsection
