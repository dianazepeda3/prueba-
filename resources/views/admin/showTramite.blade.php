@extends('../layout/' . $layout)

@section('subhead')
    <title>Trámite - Titulación CUCEI</title>
@endsection

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="flex items-center text-lg font-medium mr-auto">
            <a href="{{ route('tramites') }}">Trámites</a> <i class="w-4 h-4 mx-2 !stroke-2" data-lucide="arrow-right"></i> {{ $alumno->user->name }}
        </h2>
        <!--<div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button class="btn btn-primary shadow-md mr-2">
                <i class="w-4 h-4 mr-2" data-lucide="file-text"></i> View Full Report
            </button>
        </div>-->
    </div>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-3">
        <!--can('biblioteca')    -->             
            <div class="col-md-12"> 
                @if($alumnoDocs->solicitud_constancia_no_adeudo_biblioteca && !$alumnoDocs->constancia_no_adeudo_biblioteca)  
                    <div class="btn-group mr-2">                        
                        <a href="{{route('generar_formatoNoAdeudo',$tramite)}}"  class="btn btn-primary btn-icon-split" id="citatorio" >
                            <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2 blanco" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>.blanco{fill:#ffffff}</style><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM112 256H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>
                            <span class="text">Generar Formato de No Adeudo</span>
                        </a>                        
                    </div>
                @endif                
            </div>
            <div class="col-md-12"> 
                <!-- Boton de Carta de No Adeudo Autorizada -->                
                @if($alumnoDocs->solicitud_constancia_no_adeudo_universidad && !$alumnoDocs->constancia_no_adeudo_universidad)  
                    <div class="btn-group mr-2">
                        <a href="{{route('generar_formatoNoAdeudo_ce',$tramite)}}"  class="btn btn-primary btn-icon-split" id="aprobar" >
                            <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2 blanco" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>.blanco{fill:#ffffff}</style><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM112 256H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>
                            <span class="text">Carta de No Adeudo Autorizada</span>
                        </a>
                    </div>
                @endif 
            </div>
        <!--endcan-->
        @can('control-escolar')                             
            <div class="col-md-12"> 
                @if(!$alumnoDocs->constancia_no_adeudo_universidad)  
                    <div class="btn-group mr-2">                        
                        <a href="{{route('admin.formatoNoAdeudoCE',$tramite)}}"  class="btn btn-info btn-icon-split" id="citatorio" >
                            <span class="icon"><i class="fas fa-file-alt"></i></span>
                            <span class="text">Generar Formato de No Adeudo</span>
                        </a>                        
                    </div>
                @endif                
            </div>
        @endcan
        <!--can('admin-coordinador')                  -->            
            <div class="form-inline">
                <!-- Boton de Finalizar Trámite -->                    
                @if($tramite->estado == 15)
                    <div class="btn-group mr-2">
                        <a href="#"  class="btn btn-success btn-icon-split" id="aprobarButton" data-toggle="modal" data-target="#aprobarTramiteModal">
                            <span class="icon"><i class="fas fa-check"></i></span>
                            <span class="text">Finalizar Tramite</span>
                        </a>
                    </div>
                @endif
                <!-- Boton de Consultar Kardex -->                
                @if($tramite->estado == 2)
                    <div class="btn-group mr-2">
                        <a href="{{route('admin.kardex',$tramite)}}"  class="btn btn-primary btn-icon-split" id="aprobar" >
                            <span class="icon"><i class="fas fa-file-alt"></i></span>
                            <span class="text">Consultar Kárdex</span>
                        </a>
                    </div>
                @endif
                <!-- Boton de Validar Documentos -->                
                @if($aprobados && $tramite->estado == 3 || $aprobados && $tramite->estado == 7 || $aprobados && $tramite->estado == 10)
                    <!--Estado - Documentos Entregados -->
                    <div class="btn-group mr-2">
                        <a href="{{route('validar-documentos',$tramite)}}"  class="btn btn-primary btn-icon-split" id="aprobar" >
                            <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2 blanco" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>.blanco{fill:#ffffff}</style><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>
                            <span class="text">Validar Documentos</span>
                        </a>
                    </div>
                @elseif(($revisados && $tramite->estado == 3 || $revisados && $tramite->estado == 7 || $revisados && $tramite->estado == 10))
                    <!--Estado - Documentos Entregados -->
                    <div class="btn-group mr-2">
                        <a href="{{route('revisar-documentos',$tramite)}}"  class="btn btn-primary btn-icon-split" id="aprobar" >
                            <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2 blanco" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>.blanco{fill:#ffffff}</style><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>
                            <span class="text">Documentos Revisados</span>
                        </a>
                    </div>
                @elseif($tramite->estado == 4)
                    <!-- Boton de Generar Dictamen -->
                    @if($alumnoDocs->dictamen == 0)
                        <div class="btn-group mr-2">                        
                            <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#modal-dictamen" class="btn btn-primary" id="citatorio" >
                                <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2 blanco" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>.blanco{fill:#ffffff}</style><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM112 256H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>
                                <span class="text">Generar Dictamen</span>
                            </a>                        
                        </div>
                    @endif
                    @if($alumnoDocs->comprobante_academica == 0 && $alumnoDocs->dictamen == 1)
                        <div class="btn-group mr-2">                        
                            <a href="{{route('generar_comprobante_academico',$tramite)}}"  class="btn btn-primary" id="citatorio" >
                                <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2 blanco" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>.blanco{fill:#ffffff}</style><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM112 256H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>
                                <span class="text">Generar Comprobante Academico</span>
                            </a>                        
                        </div>
                    @endif
                    <!-- Boton de Pasar a 2da etapa -->                
                    @if($alumnoDocs->dictamen == 1 && $alumnoDocs->comprobante_academica == 1)
                        <div class="btn-group mr-2">
                            <a href="{{route('pasar_etapa2',$tramite)}}"  class="btn btn-primary btn-icon-split" id="aprobar" >
                                <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2 blanco" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>.blanco{fill:#ffffff}</style><path d="M52.5 440.6c-9.5 7.9-22.8 9.7-34.1 4.4S0 428.4 0 416V96C0 83.6 7.2 72.3 18.4 67s24.5-3.6 34.1 4.4L224 214.3V256v41.7L52.5 440.6zM256 352V256 128 96c0-12.4 7.2-23.7 18.4-29s24.5-3.6 34.1 4.4l192 160c7.3 6.1 11.5 15.1 11.5 24.6s-4.2 18.5-11.5 24.6l-192 160c-9.5 7.9-22.8 9.7-34.1 4.4s-18.4-16.6-18.4-29V352z"/></svg>
                                <span class="text">Pasar a 2da Etapa</span>
                            </a>
                        </div>
                    @endif  
                <!-- Estado - Documentos Validados 2da Etapa-->                            
                @elseif ($tramite->estado == 8)
                    @can('admin')                                                    
                        <!-- Boton de Generar Citatorio -->
                        <div class="btn-group mr-2">
                            <a href="{{route('admin.tramite.editar.datos.titulacion',$alumno)}}"  class="btn btn-info btn-icon-split" id="citatorio" >
                                <span class="icon"><i class="fas fa-file-alt"></i></span>
                                <span class="text">Generar Datos de Titulación</span>
                            </a>
                        </div>   
                    @endcan           
                @elseif($tramite->estado == 7 || $tramite->estado == 8 && $alumno->tipo_de_ceremonia == 'INDIVIDUAL')
                    <!-- Boton de descargar Citatorio -->
                    
                @endif
                @if(isset($alumno) && $tramite->estado > 5)
                    <!--PROTESTA-->
                @endif  
                @if($tramite->estado == 11)
                    <div class="btn-group mr-2">
                        <a href="{{route('admin.tramites.etapa3',$tramite)}}"  class="btn btn-primary btn-icon-split" id="aprobar" >
                            <span class="icon"><i class="fas fa-file-alt"></i></span>
                            <span class="text">Pasar a 3ra Etapa</span>
                        </a>
                    </div>
                @endif                                      
                <!-- Boton de Editar -->
                @can('coordinador')
                    @if ($tramite->estado < 6)
                        <div class="btn-group mr-2">
                            <a  href="{{ route('admin.tramite.edit', $tramite) }}" class="btn btn-warning btn-icon-split" id="editarButton">
                                <span class="icon"><i class="fas fa-pen"></i></span>
                                <span class="text">Editar</span>
                            </a>
                        </div>
                        <!-- Boton de Eliminar -->
                        <div class="btn-group mr-2">
                            <a  class="btn btn-danger btn-icon-split" id="eliminarButton" href="#" data-toggle="modal" data-target="#eliminarTramiteModal{{$tramite->id}}">
                                <span class="icon"><i class="fas fa-times"></i></span>
                                <span class="text">Eliminar</span>
                            </a>
                        </div>   
                    @endif                        
                @endcan
                @can('admin')                        
                    <div class="btn-group mr-2">
                        <a  href="{{ route('admin.tramite.edit', $tramite) }}" class="btn btn-warning btn-icon-split" id="editarButton">
                            <span class="icon"><i class="fas fa-pen"></i></span>
                            <span class="text">Editar</span>
                        </a>
                    </div>
                    <!-- Boton de Eliminar -->
                    <div class="btn-group mr-2">
                        <a  class="btn btn-danger btn-icon-split" id="eliminarButton" href="#" data-toggle="modal" data-target="#eliminarTramiteModal{{$tramite->id}}">
                            <span class="icon"><i class="fas fa-times"></i></span>
                            <span class="text">Eliminar</span>
                        </a>
                    </div>   
                @endcan
                                
                <!-- Boton de Notificar -->
                @if($tramite->estado == 0)
                    <div class="btn-group mr-2" id="eliminararErrorButton">
                        <a href="{{ route('admin.tramites.eliminarError' , $tramite) }}" class="btn btn-dark btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-info-circle"></i>
                            </span>
                            <span class="text">Eliminar estado de Error</span>
                        </a>
                    </div>
                <!-- Boton de Notificar -->
                @else
                    <div class="btn-group mr-2" id="notificarErrorButton" href="#" data-toggle="modal" data-target="#notificarErrorTramite">                    
                        <a href="#" class="btn btn-dark btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-info-circle"></i>
                            </span>
                            <span class="text">Notificar de Error</span>
                        </a>
                    </div>
                @endif
            </div>          
            <!-- Estado - Datos Titulación -->    
            @if(isset($alumno) && ($tramite->estado >= 13))                  
                <div class="col-md-12 mb-3">
                    @if($tramite->estado == 7 || $tramite->estado == 8 && $alumno->tipo_de_ceremonia == 'INDIVIDUAL')
                        <!-- Boton de descargar Citatorio -->
                        <div class="btn-group mr-2">
                            <a href="{{ route('admin.tramite.documentos.descargar.citatorio', $alumno) }}"  class="btn btn-info btn-icon-split" id="citatorio_descarga">
                                <span class="icon"><i class="fas fa-file-alt"></i></span>
                                <span class="text">Descargar Citatorio</span>
                            </a>
                        </div>
                    @endif
                    <!-- Boton de Descargar Acta -->
                    <div class="btn-group mr-2">
                        <a href="{{route('admin.tramite.documentos.descargar.acta',$alumno)}}"  class="btn btn-primary btn-icon-split" id="acta_titulacion">
                            <span class="icon"><i class="fas fa-file-contract"></i></span>
                            <span class="text">Descargar Acta de Titulación</span>
                        </a>
                    </div>
                    <!-- Boton de Descargar Protesta -->
                    <div class="btn-group mr-2">
                        <a href="{{ route('admin.tramite.documentos.descargar.protesta', $alumno) }}"  class="btn btn-secondary btn-icon-split" id="protesta_descarga">
                            <span class="icon"><i class="fas fa-file-word"></i></span>
                            <span class="text">Descargar Protesta</span>
                        </a>
                    </div>                  
                    <!-- Boton de Descargar Acta circunstanciada -->
                    <div class="btn-group mr-2">
                        <a href="{{route('admin.tramite.documentos.descargar.actacirunstanciada',$alumno)}}"  class="btn btn-secondary btn-icon-split" id="acta_titulacion">
                            <span class="icon"><i class="fas fa-file-invoice"></i></span>
                            <span class="text">Descargar Acta Circunstanciada</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-12">
                    <!-- Boton de Subir Acta firmada -->
                    <div class="btn-group mr-2">
                        <a href="#"  class="btn btn-info btn-icon-split" id="acta_titulacion" data-toggle="modal" data-target="#subirActaFirmadaModal">
                            <span class="icon"><i class="fas fa-file-upload"></i></span>
                            <span class="text">Subir Acta de Titulación Firmada</span>
                        </a>
                    </div>                        
                    <!-- Boton de Descargar Acta  -->
                    <div class="btn-group mr-2">
                        <a href="{{route('admin.tramite.editar.datos.titulacion',$alumno)}}"  class="btn btn-warning btn-icon-split" id="acta_titulacion">
                            <span class="icon"><i class="fas fa-graduation-cap"></i></span>
                            <span class="text">Editar Datos de Titulacion</span>
                        </a>
                    </div>
                </div>
            @endif 
        <!--endcan        -->
    </div>
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
    <div class="grid grid-cols-12 gap-5 ">
        <!-- BEGIN: Product Detail Side Menu -->
        <div class="col-span-12 xl:col-span-6">
            <div class="box intro-y p-5 mt-5">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium text-base truncate">Datos Escolares</div>
                    <a class="w-4 h-4 text-slate-500 ml-auto" href="{{ route('edit-datos-escolares',$alumno) }}"><i data-lucide="edit"></i></a>
                </div>
                <div class="flex items-center">
                    <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="currentColor" d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm80 256h64c44.2 0 80 35.8 80 80c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16c0-44.2 35.8-80 80-80zm-32-96a64 64 0 1 1 128 0 64 64 0 1 1 -128 0zm256-32H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H368c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H368c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H368c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>
                     <b>Nombre:&nbsp;</b> {{ $alumno->user->name }}
                </div>
                <div class="flex items-center mt-3">
                    <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="currentColor" d="M256 0h64c17.7 0 32 14.3 32 32V96c0 17.7-14.3 32-32 32H256c-17.7 0-32-14.3-32-32V32c0-17.7 14.3-32 32-32zM64 64H192v48c0 26.5 21.5 48 48 48h96c26.5 0 48-21.5 48-48V64H512c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128C0 92.7 28.7 64 64 64zM176 437.3c0 5.9 4.8 10.7 10.7 10.7H389.3c5.9 0 10.7-4.8 10.7-10.7c0-29.5-23.9-53.3-53.3-53.3H229.3c-29.5 0-53.3 23.9-53.3 53.3zM288 352a64 64 0 1 0 0-128 64 64 0 1 0 0 128z"/></svg>
                    <b>Código:</b>&nbsp; {{ $alumno->user->codigo }}
                </div>
                <div class="flex items-center mt-3">
                    <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="currentColor" d="M320 32c-8.1 0-16.1 1.4-23.7 4.1L15.8 137.4C6.3 140.9 0 149.9 0 160s6.3 19.1 15.8 22.6l57.9 20.9C57.3 229.3 48 259.8 48 291.9v28.1c0 28.4-10.8 57.7-22.3 80.8c-6.5 13-13.9 25.8-22.5 37.6C0 442.7-.9 448.3 .9 453.4s6 8.9 11.2 10.2l64 16c4.2 1.1 8.7 .3 12.4-2s6.3-6.1 7.1-10.4c8.6-42.8 4.3-81.2-2.1-108.7C90.3 344.3 86 329.8 80 316.5V291.9c0-30.2 10.2-58.7 27.9-81.5c12.9-15.5 29.6-28 49.2-35.7l157-61.7c8.2-3.2 17.5 .8 20.7 9s-.8 17.5-9 20.7l-157 61.7c-12.4 4.9-23.3 12.4-32.2 21.6l159.6 57.6c7.6 2.7 15.6 4.1 23.7 4.1s16.1-1.4 23.7-4.1L624.2 182.6c9.5-3.4 15.8-12.5 15.8-22.6s-6.3-19.1-15.8-22.6L343.7 36.1C336.1 33.4 328.1 32 320 32zM128 408c0 35.3 86 72 192 72s192-36.7 192-72L496.7 262.6 354.5 314c-11.1 4-22.8 6-34.5 6s-23.5-2-34.5-6L143.3 262.6 128 408z"/></svg>                        
                    <b>Carrera:</b>&nbsp; {{ $alumno->carrera->clave }}
                </div>
                <div class="flex items-center mt-3">
                    <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="currentColor" d="M0 80v48c0 17.7 14.3 32 32 32H48 96V80c0-26.5-21.5-48-48-48S0 53.5 0 80zM112 32c10 13.4 16 30 16 48V384c0 35.3 28.7 64 64 64s64-28.7 64-64v-5.3c0-32.4 26.3-58.7 58.7-58.7H480V128c0-53-43-96-96-96H112zM464 480c61.9 0 112-50.1 112-112c0-8.8-7.2-16-16-16H314.7c-14.7 0-26.7 11.9-26.7 26.7V384c0 53-43 96-96 96H368h96z"/></svg>
                    <b>Promedio:</b>&nbsp; {{ $alumno->promedio }}
                </div>
                <div class="flex items-center mt-3">
                    <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>
                    <b>Situación:</b>&nbsp; {{ $alumno->situacion }}
                </div>
                <div class="flex items-center mt-3">
                    <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="currentColor" d="M128 32V64H80c-26.5 0-48 21.5-48 48v48H480V112c0-26.5-21.5-48-48-48H384V32c0-17.7-14.3-32-32-32s-32 14.3-32 32V64H192V32c0-17.7-14.3-32-32-32s-32 14.3-32 32zM480 192H32V464c0 26.5 21.5 48 48 48H432c26.5 0 48-21.5 48-48V192zM256 248c13.3 0 24 10.7 24 24v56h56c13.3 0 24 10.7 24 24s-10.7 24-24 24H280v56c0 13.3-10.7 24-24 24s-24-10.7-24-24V376H176c-13.3 0-24-10.7-24-24s10.7-24 24-24h56V272c0-13.3 10.7-24 24-24z"/></svg>
                    <b>Ciclo Ingreso:</b>&nbsp; {{ $alumno->ciclo_ingreso }}
                </div>
                <div class="flex items-center mt-3">
                    <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="currentColor" d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zM329 305c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-95 95-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L329 305z"/></svg>
                    <b>Ciclo Egreso:</b>&nbsp; {{ $alumno->ciclo_egreso }}
                </div>
                @if($alumno->tramite->estado != 1)                                    
                    <div class="flex items-center mt-3">
                        <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="currentColor" d="M249.6 471.5c10.8 3.8 22.4-4.1 22.4-15.5V78.6c0-4.2-1.6-8.4-5-11C247.4 52 202.4 32 144 32C93.5 32 46.3 45.3 18.1 56.1C6.8 60.5 0 71.7 0 83.8V454.1c0 11.9 12.8 20.2 24.1 16.5C55.6 460.1 105.5 448 144 448c33.9 0 79 14 105.6 23.5zm76.8 0C353 462 398.1 448 432 448c38.5 0 88.4 12.1 119.9 22.6c11.3 3.8 24.1-4.6 24.1-16.5V83.8c0-12.1-6.8-23.3-18.1-27.6C529.7 45.3 482.5 32 432 32c-58.4 0-103.4 20-123 35.6c-3.3 2.6-5 6.8-5 11V456c0 11.4 11.7 19.3 22.4 15.5z"/></svg>
                        <b>Plan de Estudios:</b>&nbsp; {{ $alumno->plan_estudios->nombre }}
                    </div>
                    <div class="flex items-center mt-3">
                        <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="currentColor" d="M173.8 5.5c11-7.3 25.4-7.3 36.4 0L228 17.2c6 3.9 13 5.8 20.1 5.4l21.3-1.3c13.2-.8 25.6 6.4 31.5 18.2l9.6 19.1c3.2 6.4 8.4 11.5 14.7 14.7L344.5 83c11.8 5.9 19 18.3 18.2 31.5l-1.3 21.3c-.4 7.1 1.5 14.2 5.4 20.1l11.8 17.8c7.3 11 7.3 25.4 0 36.4L366.8 228c-3.9 6-5.8 13-5.4 20.1l1.3 21.3c.8 13.2-6.4 25.6-18.2 31.5l-19.1 9.6c-6.4 3.2-11.5 8.4-14.7 14.7L301 344.5c-5.9 11.8-18.3 19-31.5 18.2l-21.3-1.3c-7.1-.4-14.2 1.5-20.1 5.4l-17.8 11.8c-11 7.3-25.4 7.3-36.4 0L156 366.8c-6-3.9-13-5.8-20.1-5.4l-21.3 1.3c-13.2 .8-25.6-6.4-31.5-18.2l-9.6-19.1c-3.2-6.4-8.4-11.5-14.7-14.7L39.5 301c-11.8-5.9-19-18.3-18.2-31.5l1.3-21.3c.4-7.1-1.5-14.2-5.4-20.1L5.5 210.2c-7.3-11-7.3-25.4 0-36.4L17.2 156c3.9-6 5.8-13 5.4-20.1l-1.3-21.3c-.8-13.2 6.4-25.6 18.2-31.5l19.1-9.6C65 70.2 70.2 65 73.4 58.6L83 39.5c5.9-11.8 18.3-19 31.5-18.2l21.3 1.3c7.1 .4 14.2-1.5 20.1-5.4L173.8 5.5zM272 192a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM1.3 441.8L44.4 339.3c.2 .1 .3 .2 .4 .4l9.6 19.1c11.7 23.2 36 37.3 62 35.8l21.3-1.3c.2 0 .5 0 .7 .2l17.8 11.8c5.1 3.3 10.5 5.9 16.1 7.7l-37.6 89.3c-2.3 5.5-7.4 9.2-13.3 9.7s-11.6-2.2-14.8-7.2L74.4 455.5l-56.1 8.3c-5.7 .8-11.4-1.5-15-6s-4.3-10.7-2.1-16zm248 60.4L211.7 413c5.6-1.8 11-4.3 16.1-7.7l17.8-11.8c.2-.1 .4-.2 .7-.2l21.3 1.3c26 1.5 50.3-12.6 62-35.8l9.6-19.1c.1-.2 .2-.3 .4-.4l43.2 102.5c2.2 5.3 1.4 11.4-2.1 16s-9.3 6.9-15 6l-56.1-8.3-32.2 49.2c-3.2 5-8.9 7.7-14.8 7.2s-11-4.3-13.3-9.7z"/></svg>
                        <b>Artículo:</b>&nbsp; {{ $alumno->articulo->modalidad }}
                    </div>
                    <div class="flex  mt-3">
                        <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="currentColor" d="M219.3 .5c3.1-.6 6.3-.6 9.4 0l200 40C439.9 42.7 448 52.6 448 64s-8.1 21.3-19.3 23.5L352 102.9V160c0 70.7-57.3 128-128 128s-128-57.3-128-128V102.9L48 93.3v65.1l15.7 78.4c.9 4.7-.3 9.6-3.3 13.3s-7.6 5.9-12.4 5.9H16c-4.8 0-9.3-2.1-12.4-5.9s-4.3-8.6-3.3-13.3L16 158.4V86.6C6.5 83.3 0 74.3 0 64C0 52.6 8.1 42.7 19.3 40.5l200-40zM111.9 327.7c10.5-3.4 21.8 .4 29.4 8.5l71 75.5c6.3 6.7 17 6.7 23.3 0l71-75.5c7.6-8.1 18.9-11.9 29.4-8.5C401 348.6 448 409.4 448 481.3c0 17-13.8 30.7-30.7 30.7H30.7C13.8 512 0 498.2 0 481.3c0-71.9 47-132.7 111.9-153.6z"/></svg>
                        <b>Opción de Titulación:</b>&nbsp; <a href="" class="underline decoration-dotted ml-1">{{ $alumno->opcion_titulacion->opcion }}</a>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-span-12 xl:col-span-6">
            <div class="box intro-y p-5 mt-5">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium text-base truncate">Datos Personales</div>
                    <a class="w-4 h-4 text-slate-500 ml-auto" href="{{ route('edit-datos-personales',$alumno) }}"><i data-lucide="edit"></i></a>
                </div>                                
                @if($alumno->tramite->estado != 1) 
                    <div class="flex items-center mt-3">
                        <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="currentColor" d="M96 32V64H48C21.5 64 0 85.5 0 112v48H448V112c0-26.5-21.5-48-48-48H352V32c0-17.7-14.3-32-32-32s-32 14.3-32 32V64H160V32c0-17.7-14.3-32-32-32S96 14.3 96 32zM448 192H0V464c0 26.5 21.5 48 48 48H400c26.5 0 48-21.5 48-48V192z"/></svg>
                        <b>Fecha de Nacimiento:&nbsp;</b> {{ $alumno->fecha_nacimiento}}
                    </div>
                    <div class="flex items-center mt-3">
                        <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="currentColor" d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg>
                        <b>Lugar de Nacimieto:&nbsp;</b>{{ $alumno->municipio_nacimiento.", ".$alumno->estado_nacimiento }}
                    </div>
                    <div class="flex items-center mt-3">
                        <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="currentColor" d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/></svg>
                        <b>Estado Civil:&nbsp;</b>{{ $alumno->estado_civil }}
                    </div>
                    <div class="flex items-center mt-3">
                        <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="currentColor" d="M176 288a112 112 0 1 0 0-224 112 112 0 1 0 0 224zM352 176c0 86.3-62.1 158.1-144 173.1V384h32c17.7 0 32 14.3 32 32s-14.3 32-32 32H208v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V448H112c-17.7 0-32-14.3-32-32s14.3-32 32-32h32V349.1C62.1 334.1 0 262.3 0 176C0 78.8 78.8 0 176 0s176 78.8 176 176zM271.9 360.6c19.3-10.1 36.9-23.1 52.1-38.4c20 18.5 46.7 29.8 76.1 29.8c61.9 0 112-50.1 112-112s-50.1-112-112-112c-7.2 0-14.3 .7-21.1 2c-4.9-21.5-13-41.7-24-60.2C369.3 66 384.4 64 400 64c37 0 71.4 11.4 99.8 31l20.6-20.6L487 41c-6.9-6.9-8.9-17.2-5.2-26.2S494.3 0 504 0H616c13.3 0 24 10.7 24 24V136c0 9.7-5.8 18.5-14.8 22.2s-19.3 1.7-26.2-5.2l-33.4-33.4L545 140.2c19.5 28.4 31 62.7 31 99.8c0 97.2-78.8 176-176 176c-50.5 0-96-21.3-128.1-55.4z"/></svg>
                         <b>Género:&nbsp;</b>{{ $alumno->genero }}
                    </div>
                    <div class="flex items-center mt-3">
                        <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="currentColor" d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/></svg>
                        <b>Teléfono Celular:&nbsp;</b>{{ $alumno->telefono_ceular }}
                    </div>
                    <div class="flex items-center mt-3">
                        <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="currentColor" d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/></svg>
                        <b>Teléfono Particular:&nbsp;</b>{{ $alumno->telefono_particular }}
                    </div>
                    <div class="flex items-center mt-3">
                        <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="currentColor" d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>
                        <b>Correo Institucional:&nbsp;</b>{{ $alumno->correo_institucional }}
                    </div>
                    <div class="flex items-center mt-3">
                        <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="currentColor" d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>
                        <b>Correo Particular:&nbsp;</b>{{ $alumno->correo_part }}
                    </div>
                    <div class="flex mt-3">
                        <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="currentColor" d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg>
                        <b>Domicilio:&nbsp;</b>{{ $alumno->dom_calle." #".$alumno->dom_numero.", ".$alumno->dom_colonia.", ".$alumno->dom_CP.", ".$alumno->dom_municipio.", ".$alumno->dom_estado }}
                    </div>
                @endif
            </div>
        </div> 
        <div class="col-span-12 xl:col-span-3"></div>       
        <div class="col-span-12 xl:col-span-6">
            <div class="box intro-y p-5 mt-2">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium text-base truncate">Datos Laborales</div>
                    <a class="w-4 h-4 text-slate-500 ml-auto" href="{{ route('edit-datos-laborales',$alumno) }}"><i data-lucide="edit"></i></a>
                </div>                                
                @if($alumno->trabaja)
                    @if ($alumno->afin)                                            
                        <div class="flex items-center mt-3">
                            <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="currentColor" d="M48 0C21.5 0 0 21.5 0 48V464c0 26.5 21.5 48 48 48h96V432c0-26.5 21.5-48 48-48s48 21.5 48 48v80h96c26.5 0 48-21.5 48-48V48c0-26.5-21.5-48-48-48H48zM64 240c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V240zm112-16h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H176c-8.8 0-16-7.2-16-16V240c0-8.8 7.2-16 16-16zm80 16c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H272c-8.8 0-16-7.2-16-16V240zM80 96h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V112c0-8.8 7.2-16 16-16zm80 16c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H176c-8.8 0-16-7.2-16-16V112zM272 96h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H272c-8.8 0-16-7.2-16-16V112c0-8.8 7.2-16 16-16z"/></svg>
                            <b>Nombre de la Empresa:&nbsp;</b> {{ $alumno->nombre_empresa }}
                        </div>
                        <div class="flex items-center mt-3">
                            <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="currentColor" d="M184 48H328c4.4 0 8 3.6 8 8V96H176V56c0-4.4 3.6-8 8-8zm-56 8V96H64C28.7 96 0 124.7 0 160v96H192 320 512V160c0-35.3-28.7-64-64-64H384V56c0-30.9-25.1-56-56-56H184c-30.9 0-56 25.1-56 56zM512 288H320v32c0 17.7-14.3 32-32 32H224c-17.7 0-32-14.3-32-32V288H0V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V288z"/></svg>
                            <b>Puesto:&nbsp;</b>{{ $alumno->municipio_nacimiento.", ".$alumno->puesto }}
                        </div>
                        <div class="flex items-center mt-3">
                            <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="currentColor" d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V192c0-35.3-28.7-64-64-64H80c-8.8 0-16-7.2-16-16s7.2-16 16-16H448c17.7 0 32-14.3 32-32s-14.3-32-32-32H64zM416 272a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>
                            <b>Sueldo Mensual:&nbsp;</b>{{ $alumno->sueldo_mensual }}
                        </div>                    
                        <div class="flex items-center mt-3">
                            <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="currentColor" d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/></svg>
                            <b>Teléfono (empresa):&nbsp;</b>{{ $alumno->tel_empresa }}
                        </div>
                        @if (isset($alumno->empresa_calle))                                                    
                            <div class="flex mt-3">
                                <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="currentColor" d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg>
                                <b>Domicilio:&nbsp;</b>{{ $alumno->empresa_calle." #".$alumno->empresa_numero.", ".$alumno->empresa_colonia.", ".$alumno->empresa_CP.", ".$alumno->empresa_municipio.", ".$alumno->empresa_estado }}
                            </div>
                        @endif
                    @else
                        <div class="flex items-center mt-3">
                            <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="currentColor" d="M184 48H328c4.4 0 8 3.6 8 8V96H176V56c0-4.4 3.6-8 8-8zm-56 8V96H64C28.7 96 0 124.7 0 160v96H192 320 512V160c0-35.3-28.7-64-64-64H384V56c0-30.9-25.1-56-56-56H184c-30.9 0-56 25.1-56 56zM512 288H320v32c0 17.7-14.3 32-32 32H224c-17.7 0-32-14.3-32-32V288H0V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V288z"/></svg>
                            <b>Descripción del Trabajo:&nbsp;</b> {{ $alumno->descripcion }}
                        </div>
                    @endif 
                @else
                    <div class="flex items-center mt-3">
                        <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="currentColor" d="M184 48H328c4.4 0 8 3.6 8 8V96H176V56c0-4.4 3.6-8 8-8zm-56 8V96H64C28.7 96 0 124.7 0 160v96H192 320 512V160c0-35.3-28.7-64-64-64H384V56c0-30.9-25.1-56-56-56H184c-30.9 0-56 25.1-56 56zM512 288H320v32c0 17.7-14.3 32-32 32H224c-17.7 0-32-14.3-32-32V288H0V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V288z"/></svg>
                        <b>NO TRABAJA</b> 
                    </div>
                @endif
            </div>
        </div> 
        <!-- END: Product Detail Side Menu -->
        <!-- BEGIN: Product Detail Content -->
        <div class="col-span-12 2xl:col-span-9">
            <div class="box intro-y p-3">
                <ul class="nav nav-pills flex-col md:flex-row" role="tablist">
                    <li id="active-transactions-tab" class="nav-item flex-1" role="presentation">
                        <button
                            id="btnDocsEntregados"
                            class="nav-link w-full flex items-center justify-center !rounded-lg py-3 active"
                            data-tw-toggle="pill"
                            data-tw-target="#active-transactions"
                            type="button"
                            role="tab"
                            aria-controls="active-transactions"
                            aria-selected="true"
                        >
                            <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Documentos Entregados
                        </button>
                    </li>
                    <li id="transaction-history-tab" class="nav-item flex-1" role="presentation">
                        <button
                            id="btnDocsGenerados"
                            class="nav-link w-full flex items-center justify-center !rounded-lg py-3"
                            data-tw-toggle="pill"
                            data-tw-target="#transaction-history"
                            type="button"
                            role="tab"
                            aria-selected="false"
                        >
                            <i data-lucide="inbox" class="w-4 h-4 mr-2"></i> Documentos Generados
                        </button>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div id="active-transactions" class="tab-pane active" role="tabpanel" aria-labelledby="active-transactions-tab">
                    <div class="box p-5 intro-y mt-5">                       
                        <div class="overflow-auto lg:overflow-visible ">
                            <table id="docs-entregados" class="table table-striped mt-5">
                                <thead>
                                    <tr>
                                        <th class="whitespace-nowrap !py-5">Nombre</th>
                                        <th class="">Nombre Original</th>
                                        <th class="whitespace-nowrap">Fecha de Registro</th>
                                        <th class="whitespace-nowrap">Estado</th>
                                        <th class="whitespace-nowrap">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($documentos as $documento)
                                        @if ($documento->aprobado != 4)  
                                            <tr>                                                                                                                                           
                                                <td>
                                                    <div class="font-medium whitespace-nowrap">{{ $documento->nombre_documento }}</div>                                                   
                                                </td>
                                                <td>
                                                    <div class="">{{ $documento->nombre_original }}</div>                                                   
                                                </td>
                                                <td>
                                                    <div class="font-medium whitespace-nowrap">{{ $documento->created_at }}</div>                                                   
                                                </td>
                                                <td>
                                                    <div class="font-medium whitespace-nowrap text-center">
                                                        @if($documento->aprobado == 0)
                                                            <div class="px-3 py-1 alert-primary-soft border border-primary/10 rounded-full mr-2 mb-2">Entregado</div>                                                                                                                                                                       
                                                        @elseif ($documento->aprobado == 1 || $documento->aprobado == 5 || $documento->aprobado == 8)                                                    
                                                            <div class="px-3 py-1 alert-success-soft border border-primary/10 rounded-full mr-2 mb-2">Aprobado</div>                                                    
                                                        @elseif ($documento->aprobado == 2 || $documento->aprobado == 6 || $documento->aprobado == 9)
                                                            <div class="px-3 py-1 alert-danger-soft border border-primary/10 rounded-full mr-2 mb-2">No Aprobado</div>
                                                        @elseif ($documento->aprobado == 3)
                                                            <div class="px-3 py-1 alert-pending-soft border border-primary/10 rounded-full mr-2 mb-2">En revisión</div>
                                                        @endif
                                                    </div>
                                                </td>                                                 
                                                <td>
                                                    <div class="flex items-center">
                                                        <!--Boton de ver-->
                                                        <a class="flex items-center whitespace-nowrap justify-center tooltip" title="Ver" href="{{ route('ver-documento', $documento) }}">
                                                            <svg class="svg-inline--fa fa-venus-mars w-6 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="currentColor" d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg>                                                         
                                                        </a>
                                                        <!--Boton de descargar-->
                                                        <a class="flex items-center whitespace-nowrap justify-center tooltip" title="Descargar" href="{{ route('descargar-documento', $documento) }}">
                                                            <svg class="svg-inline--fa fa-venus-mars w-6 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="currentColor" d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg>
                                                        </a>
                                                        @cannot('biblioteca') 
                                                            @cannot('control-escolar')                                                        
                                                                <!--Boton de eliminar-->
                                                                <a class="flex items-center whitespace-nowrap justify-center tooltip" title="Eliminar" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-modal-preview2{{$documento->id}}">
                                                                    <svg class="svg-inline--fa fa-venus-mars w-6 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="rgb(var(--color-danger)" d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/></svg>                                                         
                                                                </a>
                                                            @endcan
                                                        @endcan
                                                        <!-- Documentos Entregados -->
                                                        @if($tramite->estado == 3 || $tramite->estado == 7 || $tramite->estado == 10)
                                                            @if($documento->aprobado != 1 && $documento->aprobado != 5 && $documento->aprobado != 8)
                                                                <!--Boton de aprobar-->
                                                                <a class="flex items-center whitespace-nowrap justify-center tooltip" title="Aprobar" href="{{ route('aprobar-documento', $documento) }}">
                                                                    <svg class="svg-inline--fa fa-venus-mars w-8 h-6 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="rgb(var(--color-success)" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>
                                                                </a>
                                                            @endif
                                                            @if($documento->aprobado == 3 || ($tramite->estado == 3 && $documento->aprobado == 1) || ($tramite->estado == 7 && $documento->aprobado == 5) || ($tramite->estado == 10 && $documento->aprobado == 8))                                                            
                                                                <!--Boton de desaprobar-->
                                                                <a class="flex items-center whitespace-nowrap justify-center tooltip" title="No Aprobar" href="javascript:;" data-tw-toggle="modal" data-tw-target="#desaprobar-documento{{$documento->id}}">
                                                                    <svg class="svg-inline--fa fa-venus-mars w-8 h-6 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="rgb(var(--color-danger)" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
                                                                </a>
                                                            @endif
                                                        @endif     
                                                        <!-- BEGIN: Modal Eliminar --> 
                                                        <div id="delete-modal-preview2{{$documento->id}}" class="modal" tabindex="-1" aria-hidden="true"> 
                                                            <div class="modal-dialog"> 
                                                                <div class="modal-content"> 
                                                                    <div class="modal-body p-0"> 
                                                                        <div class="p-5 text-center"> 
                                                                            <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i> 
                                                                        <div class="text-3xl mt-5">¿Estas @if ($alumno->genero == "Mujer") segura? @else seguro? @endif
                                                                    </div> 
                                                                    <div class="text-slate-500 mt-2">
                                                                        @if ($alumno->genero == "Mujer") ¿Segura @else ¿Seguro @endif que deseas eliminar el documento? <br>
                                                                    </div> 
                                                                </div> 
                                                                <div class="px-5 pb-8 text-center"> 
                                                                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancelar</button> 
                                                                    <a href="{{ route('eliminar-documento', $documento) }}" class="btn btn-danger w-24">Eliminar</a> 
                                                                </div> 
                                                            </div> 
                                                        </div> <!-- END: Modal Eliminar -->                                                  
                                                        <!-- BEGIN: Modal Desaprobar --> 
                                                        <div id="desaprobar-documento{{$documento->id}}" class="modal" tabindex="-1" aria-hidden="true"> 
                                                            <div class="modal-dialog"> 
                                                                <div class="modal-content"> 
                                                                    <!-- BEGIN: Modal Header --> 
                                                                    <div class="modal-header"> 
                                                                        <h2 class="font-medium text-base mr-auto">Documento "{{ $documento->nombre_documento }}" que no se aprobará</h2>                                                                        
                                                                        <div class="dropdown sm:hidden"> 
                                                                            <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown"> 
                                                                                <i data-lucide="more-horizontal" class="w-5 h-5 text-slate-500"></i> 
                                                                            </a> 
                                                                        </div> 
                                                                    </div> 
                                                                    <!-- END: Modal Header -->                                                                     
                                                                    <!-- BEGIN: Modal Body --> 
                                                                    <form method="POST" action="{{ route('desaprobar-documento', $documento) }}">
                                                                        @csrf
                                                                        @method('PATCH')
                                                                        <div class="modal-body grid grid-cols-12 gap-4 gap-y-3"> 
                                                                            <div class="col-span-12 sm:col-span-12"> 
                                                                                <label for="modal-form-1" class="form-label">Agregue un comentario / observación del documento no aprobado.</label> 
                                                                                <textarea id="comentario" name="comentario" class="form-control" name="comment" placeholder="Comentarios..."></textarea>                                                    
                                                                            </div>                     
                                                                        </div> 
                                                                        <!-- END: Modal Body -->                                                                         
                                                                        <!-- BEGIN: Modal Footer --> 
                                                                        <div class="modal-footer"> 
                                                                            <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancelar</button> 
                                                                            <button type="submit"  class="btn btn-primary w-20" >Confirmar</button> 
                                                                        </div> <!-- END: Modal Footer -->
                                                                    </form>
                                                                </div> 
                                                            </div>
                                                         <!-- END: Modal Content --> 
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            <table id="docs-generados" class="table table-striped mt-5" style="display:none;">
                                <thead>
                                    <tr>
                                        <th class="whitespace-nowrap !py-5">Nombre</th>
                                        <th class="whitespace-nowrap">Nombre Original</th>
                                        <th class="whitespace-nowrap">Fecha de Registro</th>
                                        <th class="whitespace-nowrap text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($documentos as $documento)
                                        @if ($documento->aprobado == 4)  
                                            <tr>                                                                                                                                           
                                                <td>
                                                    <div class="font-medium whitespace-nowrap">{{ $documento->nombre_documento }}</div>                                                   
                                                </td>
                                                <td>
                                                    <div class="font-medium whitespace-nowrap">{{ $documento->nombre_original }}</div>                                                   
                                                </td>
                                                <td>
                                                    <div class="font-medium whitespace-nowrap">{{ $documento->created_at }}</div>                                                   
                                                </td>                                                                                                 
                                                <td>
                                                    <div class="flex items-center">
                                                        <!--Boton de ver-->
                                                        <a class="flex items-center whitespace-nowrap justify-center tooltip" title="Ver" href="{{ route('ver-documento', $documento) }}">
                                                            <svg class="svg-inline--fa fa-venus-mars w-6 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="currentColor" d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg>                                                         
                                                        </a>
                                                        <!--Boton de descargar-->
                                                        <a class="flex items-center whitespace-nowrap justify-center tooltip" title="Descargar" href="{{ route('descargar-documento', $documento) }}">
                                                            <svg class="svg-inline--fa fa-venus-mars w-6 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="currentColor" d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg>
                                                        </a>
                                                        @cannot('biblioteca') 
                                                            @cannot('control-escolar')                                                        
                                                                <!--Boton de eliminar-->
                                                                <a class="flex items-center whitespace-nowrap justify-center tooltip" title="Eliminar" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-modal-preview{{$documento->id}}">
                                                                    <svg class="svg-inline--fa fa-venus-mars w-6 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="rgb(var(--color-danger)" d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/></svg>                                                         
                                                                </a>
                                                            @endcan
                                                        @endcan
                                                    </div>
                                                    <!-- BEGIN: Modal Eliminar --> 
                                                    <div id="delete-modal-preview{{$documento->id}}" class="modal" tabindex="-1" aria-hidden="true"> 
                                                        <div class="modal-dialog"> 
                                                            <div class="modal-content"> 
                                                                <div class="modal-body p-0"> 
                                                                    <div class="p-5 text-center"> 
                                                                        <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i> 
                                                                    <div class="text-3xl mt-5">¿Estas @if ($alumno->genero == "Mujer") segura? @else seguro? @endif
                                                                </div> 
                                                                <div class="text-slate-500 mt-2">
                                                                    @if ($alumno->genero == "Mujer") ¿Segura @else ¿Seguro @endif que deseas eliminar el documento? <br>
                                                                </div> 
                                                            </div> 
                                                            <div class="px-5 pb-8 text-center"> 
                                                                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancelar</button> 
                                                                <a href="{{ route('admin-eliminar-documento', $documento) }}" class="btn btn-danger w-24">Eliminar</a> 
                                                            </div> 
                                                        </div> 
                                                    </div> <!-- END: Modal Eliminar -->
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- BEGIN: Pagination -->
                    <div class="intro-y flex flex-wrap sm:flex-row sm:flex-nowrap items-center mt-5 mb-16">
                        <nav class="w-full sm:w-auto sm:mr-auto">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        <i class="w-4 h-4" data-lucide="chevrons-left"></i>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        <i class="w-4 h-4" data-lucide="chevron-left"></i>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">...</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">...</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        <i class="w-4 h-4" data-lucide="chevron-right"></i>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        <i class="w-4 h-4" data-lucide="chevrons-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <select class="w-20 form-select box mt-3 sm:mt-0">
                            <option>10</option>
                            <option>25</option>
                            <option>35</option>
                            <option>50</option>
                        </select>
                    </div>
                    <!-- END: Pagination -->
                </div>
            </div>
        </div>
        <!-- END: Product Detail Content -->  
        <!-- BEGIN: Modal Content --> 
        <div id="modal-dictamen" class="modal" tabindex="-1" aria-hidden="true"> 
            <div class="modal-dialog"> 
                <div class="modal-content"> 
                    <!-- BEGIN: Modal Header --> 
                    <div class="modal-header"> 
                        <h2 class="font-medium text-base mr-auto">Datos para Dictamen</h2>                        
                    </div> <!-- END: Modal Header --> 
                    <form method="POST" action="{{route('generar-dictamen',$tramite)}}">
                        @csrf
                        <!-- BEGIN: Modal Body --> 
                        <div class="modal-body grid grid-cols-12 gap-4 gap-y-3"> 
                            <div class="col-span-12 sm:col-span-12"> 
                                <label for="nombre" class="form-label">Nombre Completo:</label> 
                                <input id="nombre" type="text" class="form-control" value="{{$alumno->user->name}}" disabled> 
                            </div> 
                            <div class="col-span-12 sm:col-span-4"> 
                                <label for="codigo" class="form-label">Código:</label> 
                                <input id="codigo" type="text" class="form-control" value="{{$alumno->user->codigo}}" disabled> 
                            </div> 
                            <div class="col-span-12 sm:col-span-4"> 
                                <label for="numero_de_consecutivo" class="form-label">N° de Consecutivo:</label> 
                                <input id="numero_de_consecutivo" name="numero_de_consecutivo" type="text" class="form-control" 
                                @if(isset($alumno))
                                    value="{{$alumno->numero_de_consecutivo}}"
                                @else
                                    value="{{old('numero_de_consecutivo')}}"
                                @endif> 
                            </div> 
                            <div class="col-span-12 sm:col-span-4"> 
                                <label for="anio_graduacion" class="form-label">Año de Graduación:</label> 
                                <input id="anio_graduacion" name="anio_graduacion" type="text" class="form-control" 
                                @if(isset($alumno))
                                    value="{{$alumno->anio_graduacion}}"
                                @else
                                    value="{{old('anio_graduacion')}}"
                                @endif> 
                            </div> 
                            <div class="col-span-12 sm:col-span-12"> 
                                <label for="presidente">Presidente:</label>
                                <select id="presidente" name="presidente" data-placeholder="Selecciona el presidente" class="tom-select w-full">
                                    <option value="0">Seleccione una opción</option>
                                    @foreach($maestros as $presidente)
                                        <option value="{{$presidente->id}}" @if(isset($alumno) && $alumno->id_maestro_presidente == $presidente->id) selected @endif>{{$presidente->nombre}}</option>
                                    @endforeach
                                </select> 
                            </div> 
                            <div class="col-span-12 sm:col-span-12"> 
                                <label for="secretario">Secretario:</label>
                                <select id="secretario" name="secretario" data-placeholder="Selecciona el secretario" class="tom-select w-full">
                                    <option value="0">Seleccione una opción</option>
                                    @foreach($maestros as $secretario)
                                        <option value="{{$secretario->id}}" @if(isset($alumno) && $alumno->id_maestro_secretario == $secretario->id) selected @endif>{{$secretario->nombre}}</option>
                                    @endforeach
                                </select> 
                            </div> 
                            <div class="col-span-12 sm:col-span-12"> 
                                <label for="vocal">Vocal:</label>
                                <select id="vocal" name="vocal" data-placeholder="Selecciona el vocal" class="tom-select w-full">
                                    <option value="0">Seleccione una opción</option>
                                    @foreach($maestros as $vocal)
                                        <option value="{{$vocal->id}}" @if(isset($alumno) && $alumno->id_maestro_vocal == $vocal->id) selected @endif>{{$vocal->nombre}}</option>
                                    @endforeach
                                </select> 
                            </div> 
                        </div> <!-- END: Modal Body --> 
                        <!-- BEGIN: Modal Footer --> 
                        <div class="modal-footer"> 
                            <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancelar</button> 
                            <button type="submit" class="btn btn-primary w-20">Generar</button> 
                        </div> <!-- END: Modal Footer --> 
                    </form>
                </div> 
            </div> 
        </div> <!-- END: Modal Content --> 
    </div>
    <script>
        document.getElementById("btnDocsEntregados").addEventListener("click", function () {
            document.getElementById("docs-entregados").style.display = "table";
            document.getElementById("docs-generados").style.display = "none";
        });
        
        document.getElementById("btnDocsGenerados").addEventListener("click", function () {
            document.getElementById("docs-entregados").style.display = "none";
            document.getElementById("docs-generados").style.display = "table";
        });
    </script>
    
@endsection
