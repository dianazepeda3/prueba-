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
        <div class="intro-y col-span-12 lg:col-span-2"></div>
        <div class="intro-y col-span-12 lg:col-span-8">                         
            <!-- BEGIN: Horizontal Form -->
            <div class="intro-y box mt-5">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">DATOS ESCOLARES DEL USUARIO</h2>                    
                </div>
                <div id="horizontal-form" class="p-5">
                    <div class="preview">
                        @if(isset($alumno))
                            <form class="form" method="POST" action="{{ route('update-datos-escolares',$alumno) }}" enctype="multipart/form-data">
                            @method('PATCH') 
                        @else
                            <form class="form" method="POST" action="{{ route('datos-escolares') }}" enctype="multipart/form-data"> 
                        @endif                                                  
                            @csrf
                            <div class="form-inline">
                                <label for="nombre" class="form-label sm:w-20">Nombre Completo</label>
                                <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre..."
                                @if(isset($alumno))
                                    value="{{$alumno->user->name}}"
                                @else
                                    value="{{old('nombre')}}"
                                @endif
                                @can('alumno') disabled @endcan>
                            </div>
                            <div class="form-inline mt-5">
                                <label for="codigo" class="form-label sm:w-20">Código</label>
                                <input id="codigo" name="codigo" type="text" class="form-control" placeholder="123456789..."
                                @if(isset($alumno))
                                    value="{{$alumno->user->codigo}}"
                                @else
                                    value="{{old('codigo')}}"
                                @endif
                                @can('alumno') disabled @endcan>
                                <label for="promedio" class="form-label sm:w-20 espacio-form">Promedio</label>
                                <input id="promedio" name="promedio" type="text" class="form-control" placeholder="92.80"
                                @if(isset($alumno))
                                    value="{{$alumno->promedio}}"
                                @else
                                    value="{{old('promedio')}}"
                                @endif
                                @can('alumno') disabled @endcan>                           
                            </div> 
                            <div class="form-inline mt-5">
                                <label for="situacion" class="form-label sm:w-20">Situación</label>
                                @can('alumno')
                                    <input id="situacion" name="situacion" type="text" class="form-control" placeholder="AC..."
                                    @if(isset($alumno))
                                        value="{{$alumno->situacion}}"
                                    @else
                                        value="{{old('situacion')}}"
                                    @endif disabled>
                                @else
                                    <select id="situacion" name="situacion" class="form-control" aria-label=".form-select-sm example">
                                        <option value="" selected>Seleccione el estado civil...</option>                                   
                                        <option value="AC"
                                            @if(isset($alumno) && $alumno->situacion == "AC") selected @endif>Activo</option>                              
                                        <option value="EG"
                                            @if(isset($alumno) && $alumno->situacion == "EG") selected @endif>Egresado</option>                            
                                    </select>
                                @endif
                                @can('alumno')
                                    <label for="carrera" class="form-label sm:w-20 espacio-form">Carrera</label>
                                    <input id="carrera" name="carrera" type="text" class="form-control" placeholder="2019A..."
                                    @if(isset($alumno))
                                        value="{{ $alumno->carrera->clave }}"
                                    @else
                                        value="{{old('carrera')}}"
                                    @endif disabled>
                                @else
                                    <label for="carrera" class="form-label sm:w-20">Carrera</label>
                                    <select id="carrera" name="carrera" class="form-control" aria-label=".form-select-sm example">                                                          
                                        <option value="0" selected>Selecciona la carrera...</option>
                                        @foreach ($carreras as $carrera)
                                            @if (isset($alumno) && $carrera->id == $alumno->carrera->id)
                                                <option value="{{$carrera->id}}" selected>{{$carrera->carrera}}</option>
                                            @else
                                                <option value="{{$carrera->id}}">{{$carrera->carrera}}</option>
                                            @endif
                                        @endforeach  
                                    </select>
                                @endcan
                            </div>                                                                          
                            <div class="form-inline mt-5">                           
                                <label for="ciclo_ingreso" class="form-label sm:w-20">Ciclo Ingreso</label>
                                <input id="ciclo_ingreso" name="ciclo_ingreso" type="text" class="form-control" placeholder="2019A..."
                                @if(isset($alumno))
                                    value="{{$alumno->ciclo_ingreso}}"
                                @else
                                    value="{{old('ciclo_ingreso')}}"
                                @endif
                                @can('alumno') disabled @endcan> 
                                <label for="ciclo_egreso" class="form-label sm:w-20 espacio-form">Ciclo &nbsp;Egreso</label>
                                <input id="ciclo_egreso" name="ciclo_egreso" type="text" class="form-control" placeholder="2022B..."
                                @if(isset($alumno))
                                    value="{{$alumno->ciclo_egreso}}"
                                @else
                                    value="{{old('ciclo_egreso')}}" 
                                @endif
                                @can('alumno') disabled @endcan> 
                            </div>  
                            <div class="form-inline mt-5">
                                <label for="plan_estudios" class="form-label sm:w-20">Plan de Estudios</label>
                                <select id="plan_estudios" name="plan_estudios" data-placeholder="Selecciona el plan de estudios" class="tom-select form-control">                                        
                                    @if (isset($alumno))
                                        <option value="0">Seleccione su plan de estudios...</option>
                                        @foreach ($plan_estudios as $plan_estudio)
                                            @if ($alumno->id_plan_estudios == $plan_estudio->id)
                                                <option value="{{$plan_estudio->id}}" selected>{{$plan_estudio->nombre}}</option>
                                            @else
                                                <option value="{{$plan_estudio->id}}">{{$plan_estudio->nombre}}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        <option value="0" selected>Seleccione su plan de estudios...</option>
                                        @foreach ($plan_estudios as $plan_estudio)
                                            @if ($plan_estudio->id == old('plan_estudios'))
                                                <option value="{{$plan_estudio->id}}" selected>{{$plan_estudio->nombre}}</option>
                                            @else
                                                <option value="{{$plan_estudio->id}}">{{$plan_estudio->nombre}}</option>
                                            @endif
                                        @endforeach
                                    @endif                                      
                                </select> 
                            </div>   
                            <div class="form-inline mt-5">
                                <label for="articulo" class="form-label sm:w-20">Modalidad de Titulación</label>
                                <select id="articulo" name="articulo" class="tom-select form-control">                                        
                                    @if (isset($alumno))
                                        <option value="0" selected>Seleccione la modalidad de Titulación...</option>
                                        @foreach ($articulos as $articulo)
                                            @if ($alumno->id_articulo == $articulo->id)
                                                <option value="{{$articulo->id}}" selected>{{$articulo->nombre}}</option>
                                            @else
                                                <option value="{{$articulo->id}}">{{$articulo->nombre}}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        <option value="0" selected>Seleccione la modalidad de Titulación...</option>
                                        @foreach ($articulos as $articulo)
                                            @if ($articulo->id == old('articulo'))
                                                <option value="{{$articulo->id}}" selected>{{$articulo->nombre}}</option>
                                            @else
                                                <option value="{{$articulo->id}}">{{$articulo->nombre}}</option>
                                            @endif
                                        @endforeach
                                    @endif                                       
                                </select>   
                            </div>                                                        
                            <div class="form-inline mt-5">
                                <label for="opciones_titulacion" class="form-label sm:w-20">Opciones de Titulación</label>
                                <select id="opciones_titulacion" name="opciones_titulacion"  class="form-control">                                        
                                    @if (isset($alumno) && $alumno->tramite->estado != 1)
                                        @foreach ($opciones_titulacion as $opcion)
                                            @if ($alumno->id_opcion_titulacion == $opcion->id)
                                                <option value="{{$opcion->id}}" selected>{{$opcion->nombre}}</option>
                                            @elseif ($alumno->id_articulo == $opcion->articulo_id)
                                                <option value="{{$opcion->id}}">{{$opcion->nombre}}</option>
                                            @endif
                                        @endforeach 
                                    @else                                  
                                        @if (old('opciones_titulacion') == null)
                                            <option value="0" selected>Seleccione la opcion de Titulación...</option>
                                        @endif
                                        {{-- <option value="0" selected>Seleccione la opcion de Titulacion...</option> --}}
                                        @foreach ($opciones_titulacion as $opcion)
                                            @if ($opcion->id == old('opciones_titulacion'))
                                                <option value="{{$opcion->id}}" selected>{{$opcion->nombre}}</option>
                                            @else
                                                @if ($opcion->articulo_id == old('articulo'))
                                                    <option value="{{$opcion->id}}">{{$opcion->nombre}}</option>
                                                @endif
                                            @endif
                                        @endforeach
                                    @endif                             
                                </select>   
                            </div> 
                            <div id="nombre_del_trabajo" @if(isset($alumno) && ($alumno->id_opcion_titulacion != 7 && $alumno->id_opcion_titulacion != 11 && $alumno->id_opcion_titulacion != 13 && $alumno->id_opcion_titulacion != 14 && $alumno->id_opcion_titulacion != 15 && $alumno->id_opcion_titulacion != 16 )) hidden @elseif(isset($alumno)!=true) hidden @endif >         
                                <div class="form-inline mt-5">
                                    <label for="nombre_trabajo" class="form-label sm:w-20">Título del Trabajo:</label>
                                    <input id="nombre_trabajo" name="nombre_del_trabajo" type="text" class="form-control" placeholder="Nombre del trabajo..."
                                    @if(isset($alumno))
                                        value="{{$alumno->titulo_del_trabajo}}"
                                    @else
                                        value="{{old('nombre_del_trabajo')}}"
                                    @endif> 
                                </div>     
                                <div id="ganador_de_proyecto" @if(isset($alumno) && $alumno->id_opcion_titulacion != 13) hidden @elseif(isset($alumno)!=true) hidden @endif>                                             
                                    <div class="form-inline mt-5">
                                    <div class="form-label sm:w-20">¿Ganador de proyecto?</div>
                                    <div class="form-check mr-2 "> 
                                        <input id="ganador_proyecto1" class="form-check-input" type="radio" name="ganador_proyecto" value="SI" 
                                        @if (isset($alumno) && $alumno->ganador_proyecto_modular) checked @endif> 
                                        <label class="form-check-label" for="ganador_proyecto1">SI</label> 
                                    </div>
                                    <div class="form-check mr-2 mt-2 sm:mt-0"> 
                                        <input id="ganador_proyecto2" class="form-check-input" type="radio" name="ganador_proyecto" value="NO"
                                        @if (isset($alumno) && !$alumno->ganador_proyecto_modular) checked @endif> 
                                        <label class="form-check-label" for="ganador_proyecto2">NO</label> 
                                    </div>
                                    </div>
                                </div>  
                            </div>   
                            @if(!isset($alumno))    
                                <div class="form-inline mt-5">
                                    <label for="password" class="form-label sm:w-20">Contraseña</label>
                                    <input id="password" name="password" type="password" class="form-control" placeholder="******">                          
                                    <label for="password_confirmed" class="form-label sm:w-20">Confirmar Contraseña</label>
                                    <input id="password_confirmed" name="password_confirmed" type="password" class="form-control" placeholder="******">
                                </div>   
                            @endif                                           
                                <div class="sm:ml-20 sm:pl-5 mt-5">
                                    <button class="btn btn-primary" type="submit">Guardar</button>                                               
                                    <a class="btn btn-secondary" 
                                    @can('admin-coordinador') 
                                        @if (isset($alumno))
                                            href="{{ route('showTramite',$alumno) }}"
                                        @else
                                            href="{{ route('tramites') }}"
                                        @endif                                         
                                    @elsecan('alumno') href="{{ route('show-datos') }}" @endcan
                                    >Cancelar</a>
                                </div>                            
                        </form>
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
