
@extends('../layout/' . $layout)

@section('subhead')
    <title>Mis Datos - Titulación CUCEI</title>
@endsection

@section('subcontent')
    {{-- ERRORES --}}
    <div class="grid grid-cols-12 gap-12 mt-5"> 
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
    @if(isset($alumno))
        <form class="" method="POST" action="{{ route('update-datos',$alumno) }}" enctype="multipart/form-data">
        @method('PATCH')        
    @else
        <form class="" method="POST" action=" " enctype="multipart/form-data">        
    @endif
            @csrf
            <div class="grid grid-cols-6 gap-6">        
                <div class="intro-y col-span-6 lg:col-span-12">  
                    <div class="flex flex-col sm:flex-row mt-2">                      
                        <!-- BEGIN: Horizontal Form -->
                        <div class="intro-y box mt-5">
                            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                                <h2 class="font-medium text-base mr-auto">DATOS ESCOLARES</h2>                    
                            </div>
                            <div id="horizontal-form" class="p-5">
                                <div class="preview">
                                    <div class="form-inline">
                                        <label for="nombre" class="form-label sm:w-20">Nombre Completo</label>
                                        <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre..."
                                        @if(isset($alumno->user->name))
                                            value="{{$alumno->user->name}}"
                                        @else
                                            value="{{old('nombre')}}"
                                        @endif disabled>
                                    </div>
                                    <div class="form-inline mt-5">
                                        <label for="codigo" class="form-label sm:w-20">Código</label>
                                        <input id="codigo" name="codigo" type="text" class="form-control" placeholder="123456789..."
                                        @if(isset($alumno->user->codigo))
                                            value="{{$alumno->user->codigo}}"
                                        @else
                                            value="{{old('codigo')}}"
                                        @endif disabled>  
                                        <label for="promedio" class="form-label sm:w-20">Promedio</label>
                                        <input id="promedio" name="promedio" type="text" class="form-control" placeholder="92.80"
                                        @if(isset($alumno))
                                            value="{{$alumno->promedio}}"
                                        @else
                                            value="{{old('promedio')}}"
                                        @endif disabled>                             
                                    </div> 
                                    <div class="form-inline mt-5">
                                        <label for="situacion" class="form-label sm:w-20">Situación</label>
                                        <input id="situacion" name="situacion" type="text" class="form-control" placeholder="AC..."
                                        @if(isset($alumno))
                                            value="{{$alumno->situacion}}"
                                        @else
                                            value="{{old('situacion')}}"
                                        @endif disabled>
                                        <label for="carrera" class="form-label sm:w-20">Carrera</label>
                                        <input id="carrera" name="carrera" type="text" class="form-control" placeholder="2019A..."
                                        @if(isset($alumno->carrera))
                                            value="{{ $alumno->carrera->clave }}"
                                        @else
                                            value="{{old('carrera')}}"
                                        @endif disabled>
                                    </div>                                               
                                    <div class="form-inline mt-5">                           
                                        <label for="ciclo_ingreso" class="form-label sm:w-20">Ciclo Ingreso</label>
                                        <input id="ciclo_ingreso" name="ciclo_ingreso" type="text" class="form-control" placeholder="2019A..."
                                        @if(isset($alumno))
                                            value="{{$alumno->ciclo_ingreso}}"
                                        @else
                                            value="{{old('ciclo_ingreso')}}"
                                        @endif disabled>
                                        <label for="ciclo_egreso" class="form-label sm:w-20">Ciclo &nbsp;Egreso</label>
                                        <input id="ciclo_egreso" name="ciclo_egreso" type="text" class="form-control" placeholder="2022B..."
                                        @if(isset($alumno))
                                            value="{{$alumno->ciclo_egreso}}"
                                        @else
                                            value="{{old('ciclo_egreso')}}" 
                                        @endif disabled>
                                    </div>  
                                    <div class="form-inline mt-5">
                                        <label for="plan_estudios" class="form-label sm:w-20">Plan de Estudios</label>
                                        <select id="plan_estudios" name="plan_estudios" data-placeholder="Selecciona el plan de estudios" class="tom-select form-control">                                                                                    
                                            @if (isset($alumno))
                                                <option value="0" selected>Seleccione el Plan de Estudios...</option>
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
                                        <select id="opciones_titulacion" name="opciones_titulacion"  class="tom-select2 form-control">                                        
                                            @if ($alumno->tramite->estado != 1)
                                                @foreach ($opciones_titulacion as $opcion)
                                                    @if ($alumno->id_opcion_titulacion == $opcion->id)
                                                        <option value="{{$opcion->id}}" selected>{{$opcion->nombre}}</option>
                                                    @elseif ($alumno->articulo->id == $opcion->articulo_id)
                                                        <option value="{{$opcion->id}}">{{$opcion->nombre}}</option>
                                                    @endif
                                                @endforeach 
                                            @else
                                                @if (old('opciones_titulacion') == null)
                                                    <option value="0" selected>Seleccione la opcion de Titulación...</option>
                                                @endif                                        
                                            @endif                     
                                        </select>   
                                    </div> 
                                    <div id="nombre_del_trabajo" @if(isset($alumno) && ($alumno->id_opcion_titulacion != 7 || $alumno->id_opcion_titulacion != 11 || $$id_opcion_titulacion != 13 || $$id_opcion_titulacion != 14 || $$id_opcion_titulacion != 15 || $$id_opcion_titulacion != 16 )) hidden @elseif(isset($alumno)!=true) hidden @endif >         
                                        <div class="form-inline mt-5">
                                            <label for="nombre_del_trabajo" class="form-label sm:w-20">Título del Trabajo:</label>
                                            <input id="nombre_del_trabajo" name="nombre_del_trabajo" type="text" class="form-control" placeholder="Nombre del trabajo..."
                                            @if(isset($alumno->user->nombre_del_trabajo))
                                                value="{{$alumno->user->nombre_del_trabajo}}"
                                            @else
                                                value="{{old('nombre_del_trabajo')}}"
                                            @endif> 
                                        </div>     
                                        <div id="ganador_de_proyecto" @if(isset($alumno) && $alumno->id_opcion_titulacion != 13) hidden @elseif(isset($alumno)!=true) hidden @endif>                                             
                                            <div class="form-inline mt-5">
                                            <label class="form-label sm:w-20">¿Ganador de proyecto?</label>
                                            <div class="form-check mr-2 mt-2 sm:mt-0"> 
                                                <input id="ganador_proyecto" class="form-check-input" type="radio" name="ganador_proyecto" value="NO"
                                                @if (!$alumno->ganador_proyecto_modular) checked @endif> 
                                                <label class="form-check-label" for="ganador_proyecto">NO</label> 
                                            </div>
                                            <div class="form-check mr-2 "> 
                                                <input id="ganador_proyecto" class="form-check-input" type="radio" name="ganador_proyecto" value="SI" 
                                                @if ($alumno->ganador_proyecto_modular) checked @endif> 
                                                <label class="form-check-label" for="ganador_proyecto">SI</label> 
                                            </div>                                            
                                            </div>
                                        </div>  
                                    </div>                                                                  
                                </div>                                
                            </div>
                        </div>
                        <!-- END: Horizontal Form -->  
                        <!-- BEGIN: Horizontal Form -->
                        <div class="intro-y box mt-5">
                            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                                <h2 class="font-medium text-base mr-auto">DATOS PERSONALES</h2>                    
                        </div>
                            <div id="horizontal-form" class="p-5">
                                <div class="preview">                        
                                    <div class="form-inline mt-5">
                                        <label for="fecha_nacimiento" class="form-label sm:w-20">Fecha de Nacimiento</label>
                                        <input id="fecha_nacimiento" name="fecha_nacimiento" type="date" class="  form-control w-56 block mx-auto" data-single-mode="true"  value="2004-12-31"
                                        @if (isset($alumno->fecha_nacimiento))
                                            value="{{$alumno->fecha_nacimiento}}"
                                        @else
                                            value="{{old('fecha_nacimiento')}}"
                                        @endif
                                        min="1920-01-01"
                                        max="2018-12-31">  
                                    </div>  
                                    <div class="form-inline mt-3">
                                        <label class="form-label sm:w-20"></label>
                                        <label class="form-label sm:w-64"><b>Lugar de Nacimiento</b></label>
                                    </div>
                                    <div class="form-inline mt-2">                           
                                        <label for="estado_nacimiento" class="form-label sm:w-20">Estado</label>
                                        <input id="estado_nacimiento" name="estado_nacimiento" type="text" class="form-control" placeholder="Jalisco..." value="Jalisco"
                                        @if(isset($alumno))
                                            value="{{$alumno->estado_nacimiento}}"
                                        @else
                                            value="{{old('estado_nacimiento')}}"
                                        @endif>
                                    
                                        <label for="municipio_nacimiento" class="form-label sm:w-20">Ciudad o Municipio</label>
                                        <input id="municipio_nacimiento" name="municipio_nacimiento" type="text" class="form-control" placeholder="Guadalajara..." value="Guadalajara"
                                        @if(isset($alumno))
                                            value="{{$alumno->municipio_nacimiento}}"
                                        @else
                                            value="{{old('municipio_nacimiento')}}"
                                        @endif>
                                    </div>
                                    <div class="form-inline mt-5">
                                        <label for="estado_civil" class="form-label sm:w-20">Estado Civil</label>
                                        <select id="estado_civil" name="estado_civil" class="form-control" aria-label=".form-select-sm example">
                                            <option value="0" selected>Seleccione el estado civil...</option>                                   
                                            <option value="Soltero"
                                                @if(isset($alumno) && $alumno->estado_civil == "Soltero") selected @endif>Soltero</option>                              
                                            <option value="Casado"
                                                @if(isset($alumno) && $alumno->estado_civil == "Casado") selected @endif>Casado</option>                            
                                        </select>
                                    
                                        <label for="genero" class="form-label sm:w-20">Género</label>
                                        <select id="genero" name="genero" class="form-control" aria-label=".form-select-sm example">
                                            <option value="0" selected>Seleccione el género...</option>                                   
                                            <option value="Mujer"
                                                @if(isset($alumno) && $alumno->genero == "Mujer") selected @endif>Femenino</option>                              
                                            <option value="Hombre"
                                                @if(isset($alumno) && $alumno->genero == "Hombre") selected @endif>Masculino</option>                            
                                        </select>
                                    </div>
                                    <div class="form-inline mt-5">                           
                                        <label for="telefono_celular" class="form-label sm:w-20">Teléfono Celular</label>
                                        <input id="telefono_celular" name="telefono_celular" type="text" class="form-control" placeholder="3334327654..." value="3334327654"
                                        @if(isset($alumno))
                                            value="{{$alumno->telefono_celular}}"
                                        @else
                                            value="{{old('telefono_celular')}}"
                                        @endif>
                                        <label for="telefono_particular" class="form-label sm:w-20">Teléfono Particular</label>
                                        <input id="telefono_particular" name="telefono_particular" type="text" class="form-control" placeholder="3334327654..." value="3334327654"
                                        @if(isset($alumno))
                                            value="{{$alumno->telefono_particular}}"
                                        @else
                                            value="{{old('telefono_particular')}}" 
                                        @endif>
                                    </div>
                                    <div class="form-inline mt-5">
                                        <label class="form-label sm:w-20"></label>
                                        <label class="form-label sm:w-64"><b>Domicilio</b></label>
                                    </div>
                                    <div class="form-inline mt-2">                           
                                        <label for="domicilio_calle" class="form-label sm:w-20">Calle</label>
                                        <input id="domicilio_calle" name="domicilio_calle" type="text" class="form-control" placeholder="Calle..." value="Calle"
                                        @if(isset($alumno))
                                            value="{{$alumno->dom_calle}}"
                                        @else
                                            value="{{old('domicilio_calle')}}"
                                        @endif>
                                    
                                        <label for="domicilio_numero" class="form-label sm:w-20">Número</label>
                                        <input id="domicilio_numero" name="domicilio_numero" type="text" class="form-control" placeholder="13..." value="13"
                                        @if(isset($alumno))
                                            value="{{$alumno->dom_numero}}"
                                        @else
                                            value="{{old('domicilio_numero')}}"
                                        @endif>
                                    </div>
                                    <div class="form-inline mt-2">                           
                                        <label for="domicilio_colonia" class="form-label sm:w-20">Colonia</label>
                                        <input id="domicilio_colonia" name="domicilio_colonia" type="text" class="form-control" placeholder="Colonia..." value="Colonia"
                                        @if(isset($alumno))
                                            value="{{$alumno->dom_colonia}}"
                                        @else
                                            value="{{old('domicilio_colonia')}}"
                                        @endif>
                                    
                                        <label for="domicilio_cp" class="form-label sm:w-20">CP</label>
                                        <input id="domicilio_cp" name="domicilio_cp" type="text" class="form-control" placeholder="12345..." value="12345"
                                        @if(isset($alumno))
                                            value="{{$alumno->dom_CP}}"
                                        @else
                                            value="{{old('domicilio_cp')}}"
                                        @endif>
                                    </div>
                                    <div class="form-inline mt-2">                           
                                        <label for="domicilio_estado" class="form-label sm:w-20">Estado</label>
                                        <input id="domicilio_estado" name="domicilio_estado" type="text" class="form-control" placeholder="Jalisco..." value="Jalisco"
                                        @if(isset($alumno))
                                            value="{{$alumno->dom_estado}}"
                                        @else
                                            value="{{old('domicilio_estado')}}"
                                        @endif>
                                    
                                        <label for="domicilio_municipio" class="form-label sm:w-20">Ciudad o Municipio</label>
                                        <input id="domicilio_municipio" name="domicilio_municipio" type="text" class="form-control" placeholder="Guadalajara..." value="Guadalajara"
                                        @if(isset($alumno))
                                            value="{{$alumno->dom_municipio}}"
                                        @else
                                            value="{{old('domicilio_municipio')}}"
                                        @endif>
                                    </div>
                                    <div class="form-inline mt-5">
                                        <label for="correo_institucional" class="form-label sm:w-20">Correo Institucional</label>
                                        <input id="correo_institucional" name="correo_institucional" type="text" class="form-control" placeholder="correo@alumnos.udg.mx" value="correo@alumnos.udg.mx"
                                        @if(isset($alumno))
                                            value="{{$alumno->correo_institucional}}"
                                        @else
                                            value="{{old('correo_institucional')}}"
                                        @endif>
                                    </div>
                                    <div class="form-inline mt-5">
                                        <label for="correo_particular" class="form-label sm:w-20">Correo Particular</label>
                                        <input id="correo_particular" name="correo_particular" type="text" class="form-control" placeholder="correo@ejemplo.com..." value="correo@ejemplo.com..."
                                        @if(isset($alumno))
                                            value="{{$alumno->correo_part}}"
                                        @else
                                            value="{{old('correo_particular')}}"
                                        @endif>
                                    </div>                                                                  
                                </div>                       
                            </div>
                        </div>
                        <!-- END: Horizontal Form --> 
                    </div>   
                </div>
            </div>            
            <div class="sm:pl-5 mt-5">
                <button class="btn btn-primary" type="submit">Guardar</button>                                               
                <!--<a class="btn btn-secondary" href=" ">Cancelar</a>-->
            </div>
        </form>

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

    
    <script>   
        function mostrarInfo() {
            document.getElementById("campos-trabajo").style.display = "block";
            document.getElementById("no-afin").style.display = "none";
        }
        function ocultarInfo() {
            document.getElementById("no-afin").style.display = "block";
            document.getElementById("campos-trabajo").style.display = "none";
        }
        function mostrarPreg() {
            var afin = "{{ $alumno->afin}}"; 
            document.getElementById("si-trabaja").style.display = "block";
            
            if (afin == 1) {
                mostrarInfo();
            }else{                            
                ocultarInfo();
            } 
        }
        function ocultarPreg() {
            document.getElementById("si-trabaja").style.display = "none";
            document.getElementById("no-afin").style.display = "none";
            document.getElementById("campos-trabajo").style.display = "none";
        }
                
        window.onload = function() { 
            var afin = "{{$alumno->afin}}";
            var trabaja = "{{$alumno->trabaja}}";            
            if(trabaja == 1){
                mostrarPreg();                                      
            }else{
                ocultarPreg();             
            }                
        }                 
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
