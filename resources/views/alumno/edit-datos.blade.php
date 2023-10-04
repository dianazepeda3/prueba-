
@extends('../layout/' . $layout)

@section('subhead')
    <title>Mis Datos - Titulación CUCEI</title>
@endsection

@section('subcontent')

    
    @if(isset($alumno))
        <form class="" method="POST" action="{{ route('update-datos',$alumno) }}" enctype="multipart/form-data">
        @method('PATCH')        
    @else
        <form class="" method="POST" action=" " enctype="multipart/form-data">        
    @endif
            @csrf
            <div class="grid grid-cols-6 gap-6 mt-5">        
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
                                        @if(isset($alumno))
                                            value="{{$alumno->user->name}}"
                                        @else
                                            value="{{old('nombre')}}"
                                        @endif disabled>
                                    </div>
                                    <div class="form-inline mt-5">
                                        <label for="codigo" class="form-label sm:w-20">Código</label>
                                        <input id="codigo" name="codigo" type="text" class="form-control" placeholder="123456789..."
                                        @if(isset($alumno))
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
                                            value="{{old('carrera')}}"
                                        @endif disabled>
                                        <label for="carrera" class="form-label sm:w-20">Carrera</label>
                                        <input id="carrera" name="carrera" type="text" class="form-control" placeholder="2019A..."
                                        @if(isset($alumno))
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
                                        <select id="plan_estudios" data-placeholder="Selecciona el plan de estudios" class="tom-select form-control">                                        
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
                                            @if (isset($alumno))
                                                @if (old('opciones_titulacion') == null)
                                                    <option value="0" selected>Seleccione la opcion de Titulación...</option>
                                                @endif                                         
                                            @else
                                                @if (old('opciones_titulacion') == null)
                                                    <option value="0" selected>Seleccione la opcion de Titulación...</option>
                                                @endif                                        
                                            @endif                                    
                                        </select>   
                                    </div>                                                           
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
                        <!-- BEGIN: Horizontal Form -->
                        <div class="intro-y box mt-5">
                            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                                <h2 class="font-medium text-base mr-auto">DATOS PERSONALES</h2>                    
                        </div>
                            <div id="horizontal-form" class="p-5">
                                <div class="preview">                        
                                    <div class="form-inline mt-5">
                                        <label for="nombre" class="form-label sm:w-20">Fecha de Nacimiento</label>
                                        <input type="text" class="datepicker form-control w-56 block mx-auto" data-single-mode="true" placeholder="13 Dec, 1989"
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
                                        <input id="estado_nacimiento" name="estado_nacimiento" type="text" class="form-control" placeholder="Jalisco..."
                                        @if(isset($alumno))
                                            value="{{$alumno->estado_nacimiento}}"
                                        @else
                                            value="{{old('estado_nacimiento')}}"
                                        @endif>
                                    
                                        <label for="municipio_nacimiento" class="form-label sm:w-20">Ciudad o Municipio</label>
                                        <input id="municipio_nacimiento" name="municipio_nacimiento" type="text" class="form-control" placeholder="Guadalajara..."
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
                                    
                                        <label for="estado_civil" class="form-label sm:w-20">Género</label>
                                        <select id="estado_civil" name="estado_civil" class="form-control" aria-label=".form-select-sm example">
                                            <option value="0" selected>Seleccione el género...</option>                                   
                                            <option value="Mujer"
                                                @if(isset($alumno) && $alumno->genero == "Mujer") selected @endif>Femenino</option>                              
                                            <option value="Hombre"
                                                @if(isset($alumno) && $alumno->genero == "Hombre") selected @endif>Masculino</option>                            
                                        </select>
                                    </div>
                                    <div class="form-inline mt-5">                           
                                        <label for="telefono_celular" class="form-label sm:w-20">Teléfono Celular</label>
                                        <input id="telefono_celular" name="telefono_celular" type="text" class="form-control" placeholder="3334327654..."
                                        @if(isset($alumno))
                                            value="{{$alumno->telefono_celular}}"
                                        @else
                                            value="{{old('telefono_celular')}}"
                                        @endif>
                                        <label for="telefono_particular" class="form-label sm:w-20">Teléfono Particular</label>
                                        <input id="telefono_particular" name="telefono_particular" type="text" class="form-control" placeholder="3334327654..."
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
                                        <input id="domicilio_calle" name="domicilio_calle" type="text" class="form-control" placeholder="Calle..."
                                        @if(isset($alumno))
                                            value="{{$alumno->dom_calle}}"
                                        @else
                                            value="{{old('domicilio_calle')}}"
                                        @endif>
                                    
                                        <label for="domicilio_numero" class="form-label sm:w-20">Número</label>
                                        <input id="domicilio_numero" name="domicilio_numero" type="text" class="form-control" placeholder="13..."
                                        @if(isset($alumno))
                                            value="{{$alumno->dom_numero}}"
                                        @else
                                            value="{{old('domicilio_numero')}}"
                                        @endif>
                                    </div>
                                    <div class="form-inline mt-2">                           
                                        <label for="domicilio_colonia" class="form-label sm:w-20">Colonia</label>
                                        <input id="domicilio_colonia" name="domicilio_colonia" type="text" class="form-control" placeholder="Colonia..."
                                        @if(isset($alumno))
                                            value="{{$alumno->dom_colonia}}"
                                        @else
                                            value="{{old('domicilio_colonia')}}"
                                        @endif>
                                    
                                        <label for="domicilio_cp" class="form-label sm:w-20">CP</label>
                                        <input id="domicilio_cp" name="domicilio_cp" type="text" class="form-control" placeholder="12345..."
                                        @if(isset($alumno))
                                            value="{{$alumno->dom_CP}}"
                                        @else
                                            value="{{old('domicilio_cp')}}"
                                        @endif>
                                    </div>
                                    <div class="form-inline mt-2">                           
                                        <label for="domicilio_estado" class="form-label sm:w-20">Estado</label>
                                        <input id="domicilio_estado" name="domicilio_estado" type="text" class="form-control" placeholder="Jalisco..."
                                        @if(isset($alumno))
                                            value="{{$alumno->dom_estado}}"
                                        @else
                                            value="{{old('domicilio_estado')}}"
                                        @endif>
                                    
                                        <label for="domicilio_municipio" class="form-label sm:w-20">Ciudad o Municipio</label>
                                        <input id="domicilio_municipio" name="domicilio_municipio" type="text" class="form-control" placeholder="Guadalajara..."
                                        @if(isset($alumno))
                                            value="{{$alumno->dom_municipio}}"
                                        @else
                                            value="{{old('domicilio_municipio')}}"
                                        @endif>
                                    </div>
                                    <div class="form-inline mt-5">
                                        <label for="correo_institucional" class="form-label sm:w-20">Correo Institucional</label>
                                        <input id="correo_institucional" name="correo_institucional" type="text" class="form-control" placeholder="correo@alumnos.udg.mx"
                                        @if(isset($alumno))
                                            value="{{$alumno->correo_institucional}}"
                                        @else
                                            value="{{old('correo_institucional')}}"
                                        @endif>
                                    </div>
                                    <div class="form-inline mt-5">
                                        <label for="correo_particular" class="form-label sm:w-20">Correo Institucional</label>
                                        <input id="correo_particular" name="correo_particular" type="text" class="form-control" placeholder="correo@ejemplo.com..."
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
            <div class="grid grid-cols-12 gap-6 mt-5">     
                <div class="intro-y col-span-12 lg:col-span-2"></div>
                <div class="intro-y col-span-12 lg:col-span-8"> 
                    <!-- BEGIN: Horizontal Form -->
                    <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                            <h2 class="font-medium text-base mr-auto">DATOS LABORALES</h2>                    
                        </div>
                        <div id="horizontal-form" class="p-5">
                            <div class="preview">
                                <div class="form-inline">
                                    <div class="mt-2"> 
                                        <div class="flex flex-col sm:flex-row mt-2">
                                            <label class="form-label sm:w-20">¿Trabaja?</label>
                                            <div class="form-check mr-2 "> 
                                                <input id="trabaja" class="form-check-input" type="radio" name="trabaja" onclick="mostrarPreg()" value=""
                                                @if ($alumno->trabaja == 1) checked @endif> 
                                                <label class="form-check-label" for="trabaja">SI</label> 
                                            </div>
                                            <div class="form-check mr-2 mt-2 sm:mt-0"> 
                                                <input id="trabaja" class="form-check-input" type="radio" name="trabaja" onclick="ocultarPreg()" value=""
                                                @if ($alumno->trabaja == 0) checked @endif> 
                                                <label class="form-check-label" for="trabaja">NO</label> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="si-trabaja" class="form-inline">
                                    <div class="mt-2"> 
                                        <div class="flex flex-col sm:flex-row mt-2">
                                            <label class="form-label sm:w-20">¿Realiza actividad laboral afin a su carrera?</label>
                                            <div class="form-check mr-2 ">                                         
                                                <input id="afin" class="form-check-input" type="radio" name="afin" onclick="mostrarInfo()" value=""
                                                @if ($alumno->afin == 1) checked @endif> 
                                                <label class="form-check-label" for="afin">SI</label> 
                                            </div>
                                            <div class="form-check mr-2 mt-2 sm:mt-0"> 
                                                <input id="afin" class="form-check-input" type="radio" name="afin" onclick="ocultarInfo()" value=""
                                                @if ($alumno->afin == 0) checked @endif> 
                                                <label class="form-check-label" for="afin">NO</label> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="no-afin" style="display: none;">
                                    <div class="form-inline mt-5">
                                        <label for="descripcion" class="form-label sm:w-20">Descripción del Trabajo</label>
                                        <textarea id="descripcion" class="form-control" name="comment" placeholder="Descripción..." minlength="10" required></textarea> </div>                                                    
                                    </div>
                                </div>
                                <div id="campos-trabajo" style="display: none;"> 
                                    <div class="form-inline mt-5">
                                        <label for="nombre_empresa" class="form-label sm:w-20">Nombre de la Empresa</label>
                                        <input id="nombre_empresa" name="nombre_empresa" type="text" class="form-control" placeholder="Nombre empresa..."
                                        @if(isset($alumno))
                                            value="{{$alumno->nombre_empresa}}"
                                        @else
                                            value="{{old('nombre_empresa')}}"
                                        @endif>                        
                                        <label for="puesto" class="form-label sm:w-20">Puesto</label>
                                        <input id="puesto" name="puesto" type="text" class="form-control" placeholder="Becario..."
                                        @if(isset($alumno))
                                            value="{{$alumno->puesto}}"
                                        @else
                                            value="{{old('puesto')}}"
                                        @endif>
                                    </div>
                                    <div class="form-inline mt-5">
                                        <label for="sueldo_mensual" class="form-label sm:w-20">Sueldo Mensual</label>
                                        <input id="sueldo_mensual" name="sueldo_mensual" type="text" class="form-control" placeholder="6000..."
                                        @if(isset($alumno))
                                            value="{{$alumno->sueldo_mensual}}"
                                        @else
                                            value="{{old('sueldo_mensual')}}"
                                        @endif>
                                        <label for="tel_empresa" class="form-label sm:w-20">Teléfono (empresa)</label>
                                        <input id="tel_empresa" name="tel_empresa" type="text" class="form-control" placeholder="1234567890..."
                                        @if(isset($alumno))
                                            value="{{$alumno->tel_empresa}}"
                                        @else
                                            value="{{old('tel_empresa')}}"
                                        @endif>
                                    </div>                                                
                                    <div class="form-inline mt-5">
                                        <label class="form-label sm:w-20"></label>
                                        <label class="form-label sm:w-64"><b>Domicilio</b></label>
                                    </div>
                                    <div class="form-inline mt-2">                           
                                        <label for="empresa_calle" class="form-label sm:w-20">Calle</label>
                                        <input id="empresa_calle" name="empresa_calle" type="text" class="form-control" placeholder="Calle..."
                                        @if(isset($alumno))
                                            value="{{$alumno->empresa_calle}}"
                                        @else
                                            value="{{old('empresa_calle')}}"
                                        @endif>
                                    
                                        <label for="empresa_numero" class="form-label sm:w-20">Número</label>
                                        <input id="empresa_numero" name="empresa_numero" type="text" class="form-control" placeholder="13..."
                                        @if(isset($alumno))
                                            value="{{$alumno->empresa_numero}}"
                                        @else
                                            value="{{old('empresa_numero')}}"
                                        @endif>
                                    </div>
                                    <div class="form-inline mt-2">                           
                                        <label for="empresa_colonia" class="form-label sm:w-20">Colonia</label>
                                        <input id="empresa_colonia" name="empresa_colonia" type="text" class="form-control" placeholder="Colonia..."
                                        @if(isset($alumno))
                                            value="{{$alumno->empresa_colonia}}"
                                        @else
                                            value="{{old('empresa_colonia')}}"
                                        @endif>
                                    
                                        <label for="empresa_CP" class="form-label sm:w-20">CP</label>
                                        <input id="empresa_CP" name="empresa_CP" type="text" class="form-control" placeholder="12345..."
                                        @if(isset($alumno))
                                            value="{{$alumno->empresa_CP}}"
                                        @else
                                            value="{{old('empresa_CP')}}"
                                        @endif>
                                    </div>
                                    <div class="form-inline mt-2">                           
                                        <label for="empresa_estado" class="form-label sm:w-20">Estado</label>
                                        <input id="empresa_estado" name="empresa_estado" type="text" class="form-control" placeholder="Jalisco..."
                                        @if(isset($alumno))
                                            value="{{$alumno->empresa_estado}}"
                                        @else
                                            value="{{old('empresa_estado')}}"
                                        @endif>
                                    
                                        <label for="empresa_municipio" class="form-label sm:w-20">Ciudad o Municipio</label>
                                        <input id="empresa_municipio" name="empresa_municipio" type="text" class="form-control" placeholder="Guadalajara..."
                                        @if(isset($alumno))
                                            value="{{$alumno->empresa_municipio}}"
                                        @else
                                            value="{{old('empresa_municipio')}}"
                                        @endif>
                                    </div> 
                                </div>                                                                                                            
                            </div>                  
                        </div>
                    </div>
                    <!-- END: Horizontal Form -->                    
                </div>
            </div>
            <div class=" sm:pl-5 mt-5">
                <button class="btn btn-primary" type="submit">Guardar</button>                                               
                <a class="btn btn-secondary" href="{{ route('showTramite',$alumno) }}">Cancelar</a>
            </div>
        </form>

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

    @if(isset($alumno))
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
        </script>
    @else
        <script>
            //Funcion para validar que el campo de examen_ceneval sea entre 700 y 1300 y los otros campos flotantes de dos decimales
            $(document).ready(function(){
                $('#promedio').on('change', function(){
                    var examen_ceneval = $(this).val();
                    //verifying the input is a float number of two decimal places
                    var regex = /^\d+\.\d{2}$/;
                    if(!regex.test(examen_ceneval)){
                        console.log('error');
                        var intro = document.getElementById('modalidad_promedio_feedback');
                        intro.hidden = false;
                        // alert("El valor del campo Examen Ceneval 1 debe ser un numero de dos decimales");
                        $(this).val('');
                    }else{
                        var intro = document.getElementById('modalidad_promedio_feedback');
                        intro.hidden = true;
                    }
                });
                $('#calificacion_curso').on('change', function(){
                    var examen_ceneval = $(this).val();
                    //verifying the input is a float number of two decimal places
                    var regex = /^\d+\.\d{2}$/;
                    if(!regex.test(examen_ceneval)){
                        console.log('error');
                        var intro = document.getElementById('calificacion_curso_feedback');
                        intro.hidden = false;
                        // alert("El valor del campo Examen Ceneval 1 debe ser un numero de dos decimales");
                        $(this).val('');
                    }else{
                        var intro = document.getElementById('calificacion_curso_feedback');
                        intro.hidden = true;
                    }
                });
                $('#examen_ceneval_1').on('change', function(){
                    var examen_ceneval = $(this).val();
                    //verifying the input is a number between 700 and 1300
                    if(examen_ceneval < 700 || examen_ceneval > 1300){
                        var intro = document.getElementById('examen_ceneval_1_feedback');
                        intro.hidden = false;
                        $(this).val('');
                    }else{
                        var intro = document.getElementById('examen_ceneval_1_feedback');
                        intro.hidden = true;
                    }

                });
                $('#examen_ceneval_2').on('change', function(){
                    var examen_ceneval = $(this).val();
                    //verifying the input is a number between 700 and 1300
                    if(examen_ceneval < 700 || examen_ceneval > 1300){
                        var intro = document.getElementById('examen_ceneval_2_feedback');
                        intro.hidden = false;
                        $(this).val('');
                    }else{
                        var intro = document.getElementById('examen_ceneval_2_feedback');
                        intro.hidden = true;
                    }
                });
                $('#examen_ceneval_3').on('change', function(){
                    var examen_ceneval = $(this).val();
                    //verifying the input is a number between 700 and 1300
                    if(examen_ceneval < 700 || examen_ceneval > 1300){
                        var intro = document.getElementById('examen_ceneval_3_feedback');
                        intro.hidden = false;
                        $(this).val('');
                    }else{
                        var intro = document.getElementById('examen_ceneval_3_feedback');
                        intro.hidden = true;
                    }
                });
                $('#examen_ceneval_4').on('change', function(){
                    var examen_ceneval = $(this).val();
                    //verifying the input is a number between 700 and 1300
                    if(examen_ceneval < 700 || examen_ceneval > 1300){
                        var intro = document.getElementById('examen_ceneval_4_feedback');
                        intro.hidden = false;
                        $(this).val('');
                    }else{
                        var intro = document.getElementById('examen_ceneval_4_feedback');
                        intro.hidden = true;
                    }
                });
                $('#examen_ceneval_5').on('change', function(){
                    var examen_ceneval = $(this).val();
                    //verifying the input is a number between 700 and 1300
                    if(examen_ceneval < 700 || examen_ceneval > 1300){
                        var intro = document.getElementById('examen_ceneval_5_feedback');
                        intro.hidden = false;
                        $(this).val('');
                    }else{
                        var intro = document.getElementById('examen_ceneval_5_feedback');
                        intro.hidden = true;
                    }
                });
                $('#examen_ceneval_6').on('change', function(){
                    var examen_ceneval = $(this).val();
                    //verifying the input is a number between 700 and 1300
                    if(examen_ceneval < 700 || examen_ceneval > 1300){
                        var intro = document.getElementById('examen_ceneval_6_feedback');
                        intro.hidden = false;
                        $(this).val('');
                    }else{
                        var intro = document.getElementById('examen_ceneval_6_feedback');
                        intro.hidden = true;
                    }
                });
                $('#examen_ceneval_7').on('change', function(){
                    var examen_ceneval = $(this).val();
                    //verifying the input is a number between 700 and 1300
                    if(examen_ceneval < 700 || examen_ceneval > 1300){
                        var intro = document.getElementById('examen_ceneval_7_feedback');
                        intro.hidden = false;
                        $(this).val('');
                    }else{
                        var intro = document.getElementById('examen_ceneval_7_feedback');
                        intro.hidden = true;
                    }
                });
            });

            // Funcion para mostrar las opciones de titulacion
            $(document).ready(function(){
                $('#articulo').on('change', function(){
                    let id = $(this).val();
                    $('#opciones_titulacion').empty();
                    $('#opciones_titulacion').append('<option value="0" disabled selected>Procesando...</option>');
                    $.ajax({
                        type: 'GET',
                        url: '/alumno/opciones_titulacion/'+id,
                        success: function(data){
                            $('#opciones_titulacion').empty();
                            $('#opciones_titulacion').append('<option value="0" disabled selected>Seleccione la opcion de Titulacion...</option>');
                            $.each(data, function(index, opcion_titulacion){
                                $('#opciones_titulacion').append('<option value="'+opcion_titulacion.id+'">'+opcion_titulacion.nombre+'</option>');
                            });
                        }
                    });                    
                });
            });


        </script>
    @endif    
    
@endsection
