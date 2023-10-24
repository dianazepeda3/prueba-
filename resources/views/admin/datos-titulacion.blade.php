@extends('../layout/' . $layout)

@section('subhead')
    <title>Trámites - Titulación CUCEI</title>
@endsection

@section('subcontent')
    {{-- ERRORES --}}
    <div class="grid grid-cols-12 gap-12 mt-5"> 
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
  
    <div class="grid grid-cols-12 gap-6 ">             
        <div class="intro-y col-span-12 lg:col-span-12">                         
            <!-- BEGIN: Horizontal Form -->
            <div class="intro-y box mt-5">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">DATOS DE TITULACIÓN</h2>                    
                </div>
                <div id="horizontal-form" class="p-5">
                    <div class="preview">
                        <form class="form" method="POST" action="{{ route('update-datos-titulacion',$alumno) }}" enctype="multipart/form-data">
                            @method('PATCH') 
                            @csrf                            
                            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3"> 
                                <div class="col-span-9 sm:col-span-12"> 
                                    <label for="nombre" class="form-label">Nombre Completo:</label> 
                                    <input id="nombre" type="text" class="form-control" value="{{$alumno->user->name}}" disabled> 
                                </div> 
                                <div class="col-span-3 sm:col-span-12"> 
                                    <label for="codigo" class="form-label">Código:</label> 
                                    <input id="codigo" type="text" class="form-control" value="{{$alumno->user->codigo}}" disabled> 
                                </div> 
                                <div class="col-span-12 sm:col-span-4"> 
                                    <label for="numero_de_consecutivo" class="form-label">N° de Consecutivo:</label> 
                                    <input id="numero_de_consecutivo" name="numero_de_consecutivo" type="text" class="form-control" 
                                    @if(isset($alumno))
                                        value="{{$alumno->numero_de_consecutivo}}"
                                    @else
                                        value="{{old('numero_de_consecutivo')}}"
                                    @endif> 
                                </div> 
                                <div class="col-span-12 sm:col-span-4"> 
                                    <label for="anio_graduacion" class="form-label">Año de Graduación:</label> 
                                    <input id="anio_graduacion" name="anio_graduacion" type="text" class="form-control" 
                                    @if(isset($alumno))
                                        value="{{$alumno->anio_graduacion}}"
                                    @else
                                        value="{{old('anio_graduacion')}}"
                                    @endif> 
                                </div> 
                                <div class="col-span-12 sm:col-span-4"> 
                                    <label for="consecutivo" class="form-label">Consecutivo:</label> 
                                    <input id="consecutivo" name="consecutivo" type="text" class="form-control" 
                                    @if(isset($alumno))
                                        value="{{$alumno->consecutivo}}"
                                    @else
                                        value="{{old('consecutivo')}}"
                                    @endif> 
                                </div> 
                                <div class="col-span-12 sm:col-span-4"> 
                                    <label for="fecha_egreso" class="form-label">Fecha de Egreso:</label> 
                                    <input id="fecha_egreso" name="fecha_egreso" type="date" class="form-control" 
                                    @if(isset($alumno))
                                        value="{{$alumno->fecha_egreso}}"
                                    @else
                                        value="{{old('fecha_egreso')}}"
                                    @endif> 
                                </div> 
                                <div class="col-span-12 sm:col-span-4"> 
                                    <label for="fecha_titulacion" class="form-label">Fecha Titulación:</label> 
                                    <input id="fecha_titulacion" name="fecha_titulacion" type="date" class="form-control" 
                                    @if(isset($alumno))
                                        value="{{$alumno->fecha_titulacion}}"
                                    @else
                                        value="{{old('fecha_titulacion')}}"
                                    @endif> 
                                </div> 
                                <div class="col-span-12 sm:col-span-4">                                     
                                    <label for="tipo_de_ceremonia" class="form-label">Tipo de Ceremonia: </label>
                                    <select class="form-control" name="tipo_de_ceremonia" id="tipo_de_ceremonia">
                                        <option value="">Seleccione una opción</option>
                                        <option value="INDIVIDUAL" @if(isset($alumno) && $alumno->tipo_de_ceremonia == 'INDIVIDUAL') selected @endif>Individual</option>
                                        <option value="MASIVA" @if(isset($alumno) && $alumno->tipo_de_ceremonia == 'MASIVA') selected @endif>Masiva</option>
                                        <option value="TOMA DE PROTESTA EN ACTO ACADÉMICO" @if(isset($alumno) && $alumno->tipo_de_ceremonia == 'TOMA DE PROTESTA EN ACTO ACADÉMICO') selected @endif>Toma de Protesta en Acto Académico</option>
                                    </select><br>
                                </div>
                            </div>                            
                            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">   
                                <div class="col-span-12 sm:col-span-12 font-bold">  
                                    <label class="w-40">SINODALES</label>
                                </div>                              
                                <div class="col-span-4 sm:col-span-12"> 
                                    <label for="presidente">Presidente:</label>
                                    <select id="presidente" name="presidente" data-placeholder="Selecciona el presidente" class="tom-select w-full">
                                        <option value="">Seleccione una opción</option>
                                        @foreach($maestros as $presidente)
                                        <option value="{{$presidente->id}}" @if(isset($alumno) && $alumno->id_maestro_presidente == $presidente->id) selected @endif>{{$presidente->nombre}}</option>
                                   @endforeach
                                    </select> 
                                </div> 
                                <div class="col-span-4 sm:col-span-12"> 
                                    <label for="secretario">Secretario:</label>
                                    <select id="secretario" name="secretario" data-placeholder="Selecciona el secretario" class="tom-select w-full">
                                        <option value="">Seleccione una opción</option>
                                        @foreach($maestros as $secretario)
                                            <option value="{{$secretario->id}}" @if(isset($alumno) && $alumno->id_maestro_secretario == $secretario->id) selected @endif>{{$secretario->nombre}}</option>
                                        @endforeach
                                    </select> 
                                </div> 
                                <div class="col-span-4 sm:col-span-12"> 
                                    <label for="vocal">Vocal:</label>
                                    <select id="vocal" name="vocal" data-placeholder="Selecciona el vocal" class="tom-select w-full">
                                        <option value="">Seleccione una opción</option>
                                        @foreach($maestros as $vocal)
                                            <option value="{{$vocal->id}}" @if(isset($alumno) && $alumno->id_maestro_vocal == $vocal->id) selected @endif>{{$vocal->nombre}}</option>
                                        @endforeach
                                    </select> 
                                </div>                                 
                            </div>     
                            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">   
                                <div class="col-span-12 sm:col-span-12 font-bold">  
                                    <label class="w-40">En caso de Ceremonia Individual</label>
                                </div>
                                <div class="col-span-12 sm:col-span-4"> 
                                    <label for="hora_inicio_citatorio" class="form-label">Hora inicio de ceremonia:</label> 
                                    <input id="hora_inicio_citatorio" name="hora_inicio_citatorio" type="time" class="form-control" 
                                    @if(isset($alumno))
                                        value="{{$alumno->hora_inicio_citatorio}}"
                                    @else
                                        value="{{old('hora_inicio_citatorio')}}"
                                    @endif> 
                                </div> 
                                <div class="col-span-12 sm:col-span-4"> 
                                    <label for="hora_fin_citatorio" class="form-label">Hora fin de ceremonia:</label> 
                                    <input id="hora_fin_citatorio" name="hora_fin_citatorio" type="time" class="form-control" 
                                    @if(isset($alumno))
                                        value="{{$alumno->hora_fin_citatorio}}"
                                    @else
                                        value="{{old('hora_fin_citatorio')}}"
                                    @endif> 
                                </div> 
                                <div class="col-span-12 sm:col-span-4"> 
                                    <label for="fecha_citatorio" class="form-label">Fecha del citatorio:</label> 
                                    <input id="fecha_citatorio" name="fecha_citatorio" type="date" class="form-control" 
                                    @if(isset($alumno))
                                        value="{{$alumno->fecha_citatorio}}"
                                    @else
                                        value="{{old('fecha_citatorio')}}"
                                    @endif> 
                                </div>  
                                <div class="col-span-12 sm:col-span-6">                                     
                                    <label for="tipo_de_ceremonia_presencial_virtual" class="form-label">Tipo de Ceremonia (Presencial o Virtual):</label>
                                    <select class="form-control" name="tipo_de_ceremonia_presencial_virtual" id="tipo_de_ceremonia_presencial_virtual">
                                        <option value="">Seleccione una opción</option>
                                        <option value="PRESENCIAL" @if(isset($alumno) && $alumno->tipo_de_ceremonia_presencial_virtual == 'PRESENCIAL') selected @endif>Presencial</option>
                                        <option value="VIRTUAL" @if(isset($alumno) && $alumno->tipo_de_ceremonia_presencial_virtual == 'VIRTUAL') selected @endif>Virtual</option>
                                    </select><br>
                                </div>
                                <div class="col-span-12 sm:col-span-6"> 
                                    <label for="consecutivo" class="form-label">Lugar o enlace de la ceremonia:</label> 
                                    <input id="lugar_de_ceremonia" name="lugar_de_ceremonia" type="text" class="form-control" 
                                    @if(isset($alumno))
                                        value="{{$alumno->lugar_de_ceremonia}}"
                                    @else
                                        value="{{old('lugar_de_ceremonia')}}"
                                    @endif> 
                                </div> 
                            </div>                                                                        
                            <div class="sm:pl-5 mt-5">
                                <button class="btn btn-primary" type="submit">Guardar</button>                                               
                                <a class="btn btn-secondary" href="{{ route('showTramite',$alumno) }}">Cancelar</a>
                            </div>
                        </form>

                    </div>
                    <div class="source-code hidden">
                        <button data-target="#copy-horizontal-form" class="copy-code btn py-1 px-2 btn-outline-secondary">
                            <i data-lucide="file" class="w-4 h-4 mr-2"></i> Copy example code
                        </button>
                        <div class="overflow-y-auto mt-3 rounded-md">
                            <pre id="copy-horizontal-form" class="source-preview">
                                <code class="html">
                                    {{ str_replace('>', 'HTMLCloseTag', str_replace('<', 'HTMLOpenTag', '
                                        <div class="form-inline">
                                            <label for="horizontal-form-1" class="form-label sm:w-20">Email</label>
                                            <input id="horizontal-form-1" type="text" class="form-control" placeholder="example@gmail.com">
                                        </div>
                                        <div class="form-inline mt-5">
                                            <label for="horizontal-form-2" class="form-label sm:w-20">Password</label>
                                            <input id="horizontal-form-2" type="password" class="form-control" placeholder="secret">
                                        </div>
                                        <div class="form-check sm:ml-20 sm:pl-5 mt-5">
                                            <input id="horizontal-form-3" class="form-check-input" type="checkbox" value="">
                                            <label class="form-check-label" for="horizontal-form-3">Remember me</label>
                                        </div>
                                        <div class="sm:ml-20 sm:pl-5 mt-5">
                                            <button class="btn btn-primary">Login</button>
                                        </div>
                                    ')) }}
                                </code>
                            </pre>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Horizontal Form -->                       
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

@endsection
