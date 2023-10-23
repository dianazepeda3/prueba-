@extends('../layout/' . $layout)

@section('subhead')
    <title>Maestros - Titulación CUCEI</title>
@endsection

@section('subcontent')
    <h2 class="intro-y text-lg font-medium mt-10">MAESTROS</h2>
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
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a class="btn btn-primary shadow-md mr-2" href="{{ route('maestros-form') }}">
                <i class="w-4 h-4 mr-2" data-lucide="plus"></i>Agregar Maestro
            </a>             
            <a class="btn btn-instagram shadow-md mr-2" href="{{ route('maestros-form') }}">
                <i class="w-4 h-4 mr-2" data-lucide="plus"></i>Agregar Maestro
            </a>          
            <div class="hidden md:block mx-auto text-slate-500"><!--Mostrando 1 a 10 de 150 entradas--></div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-slate-500">
                    <input type="text" class="form-control w-56 box pr-10" placeholder="Buscar...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                </div>
            </div>
        </div>        
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>                       
                        <th class="whitespace-nowrap">NOMBRE</th>
                        <th class="whitespace-nowrap">EMAIL</th>
                        <th class="whitespace-nowrap">CÓDIGO</th>
                        <th class="whitespace-nowrap">GRADO</th>
                        <th class="text-center whitespace-nowrap">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>                
                    @foreach ($maestros as $maestro)
                        <tr class="intro-x">                                                            
                            <td>{{ $maestro->nombre }}</td>
                            <td>{{ $maestro->email }}</td>
                            <td>{{ $maestro->codigo }}</td>
                            <td>{{ $maestro->grado }}</td>                            
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3" href="{{ route('maestros-edit',$maestro) }}">
                                        <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Editar
                                    </a>
                                    <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-modal-preview{{$maestro->id}}">
                                        <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Eliminar
                                    </a>
                                </div>
                            </td>
                            <!-- BEGIN: Modal Eliminar --> 
                            <div id="delete-modal-preview{{$maestro->id}}" class="modal" tabindex="-1" aria-hidden="true"> 
                                <div class="modal-dialog"> 
                                    <div class="modal-content"> 
                                        <div class="modal-body p-0"> 
                                            <div class="p-5 text-center"> 
                                                <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i> 
                                            <div class="text-3xl mt-5">¿Segur@ que deseas eliminar al maestro {{$maestro->nombre}}? 
                                        </div> 
                                        <div class="text-slate-500 mt-2 text-justify">                                                
                                            Tenga en cuenta que al eliminar el maestro estará eliminando sus datos y los documentos registrados. Ingrese la contraseña de su usuario para borrarlo.
                                        </div> 
                                        <form method="POST" action="{{ route('eliminar_maestro',$maestro) }}">
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
                    @endforeach
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
