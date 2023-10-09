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
                    <h2 class="font-medium text-base mr-auto">DATOS LABORALES DEL USUARIO</h2>                    
                </div>
                <div id="horizontal-form" class="p-5">
                    <div class="preview">
                        <form class="form" method="POST" action="{{ route('update-datos-laborales',$alumno) }}" enctype="multipart/form-data">
                            @method('PATCH') 
                            @csrf
                            <div class="form-inline">
                                <div class="mt-2"> 
                                    <div class="flex flex-col sm:flex-row mt-2">
                                        <label class="form-label sm:w-20">¿Trabaja?</label>
                                        <div class="form-check mr-2 mt-2 sm:mt-0"> 
                                            <input id="trabaja" class="form-check-input" type="radio" name="trabaja" onclick="ocultarPreg()" value="NO"
                                            @if ($alumno->trabaja == 0) checked @endif> 
                                            <label class="form-check-label" for="trabaja">NO</label> 
                                        </div>
                                        <div class="form-check mr-2 "> 
                                            <input id="trabaja" class="form-check-input" type="radio" name="trabaja" onclick="mostrarPreg()" value="SI"
                                            @if ($alumno->trabaja == 1) checked @endif> 
                                            <label class="form-check-label" for="trabaja">SI</label> 
                                        </div>                                    
                                    </div>
                                </div>
                            </div>
                            <div id="si-trabaja" class="form-inline">
                                <div class="mt-2"> 
                                    <div class="flex flex-col sm:flex-row mt-2">
                                        <label class="form-label sm:w-20">¿Realiza actividad laboral afin a su carrera?</label>                                    
                                        <div class="form-check mr-2 mt-2 sm:mt-0"> 
                                            <input id="afin" class="form-check-input" type="radio" name="afin" onclick="ocultarInfo()" value="NO"
                                            @if ($alumno->afin == 0) checked @endif> 
                                            <label class="form-check-label" for="afin">NO</label> 
                                        </div>
                                        <div class="form-check mr-2 ">                                         
                                            <input id="afin" class="form-check-input" type="radio" name="afin" onclick="mostrarInfo()" value="SI"
                                            @if ($alumno->afin == 1) checked @endif> 
                                            <label class="form-check-label" for="afin">SI</label> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="no-afin" style="display: none;">
                                <div class="form-inline mt-5">
                                    <label for="descripcion" class="form-label sm:w-20">Descripción del Trabajo</label>
                                    <textarea id="descripcion" name="descripcion" class="form-control" name="comment" placeholder="Descripción..." minlength="10" ></textarea> </div>                                                    
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
                                    <label for="telefono_empresa" class="form-label sm:w-20">Teléfono (empresa)</label>
                                    <input id="telefono_empresa" name="telefono_empresa" type="text" class="form-control" placeholder="1234567890..."
                                    @if(isset($alumno))
                                        value="{{$alumno->tel_empresa}}"
                                    @else
                                        value="{{old('telefono_empresa')}}"
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
                            <div class="sm:ml-20 sm:pl-5 mt-5">
                                <button class="btn btn-primary" type="submit">Guardar</button>                                               
                                @can('admin')                                                                    
                                    <a class="btn btn-secondary" href="{{ route('showTramite',$alumno) }}">Cancelar</a>
                                @else
                                    <a class="btn btn-secondary" href="{{ route('update-datos') }}">Regresar</a>
                                @endcan
                            </div>
                        </form>
                    </div>                   
                </div>
            </div>
            <!-- END: Horizontal Form -->                       
        </div>
    </div>    
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
    </script>
@endsection
