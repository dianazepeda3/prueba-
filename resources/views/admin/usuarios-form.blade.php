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
            <!-- BEGIN: Horizontal Form -->
            <div class="intro-y box mt-5">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">DATOS DEL USUARIO</h2>                    
                </div>
                <div id="horizontal-form" class="p-5">
                    <div class="preview">
                        <div class="form-inline">
                            <label for="nombre" class="form-label sm:w-20">Nombre Completo</label>
                            <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre...">
                        </div>
                        <div class="form-inline mt-5">
                            <label for="codigo" class="form-label sm:w-20">Código</label>
                            <input id="codigo" name="codigo" type="text" class="form-control" placeholder="123456789...">
                        </div>
                        <div class="form-inline mt-5">
                            <label for="tipo" class="form-label sm:w-20">Tipo de Usuario</label>
                            <select id="tipo" name="tipo" class="form-control" aria-label=".form-select-sm example">
                                <option value="0" selected>Seleccione el usuario...</option>   
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
                        <div class="form-inline mt-5">
                            <label for="password" class="form-label sm:w-20">Contraseña</label>
                            <input id="password" name="password" type="password" class="form-control" placeholder="******">
                        </div>
                        <div class="form-inline mt-5">
                            <label for="password_confirmed" class="form-label sm:w-20">Confirmar Contraseña</label>
                            <input id="password_confirmed" name="password_confirmed" type="password" class="form-control" placeholder="******">
                        </div>                     
                        <div class="sm:ml-20 sm:pl-5 mt-5">
                            <button class="btn btn-primary">Guardar</button>                                               
                            <a class="btn btn-secondary" href="{{ route('usuarios') }}">Cancelar</a>
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
        </div>
    </div>
@endsection
