@extends('../layout/' . $layout)

@section('subhead')
    <title>Trámites - Titulación CUCEI</title>
@endsection

@section('subcontent')
    {{-- ERRORES --}}
    <div class="grid grid-cols-12 gap-12 mt-5"> 
        <div class="intro-y col-span-12 lg:col-span-2"></div>
        <div class="intro-y col-span-12 lg:col-span-8">  
            {{-- Mensaje Alerta --}}
            @if (session('info'))
                <div class="alert alert-danger">
                    {{ session('info') }}
                </div>
            @endif
            {{-- Mensaje Exito --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif 
            @if ($errors->any())
                {{-- Mostrar error --}}
                <div class="alert alert-danger">
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
        <div class="intro-y col-span-12 lg:col-span-2"></div>
        <div class="intro-y col-span-12 lg:col-span-8">                         
            <!-- BEGIN: Horizontal Form -->
            <div class="intro-y box mt-5">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">DATOS ESCOLARES DEL USUARIO</h2>                    
                </div>
                <div id="horizontal-form" class="p-5">
                    <div class="preview">
                        <form class="form" method="POST" action="{{ route('update-datos-escolares',$alumno) }}" enctype="multipart/form-data">
                            @method('PATCH') 
                            @csrf
                            <div class="form-inline">
                                <label for="nombre" class="form-label sm:w-20">Nombre Completo</label>
                                <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre..."
                                @if(isset($alumno))
                                    value="{{$alumno->user->name}}"
                                @else
                                    value="{{old('nombre')}}"
                                @endif>
                            </div>
                            <div class="form-inline mt-5">
                                <label for="codigo" class="form-label sm:w-20">Código</label>
                                <input id="codigo" name="codigo" type="text" class="form-control" placeholder="123456789..."
                                @if(isset($alumno))
                                    value="{{$alumno->user->codigo}}"
                                @else
                                    value="{{old('codigo')}}"
                                @endif>  
                                <label for="promedio" class="form-label sm:w-20">Promedio</label>
                                <input id="promedio" name="promedio" type="text" class="form-control" placeholder="92.80"
                                @if(isset($alumno))
                                    value="{{$alumno->promedio}}"
                                @else
                                    value="{{old('promedio')}}"
                                @endif>                             
                            </div> 
                            <div class="form-inline mt-5">
                                <label for="situacion" class="form-label sm:w-20">Situación</label>
                                <input id="situacion" name="situacion" type="text" class="form-control" placeholder="AC..."
                                @if(isset($alumno))
                                    value="{{$alumno->situacion}}"
                                @else
                                    value="{{old('carrera')}}"
                                @endif disabled>
                                <label for="carrera" class="form-label sm:w-20">Carrera</label>
                                <select id="carrera" name="carrera" data-placeholder="Selecciona la carrera" class="tom-select form-control">                                        
                                    <option value="0" selected>Selecciona la carrera...</option>
                                    @foreach ($carreras as $carrera)
                                        @if ($carrera->id == $alumno->carrera->id)
                                            <option value="{{$carrera->id}}" selected>{{$carrera->carrera}}</option>
                                        @else
                                            <option value="{{$carrera->id}}">{{$carrera->carrera}}</option>
                                        @endif
                                    @endforeach                                          
                                </select>  
                            </div>                                               
                            <div class="form-inline mt-5">                           
                                <label for="ciclo_ingreso" class="form-label sm:w-20">Ciclo Ingreso</label>
                                <input id="ciclo_ingreso" name="ciclo_ingreso" type="text" class="form-control" placeholder="2019A..."
                                @if(isset($alumno))
                                    value="{{$alumno->ciclo_ingreso}}"
                                @else
                                    value="{{old('ciclo_ingreso')}}"
                                @endif>
                                <label for="ciclo_egreso" class="form-label sm:w-20">Ciclo &nbsp;Egreso</label>
                                <input id="ciclo_egreso" name="ciclo_egreso" type="text" class="form-control" placeholder="2022B..."
                                @if(isset($alumno))
                                    value="{{$alumno->ciclo_egreso}}"
                                @else
                                    value="{{old('ciclo_egreso')}}" 
                                @endif>
                            </div>  
                            <div class="form-inline mt-5">
                                <label for="plan_estudios" class="form-label sm:w-20">Plan de Estudios</label>
                                <select id="plan_estudios" name="plan_estudios" data-placeholder="Selecciona el plan de estudios" class="tom-select form-control">                                        
                                    @foreach ($plan_estudios as $plan_estudio)
                                        @if ($alumno->id_plan_estudios == $plan_estudio->id)
                                            <option value="{{$plan_estudio->id}}" selected>{{$plan_estudio->nombre}}</option>
                                        @else
                                            <option value="{{$plan_estudio->id}}">{{$plan_estudio->nombre}}</option>
                                        @endif
                                    @endforeach                                         
                                </select> 
                            </div>   
                            <div class="form-inline mt-5">
                                <label for="articulo" class="form-label sm:w-20">Modalidad de Titulación</label>
                                <select id="articulo" name="articulo" class="tom-select form-control">                                                                            
                                    <option value="0" selected>Seleccione la modalidad de Titulación...</option>
                                    @foreach ($articulos as $articulo)
                                        @if ($alumno->id_articulo == $articulo->id)
                                            <option value="{{$articulo->id}}" selected>{{$articulo->nombre}}</option>
                                        @else
                                            <option value="{{$articulo->id}}">{{$articulo->nombre}}</option>
                                        @endif
                                    @endforeach                                                              
                                </select>   
                            </div>                                                        
                            <div class="form-inline mt-5">
                                <label for="opciones_titulacion" class="form-label sm:w-20">Opciones de Titulación</label>
                                <select id="opciones_titulacion" name="opciones_titulacion"  class="tom-select2 form-control">                                        
                                    @foreach ($opciones_titulacion as $opcion)
                                        @if ($alumno->id_opcion_titulacion == $opcion->id)
                                            <option value="{{$opcion->id}}" selected>{{$opcion->nombre}}</option>
                                        @elseif ($alumno->articulo->id == $opcion->articulo_id)
                                            <option value="{{$opcion->id}}">{{$opcion->nombre}}</option>
                                        @endif
                                    @endforeach                               
                                </select>   
                            </div> 
                            <div id="nombre_del_trabajo" @if(isset($alumno) && ($alumno->id_opcion_titulacion != 7 || $alumno->id_opcion_titulacion != 11 || $alumno->id_opcion_titulacion != 13 || $alumno->id_opcion_titulacion != 14 || $alumno->id_opcion_titulacion != 15 || $alumno->id_opcion_titulacion != 16 )) hidden @elseif(isset($alumno)!=true) hidden @endif >         
                                <div class="form-inline mt-5">
                                    <label for="nombre_del_trabajo" class="form-label sm:w-20">Título del Trabajo:</label>
                                    <input id="nombre_del_trabajo" name="nombre_del_trabajo" type="text" class="form-control" placeholder="Nombre del trabajo..."
                                    @if(isset($alumno))
                                        value="{{$alumno->user->nombre_del_trabajo}}"
                                    @else
                                        value="{{old('nombre_del_trabajo')}}"
                                    @endif> 
                                </div>     
                                <div id="ganador_de_proyecto" @if(isset($alumno) && $alumno->id_opcion_titulacion != 13) hidden @elseif(isset($alumno)!=true) hidden @endif>                                             
                                    <div class="form-inline mt-5">
                                    <label class="form-label sm:w-20">¿Ganador de proyecto?</label>
                                    <div class="form-check mr-2 "> 
                                        <input id="ganador_proyecto" class="form-check-input" type="radio" name="ganador_proyecto" value="SI" 
                                        @if ($alumno->ganador_proyecto_modular) checked @endif> 
                                        <label class="form-check-label" for="ganador_proyecto">SI</label> 
                                    </div>
                                    <div class="form-check mr-2 mt-2 sm:mt-0"> 
                                        <input id="ganador_proyecto" class="form-check-input" type="radio" name="ganador_proyecto" value="NO"
                                        @if (!$alumno->ganador_proyecto_modular) checked @endif> 
                                        <label class="form-check-label" for="ganador_proyecto">NO</label> 
                                    </div>
                                    </div>
                                </div>  
                            </div>                                                    
                            <div class="sm:ml-20 sm:pl-5 mt-5">
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

    <script>                             
        // Funcion para mostrar las opciones de titulacion
        $(document).ready(function(){
            jQuery('#articulo').on('change', function(){
                let id = $(this).val();
                console.log('Valor de id:', id);

                jQuery('#opciones_titulacion').empty();
                jQuery('#opciones_titulacion').append('<option value="0" disabled selected>Procesando...</option>');
                jQuery.ajax({
                    type: 'GET',
                    url: '/alumno/opciones_titulacion/'+id,
                    success: function(data){                    
                        jQuery('#opciones_titulacion').empty();
                        jQuery('#opciones_titulacion').append('<option value="0" disabled selected>Seleccione la opcion de Titulacion...</option>');
                        jQuery.each(data, function(index, opcion_titulacion){        
                            jQuery('#opciones_titulacion').append('<option value="'+opcion_titulacion.id+'">'+opcion_titulacion.nombre+'</option>');                        
                        });
                    }
                });
                
            });
        });
        // Funcion para mostrar los campos a rellenar segun la opcion de titulacion
        $(document).ready(function(){
            $('#opciones_titulacion').on('change', function(){
                let id = $(this).val();

                if (id == 7 || id == 11 || id == 13 || id == 14 || id == 15 || id == 16){
                    //Si es diseño
                    if (id == 13){
                        var intro = document.getElementById('ganador_de_proyecto');
                        intro.hidden = false;
                    }else{
                        var intro = document.getElementById('ganador_de_proyecto');
                        intro.hidden = true;
                    }

                    var intro = document.getElementById('nombre_del_trabajo');
                    intro.hidden = false;
                }else{
                    var intro = document.getElementById('nombre_del_trabajo');
                    intro.hidden = true;
                }
            });
        });
    </script>
@endsection
