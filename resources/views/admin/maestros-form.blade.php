@extends('../layout/' . $layout)

@section('subhead')
    <title>Maestros - Titulación CUCEI</title>
@endsection

@section('subcontent')
    
    <div class="grid grid-cols-12 gap-6 mt-5">        
        <div class="intro-y col-span-12 lg:col-span-2"></div>
        <div class="intro-y col-span-12 lg:col-span-8">                        
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
            <!-- BEGIN: Horizontal Form -->
            <div class="intro-y box mt-5">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">DATOS DEL MAESTRO</h2>                    
                </div>
                <div id="horizontal-form" class="p-5">
                    <div class="preview">
                        @if(isset($maestro))
                            <form class="form" method="POST" action="{{ route('maestros_update',$maestro) }}">
                            @method('PATCH')
                        @else
                            <form class="form" method="POST" action="{{ route('maestros_store') }}">
                        @endif
                        @csrf
                        <div class="form-inline">
                            <label for="nombre" class="form-label sm:w-20">Nombre Completo</label>
                            <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre..."
                                @if(isset($maestro))
                                    value="{{$maestro->nombre}}"
                                @else
                                    value="{{old('nombre')}}"
                                @endif>
                        </div>                        
                        <div class="form-inline mt-5">
                            <label for="email" class="form-label sm:w-20">Correo</label>
                            <input id="email" name="email" type="text" class="form-control" placeholder="correo@ejemplo.com..."
                                @if(isset($maestro))
                                    value="{{$maestro->email}}"
                                @else
                                    value="{{old('email')}}"
                                @endif>
                        </div>
                        <div class="form-inline mt-5">
                            <label for="codigo" class="form-label sm:w-20">Código</label>
                            <input id="codigo" name="codigo" type="text" class="form-control" placeholder="123456789..."
                                @if(isset($maestro))
                                    value="{{$maestro->codigo}}"
                                @else
                                    value="{{old('codigo')}}"
                                @endif>
                            <label for="genero" class="form-label sm:w-20">Género</label>
                            <select id="genero" name="genero" class="form-control" aria-label=".form-select-sm example">                                
                                <option value="">Selecciona el género</option>                                 
                                <option value="H" @if (isset($maestro) && $maestro->genero == 'H') selected @endif>Masculino</option>
                                <option value="M" @if (isset($maestro) && $maestro->genero == 'M') selected @endif>Femenino</option>                                                                                                                        
                            </select>
                        </div>
                        <div class="form-inline mt-5">
                            <label for="grado" class="form-label sm:w-20">Grado de Estudios</label>
                            <select id="grado" name="grado" class="form-control" aria-label=".form-select-sm example">
                                @if (isset($maestro))
                                    <option value="Ingeniería" {{ $maestro->grado == 'Ingeniería' ? 'selected' : '' }}>Ingeniería</option>
                                    <option value="Licenciatura" {{ $maestro->grado == 'Licenciatura' ? 'selected' : '' }}>Licenciatura</option>
                                    <option value="Maestría" {{ $maestro->grado == 'Maestría' ? 'selected' : '' }}>Maestría</option>
                                    <option value="Doctorado" {{ $maestro->grado == 'Doctorado' ? 'selected' : '' }}>Doctorado</option>
                                @else
                                    <option value="0" {{ old('grado') == 0 ? 'selected' : '' }}>Seleccione el grado de estudios...</option>
                                    <option value="Ingeniería" {{ old('grado') == 'Ingeniería' ? 'selected' : '' }}>Ingeniería</option>
                                    <option value="Licenciatura" {{ old('grado') == 'Licenciatura' ? 'selected' : '' }}>Licenciatura</option>
                                    <option value="Maestría" {{ old('grado') == 'Maestría' ? 'selected' : '' }}>Maestría</option>
                                    <option value="Doctorado" {{ old('grado') == 'Doctorado' ? 'selected' : '' }}>Doctorado</option>            
                            @endif                                                         
                            </select>
                        </div>
                        @if(isset($maestro))
                            <div class="form-inline mt-5">
                                <div class="mt-2"> 
                                    <div class="flex flex-col sm:flex-row mt-2">
                                        <label class="form-label sm:w-20">Cambiar la contraseña</label>
                                        <div class="form-check mr-2 mt-2 sm:mt-0"> 
                                            <input id="contra" class="form-check-input" type="radio" name="contra" onclick="noCambiarPassword()" value="NO" checked> 
                                            <label class="form-check-label" for="contra">NO</label> 
                                        </div>
                                        <div class="form-check mr-2 "> 
                                            <input id="contra" class="form-check-input" type="radio" name="contra" onclick="cambiarPassword()" value="SI"> 
                                            <label class="form-check-label" for="contra">SI</label> 
                                        </div>                                    
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div id="passwords">
                            <div class="form-inline mt-5">
                                <label for="password" class="form-label sm:w-20">Contraseña</label>
                                <input id="password" name="password" type="password" class="form-control" placeholder="******">                           
                                <label for="password_confirmed" class="form-label sm:w-20">Confirmar Contraseña</label>
                                <input id="password_confirmed" name="password_confirmed" type="password" class="form-control" placeholder="******">
                            </div>    
                        </div>                 
                            <div class="sm:ml-20 sm:pl-5 mt-5">
                                <button class="btn btn-primary">Guardar</button>                                               
                                <a class="btn btn-secondary" href="{{ route('maestros') }}">Cancelar</a>
                            </div>                        
                        </form>
                    </div>                  
                </div>
            </div>
            <!-- END: Horizontal Form -->                       
        </div>
    </div>
    <script>   
        function ocultarInfo() {
            document.getElementById("passwords").style.display = "none";
        }
        function cambiarPassword() {         
            document.getElementById("passwords").style.display = "block";            
        }
        function noCambiarPassword() {
            document.getElementById("passwords").style.display = "none";
        }
                
        window.onload = function() { 
            var maestro = "{{isset($maestro)}}";
            if(maestro){
                ocultarInfo();                                      
            }               
        }           
    </script>
@endsection
