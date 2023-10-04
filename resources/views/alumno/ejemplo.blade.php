@extends('../layout/' . $layout)

@section('subhead')
    <title>Mis Datos - Titulación CUCEI</title>
@endsection

@section('subcontent')
    
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
                                <select id="opciones_titulacion" name="opciones_titulacion"  class="tom-select form-control">                                        
                                    @if (isset($alumno))
                                        @foreach ($opciones_titulacion as $opcion)
                                            @if ($alumno->id_opcion_titulacion == $opcion->id)
                                                <option value="{{$opcion->id}}" selected>{{$opcion->nombre}}</option>
                                            @else
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
                            <div class="sm:ml-20 sm:pl-5 mt-5">
                                <button class="btn btn-primary">Guardar</button>                                               
                                <a class="btn btn-secondary" href="{{ route('showTramite',$alumno) }}">Cancelar</a>
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
    </div>   
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

    @if(isset($alumno))
        <script>              
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
                    //Excelencia academica
                    if (id == 1) {
                        var intro = document.getElementById('modalidad_promedio');
                        intro.hidden = false;

                        var intro = document.getElementById('examenes_ceneval');
                        intro.hidden = true;

                        var intro = document.getElementById('examen_capacitacion');
                        intro.hidden = true;

                        var intro = document.getElementById('nombre_del_trabajo');
                        intro.hidden = true;

                        var intro = document.getElementById('cursos_o_creditos');
                        intro.hidden = true;

                    }else{
                        var intro = document.getElementById('modalidad_promedio');
                        intro.hidden = true;

                        var intro = document.getElementById('examenes_ceneval');
                        intro.hidden = true;

                        var intro = document.getElementById('examen_capacitacion');
                        intro.hidden = true;

                        var intro = document.getElementById('nombre_del_trabajo');
                        intro.hidden = true;

                        var intro = document.getElementById('cursos_o_creditos');
                        intro.hidden = true;

                    }
                });
            });


        </script>
    @else
        <script>          
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
                    //Excelencia academica
                    if (id == 1) {
                        var intro = document.getElementById('modalidad_promedio');
                        intro.hidden = false;

                        var intro = document.getElementById('examenes_ceneval');
                        intro.hidden = true;

                        var intro = document.getElementById('examen_capacitacion');
                        intro.hidden = true;

                        var intro = document.getElementById('nombre_del_trabajo');
                        intro.hidden = true;

                        var intro = document.getElementById('documentos_exposiciones');
                        intro.hidden = true;

                    }else{
                        var intro = document.getElementById('modalidad_promedio');
                        intro.hidden = true;

                        var intro = document.getElementById('examenes_ceneval');
                        intro.hidden = true;

                        var intro = document.getElementById('examen_capacitacion');
                        intro.hidden = true;

                        var intro = document.getElementById('nombre_del_trabajo');
                        intro.hidden = true;

                        var intro = document.getElementById('cursos_o_creditos');
                        intro.hidden = true;

                        var intro = document.getElementById('documentos_exposiciones');
                        intro.hidden = true;

                    }
                });
            });          

        </script>
    @endif
@endsection
