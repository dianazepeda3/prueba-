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
    <div class="grid grid-cols-12 gap-6">        
        <div class="intro-y col-span-12 lg:col-span-2"></div>
        <div class="intro-y col-span-12 lg:col-span-8">                       
            <!-- BEGIN: Horizontal Form -->
            <div class="intro-y box mt-5">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">DATOS PERSONALES DEL USUARIO</h2>                    
                </div>
                <div id="horizontal-form" class="p-5">
                    <div class="preview"> 
                        <form class="form" method="POST" action="{{ route('update-datos-personales',$alumno) }}" enctype="multipart/form-data">
                            @method('PATCH') 
                            @csrf                       
                            <div class="form-inline mt-5">
                                <label for="fecha_nacimiento" class="form-label sm:w-20">Fecha de Nacimiento</label>
                                <input id="fecha_nacimiento" name="fecha_nacimiento" type="date" class="  form-control w-56 block mx-auto" data-single-mode="true" placeholder="13 Dic, 1989"
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
                                <label for="municipio_nacimiento" class="form-label sm:w-20 espacio-form">Ciudad o Municipio</label>
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
                            
                                <label for="genero" class="form-label sm:w-20 espacio-form">Género</label>
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
                                <input id="telefono_celular" name="telefono_celular" type="text" class="form-control" placeholder="3334327654..."
                                @if(isset($alumno))
                                    value="{{$alumno->telefono_celular}}"
                                @else
                                    value="{{old('telefono_celular')}}"
                                @endif>
                                <label for="telefono_particular" class="form-label sm:w-20 espacio-form">Teléfono Particular</label>
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
                            
                                <label for="domicilio_numero" class="form-label sm:w-20 espacio-form">Número</label>
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
                            
                                <label for="domicilio_cp" class="form-label sm:w-20 espacio-form">CP</label>
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
                            
                                <label for="domicilio_municipio" class="form-label sm:w-20 espacio-form">Ciudad o Municipio</label>
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
                                <label for="correo_particular" class="form-label sm:w-20">Correo Particular</label>
                                <input id="correo_particular" name="correo_particular" type="text" class="form-control" placeholder="correo@ejemplo.com..."
                                @if(isset($alumno))
                                    value="{{$alumno->correo_part}}"
                                @else
                                    value="{{old('correo_particular')}}"
                                @endif>
                            </div>                                                            
                            <div class="sm:ml-20 sm:pl-5 mt-5">
                                <button class="btn btn-primary" type="submit">Guardar</button>                                               
                                <a class="btn btn-secondary" 
                                @can('admin-coordinador') href="{{ route('showTramite',$alumno) }}" @elsecan('alumno') href="{{ route('show-datos') }}" @endcan
                                >Cancelar</a>
                            </div>
                        </form>  
                    </div>
                </div>
            </div>
            <!-- END: Horizontal Form -->                       
        </div>
    </div>
@endsection
