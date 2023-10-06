@extends('../layout/' . $layout)

@section('subhead')
    <title>Trámites - Titulación CUCEI</title>
@endsection

@section('subcontent')
    <h2 class="intro-y text-lg font-medium mt-10">TRÁMITES</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <button class="btn btn-primary shadow-md mr-2">Crear Trámite</button>
            <div class="dropdown">
                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center">
                        <i class="w-4 h-4" data-lucide="plus"></i>
                    </span>
                </button>
                <div class="dropdown-menu w-40">
                    <ul class="dropdown-content">
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print
                            </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export to Excel
                            </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export to PDF
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="hidden md:block mx-auto text-slate-500">Showing 1 to 10 of 150 entries</div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-slate-500">
                    <input type="text" class="form-control w-56 box pr-10" placeholder="Search...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">CONSECUTIVO</th>
                        <th class="whitespace-nowrap">ID</th>
                        <th class="whitespace-nowrap">NOMBRE</th>
                        <th class="whitespace-nowrap">CÓDIGO</th>
                        <th class="whitespace-nowrap">CARRERA</th>
                        <th class="text-center whitespace-nowrap">ESTADO</th>
                        <th class="text-center whitespace-nowrap">ERROR</th>
                        <th class="text-center whitespace-nowrap">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <!--foreach ($tramites as $tramite) -->
                        @foreach ($alumnos as $alumno)
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
                                            <div class="text-center w-40 px-3 py-1 alert-success-soft border border-primary/10 rounded-full mr-2 mb-2">Documentos Validados - Etapa 2</div>                                                                                                                                                                                                                                                                    
                                            @break 
                                        @case(9)
                                            <div class="text-center w-40 px-3 py-1 alert-danger-soft border border-primary/10 rounded-full mr-2 mb-2">ERROR</div>                                                                                                                                                                                                                                                                           
                                            <span class="badge badge-success">Documentos No Aprobados - Etapa 2</span>
                                            @break 
                                        @case(10)
                                            <div class="text-center w-40 px-3 py-1 alert-primary-soft border border-primary/10 rounded-full mr-2 mb-2">ERROR</div>                                                                                                                                                                                                                                                                           
                                            <span class="badge badge-info">Datos de Titulacion generados</span>
                                            @break                                                        
                                        @case(11)
                                            <div class="text-center w-40 px-3 py-1 alert-primary-soft border border-primary/10 rounded-full mr-2 mb-2">ERROR</div>                                                                                                                                                                                                                                                                           
                                            <span class="badge badge-success">Etapa 3</span>
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
                                         
                                        <a class="flex items-center whitespace-nowrap justify-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-modal-preview">
                                            <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="rgb(var(--color-danger)" d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/></svg>                                                         
                                            Eliminar
                                        </a>
                                    </div>
                                </td>
                            </tr>
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
    <!-- BEGIN: Modal Eliminar --> 
    <div id="delete-modal-preview" class="modal" tabindex="-1" aria-hidden="true"> 
        <div class="modal-dialog"> 
            <div class="modal-content"> 
                <div class="modal-body p-0"> 
                    <div class="p-5 text-center"> 
                        <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i> 
                    <div class="text-3xl mt-5">¿Estas @if ($alumno->genero == "Mujer") segura? @else seguro? @endif
                </div> 
                <div class="text-slate-500 mt-2">
                    @if ($alumno->genero == "Mujer") ¿Segura @else ¿Seguro @endif que deseas eliminar el documento? <br>
                </div> 
            </div> 
            <div class="px-5 pb-8 text-center"> 
                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancelar</button> 
                <button type="button" class="btn btn-danger w-24">Eliminar</button> 
            </div> 
        </div> 
    </div> <!-- END: Modal Eliminar -->  
@endsection
