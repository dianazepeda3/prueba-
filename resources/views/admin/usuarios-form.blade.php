@extends('../layout/' . $layout)

@section('subhead')
    <title>Usuarios - Titulación CUCEI</title>
@endsection

@section('subcontent')
    
    <div class="grid grid-cols-12 gap-6 mt-5">        
        <div class="intro-y col-span-12 lg:col-span-3"></div>
        <div class="intro-y col-span-12 lg:col-span-6">             
            <!-- BEGIN: Vertical Form 
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">Datos del Usuario</h2>                    
                </div>
                <div id="vertical-form" class="p-5">
                    <div class="preview">                        
                        <div>
                            <label for="nombre" class="form-label">Nombre Completo</label>
                            <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre de usuario ..."
                            @if(isset($usuario))
                                value="{{$usuario->name}}"
                            @else
                                value="{{old('nombre')}}"
                            @endif
                            required>
                        </div>
                        <div class="mt-3">
                            <label for="codigo" class="form-label">Código</label>
                            <input id="codigo" name="codigo" type="text" class="form-control" placeholder="Código ..."
                            @if(isset($usuario))
                                value="{{$usuario->codigo}}"
                            @else
                                value="{{old('codigo')}}"
                            @endif
                            required>
                        </div>
                        <div class="form-check mt-5">
                            <input id="vertical-form-3" class="form-check-input" type="checkbox" value="">
                            <label class="form-check-label" for="vertical-form-3">Remember me</label>
                        </div>
                        <button class="btn btn-primary mt-5">Login</button>
                    </div>
                    <div class="source-code hidden">
                        <button data-target="#copy-vertical-form" class="copy-code btn py-1 px-2 btn-outline-secondary">
                            <i data-lucide="file" class="w-4 h-4 mr-2"></i> Copy example code
                        </button>
                        <div class="overflow-y-auto mt-3 rounded-md">
                            <pre id="copy-vertical-form" class="source-preview">
                                <code class="html">
                                    {{ str_replace('>', 'HTMLCloseTag', str_replace('<', 'HTMLOpenTag', '
                                        <div>
                                            <label for="vertical-form-1" class="form-label">Email</label>
                                            <input id="vertical-form-1" type="text" class="form-control" placeholder="example@gmail.com">
                                        </div>
                                        <div class="mt-3">
                                            <label for="vertical-form-2" class="form-label">Password</label>
                                            <input id="vertical-form-2" type="text" class="form-control" placeholder="secret">
                                        </div>
                                        <div class="form-check mt-5">
                                            <input id="vertical-form-3" class="form-check-input" type="checkbox" value="">
                                            <label class="form-check-label" for="vertical-form-3">Remember me</label>
                                        </div>
                                        <button class="btn btn-primary mt-5">Login</button>
                                    ')) }}
                                </code>
                            </pre>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Vertical Form -->
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
            <!-- BEGIN: Horizontal Form -->
            <div class="intro-y box mt-5">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">DATOS DEL USUARIO</h2>                    
                </div>
                <div id="horizontal-form" class="p-5">
                    <div class="preview">
                        @if(isset($usuario))
                            <form class="form" method="POST" action="{{ route('usuarios_update',$usuario) }}">
                            @method('PATCH')
                        @else
                            <form class="form" method="POST" action="{{ route('usuarios_store') }}">
                        @endif
                        @csrf
                        <div class="form-inline">
                            <label for="nombre" class="form-label sm:w-20">Nombre Completo</label>
                            <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre..."
                                @if(isset($usuario))
                                    value="{{$usuario->name}}"
                                @else
                                    value="{{old('nombre')}}"
                                @endif>
                        </div>
                        <div class="form-inline mt-5">
                            <label for="codigo" class="form-label sm:w-20">Correo</label>
                            <input id="codigo" name="codigo" type="text" class="form-control" placeholder="correo@cucei.udg.mx..."
                                @if(isset($usuario))
                                    value="{{$usuario->codigo}}"
                                @else
                                    value="{{old('correo')}}"
                                @endif>
                        </div>
                        <div class="form-inline mt-5">
                            <label for="tipo" class="form-label sm:w-20">Tipo de Usuario</label>
                            <select id="tipo" name="tipo" class="form-control" aria-label=".form-select-sm example">
                                <option value="" selected>Seleccione el usuario...</option>   
                                <option value="1"
                                    @if(isset($usuario) && $usuario->admin_type == 1) selected @endif>Administrador</option>                              
                                <option value="2"
                                    @if(isset($usuario) && $usuario->admin_type == 2) selected @endif>Coordinador</option>                            
                                <option value="3"
                                    @if(isset($usuario) && $usuario->admin_type == 3) selected @endif>Biblioteca</option>    
                                <option value="4"
                                    @if(isset($usuario) && $usuario->admin_type == 4) selected @endif>Control Escolar</option>                                                             
                            </select>
                        </div>                       
                        <div id="carrera-container">                           
                                <div class="form-inline mt-5">
                                    <label for="carrera" class="form-label sm:w-20">Carrera</label>
                                    <select id="carrera" name="carrera" class="form-control" aria-label=".form-select-sm example">
                                        @if (isset($usuario))                        
                                            <option value="0" selected>Seleccione la carrera...</option>                        
                                            @foreach ($carreras as $carrera)
                                                @if (isset($coordinador) && $carrera->id == $coordinador->id_carrera)
                                                    <option value="{{$carrera->id}}" selected>{{$carrera->carrera}}</option>
                                                @else
                                                    <option value="{{$carrera->id}}">{{$carrera->carrera}}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option value="0" >Seleccione la carrera...</option>
                                            @foreach ($carreras as $carrera)
                                                @if ($carrera->id == old('carrera'))
                                                    <option value="{{$carrera->id}}" selected>{{$carrera->carrera}}</option>
                                                @else
                                                    <option value="{{$carrera->id}}">{{$carrera->carrera}}</option>
                                                @endif
                                            @endforeach
                                        @endif    
                                    </select>     
                                </div>  
                        </div>
                        @if(isset($usuario))
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
                            </div>
                            <div class="form-inline mt-5">
                                <label for="password_confirmed" class="form-label sm:w-20">Confirmar Contraseña</label>
                                <input id="password_confirmed" name="password_confirmed" type="password" class="form-control" placeholder="******">
                            </div>    
                        </div>                 
                            <div class="sm:ml-20 sm:pl-5 mt-5">
                                <button class="btn btn-primary">Guardar</button>                                               
                                <a class="btn btn-secondary" href="{{ route('usuarios') }}">Cancelar</a>
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
            var usuario = "{{isset($usuario)}}";
            var tipoUsuario = document.getElementById('tipo').value;
            console.log(tipoUsuario); 
            if(usuario){
                ocultarInfo();                                      
            }              
            var contenedorCarreras = document.getElementById('carrera-container');
                 
            contenedorCarreras.style.display = tipoUsuario === '2' ? 'block' : 'none'; 
        }       
        function mostrarOcultarCarreras() {
            var tipoUsuario = document.getElementById('tipo').value;
            var contenedorCarreras = document.getElementById('carrera-container');
                 
            contenedorCarreras.style.display = tipoUsuario === '2' ? 'block' : 'none';           
        }
        // Ejecutar la función cuando cambie el valor de "tipo"
        document.getElementById('tipo').addEventListener('change', mostrarOcultarCarreras);    
    </script>    
@endsection
