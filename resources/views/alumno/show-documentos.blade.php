@extends('../layout/' . $layout)

@section('subhead')
    <title>Mis Documentos - Titulación CUCEI</title>
@endsection

@section('subcontent')      
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="flex items-center text-lg font-medium mr-auto">
            DOCUMENTACIÓN
        </h2>
        <!--<div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button class="btn btn-primary shadow-md mr-2">
                <i class="w-4 h-4 mr-2" data-lucide="file-text"></i> View Full Report
            </button>
        </div>-->
    </div>
    @if ($alumnoDocs->solicitud_constancia_no_adeudo_universidad && !$alumnoDocs->constancia_no_adeudo_universidad)
        <div class="alert alert-primary-soft show flex items-center mb-2 mt-5" role="alert"> 
            <i data-lucide="alert-circle" class="w-6 h-6 mr-2"></i> 
            Carta de No Adeudo&nbsp;<b>Solicitada</b>&nbsp;a la Universidad, cuando este lista estará disponible en este apartado.
        </div> 
    @endif
    @if ($alumnoDocs->solicitud_constancia_no_adeudo_biblioteca && !$alumnoDocs->constancia_no_adeudo_biblioteca)
        <div class="alert alert-primary-soft show flex items-center mb-2 mt-5" role="alert"> 
            <i data-lucide="alert-circle" class="w-6 h-6 mr-2"></i> 
            Carta de No Adeudo&nbsp;<b>Solicitada</b>&nbsp;a Biblioteca, cuando este lista estará disponible en este apartado.
        </div> 
    @endif
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
    <div class="grid grid-cols-12 gap-5">    
        <!-- Estado < 2da Etapa -->    
        @if($tramite->estado < 6 && $tramite->estado != 1)
            <!-- BEGIN: Lista Documentos -->
            <div class="col-span-12 xl:col-span-12">
                <div class="box intro-y p-5 mt-5">
                    <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                        <div class="font-medium text-base truncate">Documentos para iniciar el trámite de titulación</div>
                    </div>
                    <h5><b>MODALIDAD:&nbsp; </b>
                        {{ $alumno->opcion_titulacion->opcion }}             
                    </h5><br>  
                    <!-- Formato A -->             
                    <div class="form-inline">                                         
                        <input id="checkbox-switch-1" class="form-check-input" type="checkbox" 
                        @if ($alumnoDocs->formato_a) checked  @endif > 
                        <label class="form-label sm:w-40">(Obligatorio)</label><label class="form-label sm:w-20"></label>
                        <label class="form-label sm:w-60">Formato A. (descargarlo y firmarlo)</label>                     
                        <a class="btn btn-secondary" href="{{ route('descargar-formato01') }}">Descargar Formato A</a>                                                                    
                    </div>        
                    <!-- Kardex -->        
                    <div class="form-inline mt-5">                                         
                        <input id="checkbox-switch-1" class="form-check-input" type="checkbox" 
                        @if ($alumnoDocs->kardex) checked  @endif > 
                        <label class="form-label sm:w-40">(Obligatorio)</label><label class="form-label sm:w-20"></label>
                        <label class="form-label sm:w-60">Kárdex de Estudiante</label>                                                                 
                    </div>   
                    <!-- Certificado de Ingles -->
                    <div class="form-inline mt-5">                                         
                        <input id="checkbox-switch-1" class="form-check-input" type="checkbox" 
                        @if ($alumnoDocs->certificado) checked  @endif > 
                        <label class="form-label sm:w-40">(Obligatorio)</label><label class="form-label sm:w-20"></label>
                        <label class="form-label sm:w-60">Certificado de Inglés</label>                                                                                       
                    </div>   
                    <!-- Prorroga --> 
                    <div class="form-inline mt-5">                                         
                        <input id="checkbox-switch-1" class="form-check-input" type="checkbox" 
                        @if ($alumnoDocs->carta) checked  @endif > 
                        <label class="form-label sm:w-40">(Opcional)</label><label class="form-label sm:w-20"></label>
                        <label class="form-label sm:w-60">Solicitud de Prórroga</label>                                                                                        
                    </div>   
                    <!-- EXAMEN GLOBAL TEORICO PRACTICO / EXAMEN GLOBAL TEORICO -->
                    @if ($id_opcion_titulacion == 3 || $id_opcion_titulacion == 4)
                        <!-- Carta -->
                        <div class="form-inline mt-5">                                         
                            <input id="checkbox-switch-1" class="form-check-input" type="checkbox" 
                            @if ($alumnoDocs->carta) checked  @endif > 
                            <label class="form-label sm:w-40">(Obligatorio)</label><label class="form-label sm:w-20"></label>
                            <label class="form-label sm:w-60">Carta dirigida al Comité de Titulación</label>                                                                                       
                        </div>
                    <!-- CENEVAL -->    
                    @elseif ($id_opcion_titulacion == 5)
                        <!-- Testimonio de Desempeño -->
                        <div class="form-inline mt-5">                                         
                            <input id="checkbox-switch-1" class="form-check-input" type="checkbox" 
                            @if ($alumnoDocs->testimonio_desempeno) checked  @endif > 
                            <label class="form-label sm:w-40">(Obligatorio)</label><label class="form-label sm:w-20"></label>
                            <label class="form-label sm:w-60">Testimonio de Desempeño</label>                                                                                       
                        </div>
                        <!-- Reporte Individual de Resultados -->
                        <div class="form-inline mt-5">                                         
                            <input id="checkbox-switch-1" class="form-check-input" type="checkbox" 
                            @if ($alumnoDocs->reporte_individual_resultados) checked  @endif > 
                            <label class="form-label sm:w-40">(Obligatorio)</label><label class="form-label sm:w-20"></label>
                            <label class="form-label sm:w-60">Reporte Individual de Resultados</label>                                                                                       
                        </div>
                    <!-- Examen de Capacitación -->
                    @elseif ($id_opcion_titulacion == 6)
                        <!-- Formato C -->
                        <div class="form-inline mt-5">                                         
                            <input id="checkbox-switch-1" class="form-check-input" type="checkbox" 
                            @if ($alumnoDocs->formato_c) checked  @endif > 
                            <label class="form-label sm:w-40">(Obligatorio)</label><label class="form-label sm:w-20"></label>
                            <label class="form-label sm:w-60">Formato C</label>                                                                                       
                        </div>
                        <!-- Certificados / Constancias -->
                        <div class="form-inline mt-5">                                         
                            <input id="checkbox-switch-1" class="form-check-input" type="checkbox" 
                            @if ($alumnoDocs->certificado_constancias) checked  @endif > 
                            <label class="form-label sm:w-40">(Obligatorio)</label><label class="form-label sm:w-20"></label>
                            <label class="form-label sm:w-60">Certificados / Constancias</label>                                                                                       
                        </div>
                    <!-- Guias Comentadas o ilustradas -->                                                                           
                    @elseif ($id_opcion_titulacion == 7 || $id_opcion_titulacion == 8)
                        <!-- Formato D -->
                        <div class="form-inline mt-5">                                         
                            <input id="checkbox-switch-1" class="form-check-input" type="checkbox" 
                            @if ($alumnoDocs->formato_d) checked  @endif > 
                            <label class="form-label sm:w-40">(Obligatorio)</label><label class="form-label sm:w-20"></label>
                            <label class="form-label sm:w-60">Formato D</label>                                                                                       
                        </div>
                        <!-- Certificados / Constancias -->
                        <div class="form-inline mt-5">                                         
                            <input id="checkbox-switch-1" class="form-check-input" type="checkbox" 
                            @if ($alumnoDocs->protocolo) checked  @endif > 
                            <label class="form-label sm:w-40">(Obligatorio)</label><label class="form-label sm:w-20"></label>
                            <label class="form-label sm:w-60">Protocolo</label>                                                                                       
                        </div>
                        <!-- Contenido de la asignatura -->
                        <div class="form-inline mt-5">                                         
                            <input id="checkbox-switch-1" class="form-check-input" type="checkbox" 
                            @if ($alumnoDocs->contenido_asignatura) checked  @endif > 
                            <label class="form-label sm:w-40">(Obligatorio)</label><label class="form-label sm:w-20"></label>
                            <label class="form-label sm:w-60">Contenido de la asignatura</label>                                                                                       
                        </div>
                    <!-- Cursos o créditos de maestría o doctorado --> 
                    @elseif ($id_opcion_titulacion == 9)
                        <!-- Constancia de Calificaciones -->
                        <div class="form-inline mt-5">                                         
                            <input id="checkbox-switch-1" class="form-check-input" type="checkbox" 
                            @if ($alumnoDocs->constancia_calificaciones) checked  @endif > 
                            <label class="form-label sm:w-40">(Obligatorio)</label><label class="form-label sm:w-20"></label>
                            <label class="form-label sm:w-60">Constancia de Calificaciones</label>                                                                                       
                        </div>
                        <!-- Folleto -->
                        <div class="form-inline mt-5">                                         
                            <input id="checkbox-switch-1" class="form-check-input" type="checkbox" 
                            @if ($alumnoDocs->folleto) checked  @endif > 
                            <label class="form-label sm:w-40">(Obligatorio)</label><label class="form-label sm:w-20"></label>
                            <label class="form-label sm:w-60">Folleto</label>                                                                                       
                        </div>
                    <!-- Seminario de Investigación --> 
                    @elseif ($id_opcion_titulacion == 11) 
                        <!-- Evidencia del ISSN o ISBN -->
                        <div class="form-inline mt-5">                                         
                            <input id="checkbox-switch-1" class="form-check-input" type="checkbox" 
                            @if ($alumnoDocs->evidencia) checked  @endif > 
                            <label class="form-label sm:w-40">(Obligatorio)</label><label class="form-label sm:w-20"></label>
                            <label class="form-label sm:w-60">Evidencia del ISSN o ISBN</label>                                                                                       
                        </div>
                        <!-- Declaratoria -->
                        <div class="form-inline mt-5">                                         
                            <input id="checkbox-switch-1" class="form-check-input" type="checkbox" 
                            @if ($alumnoDocs->declaratoria) checked  @endif > 
                            <label class="form-label sm:w-40">(Obligatorio)</label><label class="form-label sm:w-20"></label>
                            <label class="form-label sm:w-60">Declaratoria</label>                                                                                       
                        </div>
                        <!-- Publicación -->
                        <div class="form-inline mt-5">                                         
                            <input id="checkbox-switch-1" class="form-check-input" type="checkbox" 
                            @if ($alumnoDocs->publicacion) checked  @endif > 
                            <label class="form-label sm:w-40">(Obligatorio)</label><label class="form-label sm:w-20"></label>
                            <label class="form-label sm:w-60">Publicación</label>                                                                                       
                        </div>
                    <!-- Seminario de Titulación --> 
                    @elseif ($id_opcion_titulacion == 12)
                        <!-- Evidencia -->
                        <div class="form-inline mt-5">                                         
                            <input id="checkbox-switch-1" class="form-check-input" type="checkbox" 
                            @if ($alumnoDocs->evidencia) checked  @endif > 
                            <label class="form-label sm:w-40">(Obligatorio)</label><label class="form-label sm:w-20"></label>
                            <label class="form-label sm:w-60">Evidencia</label>                                                                                       
                        </div>
                        <!-- Reporte Escrito -->
                        <div class="form-inline mt-5">                                         
                            <input id="checkbox-switch-1" class="form-check-input" type="checkbox" 
                            @if ($alumnoDocs->reporte_escrito) checked  @endif > 
                            <label class="form-label sm:w-40">(Obligatorio)</label><label class="form-label sm:w-20"></label>
                            <label class="form-label sm:w-60">Reporte Escrito</label>                                                                                       
                        </div>
                        <!-- Reseña del Trabajo -->
                        <div class="form-inline mt-5">                                         
                            <input id="checkbox-switch-1" class="form-check-input" type="checkbox" 
                            @if ($alumnoDocs->resena_trabajo) checked  @endif > 
                            <label class="form-label sm:w-40">(Obligatorio)</label><label class="form-label sm:w-20"></label>
                            <label class="form-label sm:w-60">Reseña del Trabajo</label>                                                                                       
                        </div>
                        <!-- Curriculum vitae Académico -->
                        <div class="form-inline mt-5">                                         
                            <input id="checkbox-switch-1" class="form-check-input" type="checkbox" 
                            @if ($alumnoDocs->curriculum_academico) checked  @endif > 
                            <label class="form-label sm:w-40">(Obligatorio)</label><label class="form-label sm:w-20"></label>
                            <label class="form-label sm:w-60">Curriculum vitae Académico</label>                                                                                       
                        </div>
                    <!--Diseño o rediseño / Tesis / Informe de practicas -->  
                    @elseif ($id_opcion_titulacion == 13 || $id_opcion_titulacion == 14 || $id_opcion_titulacion == 16)  
                        <!-- Protocolo -->
                        <div class="form-inline mt-5">                                         
                            <input id="checkbox-switch-1" class="form-check-input" type="checkbox" 
                            @if ($alumnoDocs->protocolo) checked  @endif > 
                            <label class="form-label sm:w-40">(Obligatorio)</label><label class="form-label sm:w-20"></label>
                            <label class="form-label sm:w-60">Protocolo</label>                                                                                       
                        </div>
                        <!-- Constancia de ganador por proyecto modular -->
                        @if ($id_opcion_titulacion == 13 && $tramite->alumno->ganador_proyecto_modular)
                            <div class="form-inline mt-5">                                         
                                <input id="checkbox-switch-1" class="form-check-input" type="checkbox" 
                                @if ($alumnoDocs->constancia_ganador_pm) checked  @endif > 
                                <label class="form-label sm:w-40">(Obligatorio)</label><label class="form-label sm:w-20"></label>
                                <label class="form-label sm:w-60">Constancia de ganador por proyecto modular</label>                                                                                       
                            </div>
                        @endif                       
                    @endif
                </div>
            </div>
            <!-- END: Lista Documentos --> 
        @endif 
        <!-- Estado - 2da Etapa -->
        @if($tramite->estado >= 6 && $tramite->estado < 8 or $tramite->estado == 9)  
            @if($id_opcion_titulacion == 5 or $id_opcion_titulacion == 7 or $id_opcion_titulacion == 11 or  $id_opcion_titulacion == 12 or  $id_opcion_titulacion == 13 or $id_opcion_titulacion == 14 or $id_opcion_titulacion == 16)        
                <!-- BEGIN: Lista Documentos -->
                <div class="col-span-12 xl:col-span-12">
                    <div class="box intro-y p-5 mt-5">
                        <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                            <div class="font-medium text-base truncate">Documentos para continuar el trámite de titulación</div>
                        </div>
                        <h5><b>MODALIDAD:&nbsp; </b>
                            {{ $alumno->opcion_titulacion->opcion }}             
                        </h5><br>  
                        @if ($id_opcion_titulacion != 5)
                            <!-- Autorizacion de Impresion -->             
                            <div class="form-inline">                                         
                                <input id="checkbox-switch-1" class="form-check-input" type="checkbox" 
                                @if ($alumnoDocs->autorizacion_impresion) checked  @endif > 
                                <label class="form-label sm:w-40">(Obligatorio)</label><label class="form-label sm:w-20"></label>
                                <label class="form-label sm:w-60">Autorización de Impresión</label>                                                                    
                            </div>  
                            @if ($id_opcion_titulacion != 12) 
                                <!-- Autorizacion de Impresion -->             
                                <div class="form-inline mt-5">                                         
                                    <input id="checkbox-switch-1" class="form-check-input" type="checkbox" 
                                    @if ($alumnoDocs->documento_trabajo) checked  @endif > 
                                    <label class="form-label sm:w-40">(Obligatorio)</label><label class="form-label sm:w-20"></label>
                                    <label class="form-label sm:w-60">Documento Final del Trabajo</label>                                                                    
                                </div>  
                            @endif
                        @else
                            <!-- Certificados Ceneval -->     
                            <div class="form-inline mt-5">                                         
                                <input id="checkbox-switch-1" class="form-check-input" type="checkbox" 
                                @if ($alumnoDocs->certificados_ceneval) checked @endif > 
                                <label class="form-label sm:w-40">(Obligatorio)</label><label class="form-label sm:w-20"></label>
                                <label class="form-label sm:w-60">Certificados CENEVAL</label>                                                                 
                            </div>   
                        @endif                   
                    </div>
                </div><!-- END: Lista Documentos --> 
            @endif
        @endif
        <!-- Estado - 3ra Etapa -->
        @if($tramite->estado == 8)  
            <!-- BEGIN: Lista Documentos -->
            <div class="col-span-12 xl:col-span-12">
                <div class="box intro-y p-5 mt-5">
                    <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                        <div class="font-medium text-base truncate">Documentos obligatorios que deberá presentar en el área de pasantes</div>
                    </div>
                    <h5><b>MODALIDAD:&nbsp; </b>
                        {{ $alumno->opcion_titulacion->opcion }}             
                    </h5><br>  
                    <!-- Comprobante de Pago de Arancel de la Ceremonia de Titulación -->             
                    <div class="form-inline">                                         
                        <input id="checkbox-switch-1" class="form-check-input" type="checkbox" 
                        @if ($alumnoDocs->pago_arancel) checked  @endif > 
                        <label class="form-label sm:w-40">(Obligatorio)</label><label class="form-label sm:w-20"></label>
                        <label class="form-label sm:w-60 text-justify">Comprobante de Pago de Arancel de la Ceremonia de Titulación</label>                                                                    
                    </div>                                         
                    <!-- Constancia de No Adeudo a la Universidad -->     
                    <div class="form-inline mt-5">                                         
                        <input id="checkbox-switch-1" class="form-check-input" type="checkbox" 
                        @if ($alumnoDocs->constancia_no_adeudo_universidad) checked  @endif > 
                        <label class="form-label sm:w-40">(Obligatorio)</label><label class="form-label sm:w-20"></label>
                        <label class="form-label sm:w-60">Constancia de No Adeudo a la Universidad</label>
                        @if ($alumnoDocs->solicitud_constancia_no_adeudo_universidad && !$alumnoDocs->constancia_no_adeudo_universidad)                                                
                            <b>SOLICITADA</b>
                        @elseif (!$alumnoDocs->constancia_no_adeudo_universidad)                                           
                            <a class="btn btn-secondary" href="{{ route('solicitar_cna_universidad', $alumnoDocs) }}">Solicitar</a>                                                                    
                        @endif
                    </div>    
                    <!-- Constancia de No Adeudo a la Biblioteca -->     
                    <div class="form-inline mt-5">                                         
                        <input id="checkbox-switch-1" class="form-check-input" type="checkbox" 
                        @if ($alumnoDocs->constancia_no_adeudo_biblioteca) checked  @endif > 
                        <label class="form-label sm:w-40">(Obligatorio)</label><label class="form-label sm:w-20"></label>
                        <label class="form-label sm:w-60">Constancia de No Adeudo a la Biblioteca</label>          
                        @if ($alumnoDocs->solicitud_constancia_no_adeudo_biblioteca && !$alumnoDocs->constancia_no_adeudo_biblioteca)                                                
                            <b>SOLICITADA</b>
                        @elseif (!$alumnoDocs->constancia_no_adeudo_biblioteca)                                  
                            <a class="btn btn-secondary" href="{{ route('solicitar_cna_biblioteca', $alumnoDocs) }}">Solicitar</a>                                                                    
                        @endif
                    </div>       
                    @if($id_opcion_titulacion == 7 or $id_opcion_titulacion == 11 or  $id_opcion_titulacion == 12 or  $id_opcion_titulacion == 13 or $id_opcion_titulacion == 14 or $id_opcion_titulacion == 16)                    
                        <!-- Autorización para Publicación -->     
                        <div class="form-inline mt-5">                                         
                            <input id="checkbox-switch-1" class="form-check-input" type="checkbox" 
                            @if ($alumnoDocs->autorizacion_publicacion) checked  @endif > 
                            <label class="form-label sm:w-40">(Obligatorio)</label><label class="form-label sm:w-20"></label>
                            <label class="form-label sm:w-60">Autorización para Publicación</label>                                           
                            <a class="btn btn-secondary" href="">Generar Autorización</a>                                                                    
                        </div>    
                    @endif                          
                </div>
            </div><!-- END: Lista Documentos --> 
            
        @endif
        <!-- BEGIN: Subir Documentos --> <!-- Estado < Datos Titulacion -->
        @if($tramite->estado != 3 && $tramite->estado != 4 && $tramite->estado != 7) 
            <div class="col-span-12 xl:col-span-12">
                <div class="box intro-y p-5 mt-5">
                    <form class="form" method="POST" action="{{ route('upload-documento') }}" enctype="multipart/form-data">
                        @csrf                           
                        <div class="form-inline">                                                   
                            <div class="mx-2 w-96">
                                <label>Nombre del archivo requerido:</label>  
                                <!-- Estado - 2da Etapa -->
                                @if($tramite->estado >= 6 && $tramite->estado < 10 && $tramite->estado != 8)
                                    <select class="form-control tom-select" name="nombre">                                                                                                                                            
                                        <option value="0" selected>Seleccione el nombre del archivo...</option>                                                                                                                                                                                                                                                                                                                 
                                        @if ($alumnoDocs->alumno->id_opcion_titulacion == 3 || $alumnoDocs->alumno->id_opcion_titulacion == 4)
                                            <!-- Examen Global Teorico Practico / Examen Global Teorico --> 
                                            @if ($alumnoDocs->carta == "0") 
                                                <option value="Carta dirigida al Comité de Titulación">Carta dirigida al Comité de Titulación</option>
                                            @endif
                                        @elseif ($alumnoDocs->alumno->id_opcion_titulacion == 5)
                                            <!-- CENEVAL --> 
                                            @if (!$alumnoDocs->testimonio_desempeno) 
                                                <option value="Testimonio de Desempeño">Testimonio de Desempeño</option>
                                            @endif
                                            @if (!$alumnoDocs->reporte_individual_resultados) 
                                                <option value="Reporte Individual de Resultados">Reporte Individual de Resultados</option>
                                            @endif  
                                            @if (!$alumnoDocs->certificados_ceneval) 
                                                <option value="Certificados CENEVAL">Certificados CENEVAL</option>
                                            @endif                   
                                        @elseif ($alumnoDocs->alumno->id_opcion_titulacion == 6)  
                                            <!-- Examen de Capacitación profesional --> 
                                            @if ($alumnoDocs->formato_c == "0") 
                                                <option value="Formato C">Formato C</option> 
                                            @endif  
                                            @if ($alumnoDocs->certificado_constancias == "0") 
                                                <option value="Certificados / Constancias">Certificados / Constancias</option> 
                                            @endif                                                                                                                                                                    
                                        @elseif ($alumnoDocs->alumno->id_opcion_titulacion == 7 || $alumnoDocs->alumno->id_opcion_titulacion == 8)  
                                            <!-- Guias Comentadas o ilustradas --> 
                                            @if ($alumnoDocs->formato_d == "0") 
                                                <option value="Formato D">Formato D</option> 
                                            @endif  
                                            @if ($alumnoDocs->protocolo == "0") 
                                                <option value="Protocolo">Protocolo</option> 
                                            @endif 
                                            @if ($alumnoDocs->contenido_asignatura == "0") 
                                                <option value="Contenido de la asignatura">Contenido de la asignatura</option>
                                            @endif 
                                        @elseif ($alumnoDocs->alumno->id_opcion_titulacion == 9)  
                                            <!-- Cursos o créditos de maestría o doctorado --> 
                                            @if (!$alumnoDocs->constancia_calificaciones) 
                                                <option value="Constancia de Calificaciones">Constancia de Calificaciones</option> 
                                            @endif  
                                            @if (!$alumnoDocs->folleto) 
                                                <option value="Folleto">Folleto</option> 
                                            @endif 
                                        @elseif ($alumnoDocs->alumno->id_opcion_titulacion == 11)  
                                            <!-- Seminario de Investigación --> 
                                            @if (!$alumnoDocs->evidencia) 
                                                <option value="Evidencia del ISSN o ISBN">Evidencia del ISSN o ISBN</option> 
                                            @endif  
                                            @if (!$alumnoDocs->declaratoria) 
                                                <option value="Declaratoria">Declaratoria</option> 
                                            @endif 
                                            @if (!$alumnoDocs->publicacion) 
                                                <option value="Publicación">Publicación</option> 
                                            @endif                                                      
                                        @elseif ($tramite->alumno->id_opcion_titulacion == 7 || $tramite->alumno->id_opcion_titulacion == 8 || $tramite->alumno->id_opcion_titulacion == 12 || $tramite->alumno->id_opcion_titulacion == 13 || $tramite->alumno->id_opcion_titulacion == 14 || $tramite->alumno->id_opcion_titulacion == 16)  
                                            <!-- Guías comentadas / Paquete Didactico / Diseño o rediseño / Tesis / Informe de practicas -->   
                                            @if (!$alumnoDocs->documento_trabajo && $tramite->alumno->id_opcion_titulacion != 12) 
                                                <option value="Documento Trabajo">Documento Trabajo</option>  
                                            @endif  
                                            @if (!$alumnoDocs->autorizacion_impresion) 
                                                <option value="Autorización Impresión">Autorización Impresión</option> 
                                            @endif                                                                                                                                                                                                                  
                                        @endif  
                                    </select>  
                                @elseif ($tramite->estado == 8)
                                    <select class="form-control" name="nombre">                                                                                                                                            
                                        <option value="0" selected>Seleccione el nombre del archivo...</option>  
                                        @if (!$alumnoDocs->pago_arancel) 
                                            <option value="Pago de Arancel">Pago de Arancel</option> 
                                        @endif 
                                    </select>
                                @else
                                    <select class="form-control" name="nombre">                                                                                                                                            
                                        <option value="0" selected>Seleccione el nombre del archivo...</option>
                                        @if (!$alumnoDocs->formato_a)
                                            <option value="Formato A">Formato A</option>  
                                        @endif
                                        @if (!$alumnoDocs->kardex) 
                                            <option value="Kárdex de Estudiante">Kárdex de Estudiante</option>
                                        @endif
                                        @if (!$alumnoDocs->certificado) 
                                            <option value="Certificado de Inglés">Certificado de Inglés</option>>
                                        @endif
                                        @if (!$alumnoDocs->prorroga) 
                                            <option value="Solicitud de Prórroga">Solicitud de Prórroga (Opcional)</option>
                                        @endif                                                                                                                                                                                                                                                                    
                                        @if ($alumnoDocs->alumno->id_opcion_titulacion == 3 || $alumnoDocs->alumno->id_opcion_titulacion == 4)
                                            <!-- Examen Global Teorico Practico / Examen Global Teorico --> 
                                            @if (!$alumnoDocs->carta) 
                                                <option value="Carta dirigida al Comité de Titulación">Carta dirigida al Comité de Titulación</option>
                                            @endif
                                        @elseif ($alumnoDocs->alumno->id_opcion_titulacion == 5)
                                            <!-- CENEVAL --> 
                                            @if (!$alumnoDocs->testimonio_desempeno) 
                                                <option value="Testimonio de Desempeño">Testimonio de Desempeño</option>
                                            @endif
                                            @if (!$alumnoDocs->reporte_individual_resultados) 
                                                <option value="Reporte Individual de Resultados">Reporte Individual de Resultados</option>
                                            @endif                     
                                        @elseif ($alumnoDocs->alumno->id_opcion_titulacion == 6)  
                                            <!-- Examen de Capacitación profesional --> 
                                            @if (!$alumnoDocs->formato_c) 
                                                <option value="Formato C">Formato C</option> 
                                            @endif  
                                            @if (!$alumnoDocs->certificado_constancias) 
                                                <option value="Certificados / Constancias">Certificados / Constancias</option> 
                                            @endif                                                                                                                                                                    
                                        @elseif ($alumnoDocs->alumno->id_opcion_titulacion == 7 || $alumnoDocs->alumno->id_opcion_titulacion == 8)  
                                            <!-- Guias Comentadas o ilustradas --> 
                                            @if ($alumnoDocs->formato_d == "0") 
                                                <option value="Formato D">Formato D</option> 
                                            @endif  
                                            @if ($alumnoDocs->protocolo == "0") 
                                                <option value="Protocolo">Protocolo</option> 
                                            @endif 
                                            @if ($alumnoDocs->contenido_asignatura == "0") 
                                                <option value="Contenido de la asignatura">Contenido de la asignatura</option>
                                            @endif 
                                        @elseif ($alumnoDocs->alumno->id_opcion_titulacion == 9)  
                                            <!-- Cursos o créditos de maestría o doctorado --> 
                                            @if ($alumnoDocs->constancia_calificaciones == "0") 
                                                <option value="Constancia de Calificaciones">Constancia de Calificaciones</option> 
                                            @endif  
                                            @if ($alumnoDocs->folleto == "0") 
                                                <option value="Folleto">Folleto</option> 
                                            @endif 
                                        @elseif ($alumnoDocs->alumno->id_opcion_titulacion == 11)  
                                            <!-- Seminario de Investigación --> 
                                            @if ($alumnoDocs->evidencia == "0") 
                                                <option value="Evidencia del ISSN o ISBN">Evidencia del ISSN o ISBN</option> 
                                            @endif  
                                            @if ($alumnoDocs->declaratoria == "0") 
                                                <option value="Declaratoria">Declaratoria</option> 
                                            @endif 
                                            @if ($alumnoDocs->publicacion == "0") 
                                                <option value="Publicación">Publicación</option> 
                                            @endif 
                                        @elseif ($alumnoDocs->alumno->id_opcion_titulacion == 12)  
                                            <!-- Seminario de Titulación --> 
                                            @if (!$alumnoDocs->evidencia) 
                                                <option value="Evidencia">Evidencia</option> 
                                            @endif  
                                            @if (!$alumnoDocs->reporte_escrito) 
                                                <option value="Reporte Escrito">Reporte Escrito</option> 
                                            @endif 
                                            @if (!$alumnoDocs->resena_trabajo) 
                                                <option value="Reseña del Trabajo">Reseña del Trabajo</option> 
                                            @endif    
                                            @if (!$alumnoDocs->curriculum_academico) 
                                                <option value="Curriculum vitae Académico">Curriculum vitae Académico</option> 
                                            @endif                                                        
                                        @elseif ($tramite->alumno->id_opcion_titulacion == 13 || $tramite->alumno->id_opcion_titulacion == 14 || $tramite->alumno->id_opcion_titulacion == 16)  
                                            <!-- Diseño o rediseño / Tesis / Informe de practicas -->   
                                            @if ($alumnoDocs->protocolo == "0") 
                                                <option value="Protocolo">Protocolo</option>  
                                            @endif    
                                            @if ($tramite->alumno->id_opcion_titulacion == 13 && !$alumnoDocs->constancia_ganador_pm && $tramite->alumno->ganador_proyecto_modular) 
                                                <option value="Constancia Ganador PM">Constancia Ganador PM</option>  
                                            @endif                                                                                                                                                        
                                        @endif  
                                    </select>
                                @endif
                            </div>
                            <div class="mx-2 w-96">
                                <label for="documento" class="form-label">
                                    <span class="font-bold">
                                        Seleccione un archivo a cargar
                                    </span>
                                </label>
                                <div class="form-control">
                                    <input type="file" name="documento" id="documento" >
                                </div>
                            </div>
                            <div class="mx-2 w-20">
                                <button type="submit" class="btn btn-primary">                                    
                                    <svg class="mx-2 subir" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>.subir{fill:#ffffff}</style><path d="M288 109.3V352c0 17.7-14.3 32-32 32s-32-14.3-32-32V109.3l-73.4 73.4c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l128-128c12.5-12.5 32.8-12.5 45.3 0l128 128c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L288 109.3zM64 352H192c0 35.3 28.7 64 64 64s64-28.7 64-64H448c35.3 0 64 28.7 64 64v32c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V416c0-35.3 28.7-64 64-64zM432 456a24 24 0 1 0 0-48 24 24 0 1 0 0 48z"/></svg>
                                    Subir
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
        <!-- END: Subir Documentos --> 
        <!-- BEGIN: Documentos -->
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
                                        <th class="whitespace-nowrap">Nombre Original</th>
                                        <th class="whitespace-nowrap">Fecha de Registro</th>
                                        <th class="whitespace-nowrap">Estado</th>
                                        <th class="whitespace-nowrap text-center">Acciones</th>
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
                                                    <div class="font-medium whitespace-nowrap">{{ $documento->nombre_original }}</div>                                                   
                                                </td>
                                                <td>
                                                    <div class="font-medium whitespace-nowrap">{{ $documento->created_at }}</div>                                                   
                                                </td>
                                                <td>
                                                    <div class="font-medium whitespace-nowrap">
                                                        @if($documento->aprobado == 0)
                                                            <div class="text-center px-3 py-1 alert-primary-soft border border-primary/10 rounded-full mr-2 mb-2">Entregado</div>                                                                                                                                                                       
                                                        @elseif ($documento->aprobado == 1 || $documento->aprobado == 5)                                                    
                                                            <div class="text-center px-3 py-1 alert-success-soft border border-primary/10 rounded-full mr-2 mb-2">Aprobado</div>                                                    
                                                        @elseif ($documento->aprobado == 2 || $documento->aprobado == 6)
                                                            <div class="text-center px-3 py-1 alert-danger-soft border border-primary/10 rounded-full mr-2 mb-2">No Aprobado</div>
                                                        @elseif ($documento->aprobado == 3)
                                                            <div class="text-center px-3 py-1 alert-pending-soft border border-primary/10 rounded-full mr-2 mb-2">En revisión</div>
                                                        @endif
                                                    </div>
                                                </td>                                                 
                                                <td>
                                                    <div class="flex items-center">
                                                        <!--Boton de ver-->
                                                        <a class="flex items-center whitespace-nowrap justify-center tooltip" title="Ver" href="{{ route('ver-documento', $documento) }}">
                                                            <svg class="svg-inline--fa fa-venus-mars w-6 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="currentColor" d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg>                                                         
                                                        </a>
                                                        <!-- Boton Ver Comentario -->
                                                        @if($documento->comentario != "" && ($documento->aprobado == 2 || $documento->aprobado == 6))                                                        
                                                            <a class="flex items-center whitespace-nowrap justify-center tooltip" title="Ver Comentario" href="javascript:;" data-tw-toggle="modal" data-tw-target="#verComentarioModal{{$documento->id}}">
                                                                <svg class="svg-inline--fa fa-venus-mars w-6 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="currentColor" d="M512 240c0 114.9-114.6 208-256 208c-37.1 0-72.3-6.4-104.1-17.9c-11.9 8.7-31.3 20.6-54.3 30.6C73.6 471.1 44.7 480 16 480c-6.5 0-12.3-3.9-14.8-9.9c-2.5-6-1.1-12.8 3.4-17.4l0 0 0 0 0 0 0 0 .3-.3c.3-.3 .7-.7 1.3-1.4c1.1-1.2 2.8-3.1 4.9-5.7c4.1-5 9.6-12.4 15.2-21.6c10-16.6 19.5-38.4 21.4-62.9C17.7 326.8 0 285.1 0 240C0 125.1 114.6 32 256 32s256 93.1 256 208z"/></svg>
                                                            </a>
                                                        @endif
                                                        <!--Boton de eliminar-->
                                                        @if($tramite->estado != 3 && $documento->aprobado != 1 && $documento->aprobado != 3 && $documento->aprobado != 5)                                                        
                                                            <a class="flex items-center whitespace-nowrap justify-center tooltip" title="Eliminar" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-modal-preview{{$documento->id}}">
                                                                <svg class="svg-inline--fa fa-venus-mars w-6 h-4 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="rgb(var(--color-danger)" d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/></svg>                                                         
                                                            </a>
                                                        @endif
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
                                                                    <a href="{{ route('eliminar-documento', $documento) }}" class="btn btn-danger w-24">Eliminar</a> 
                                                                </div> 
                                                            </div> 
                                                        </div> <!-- END: Modal Eliminar --> 
                                                        <!-- BEGIN: Modal Content -->
                                                        <div id="verComentarioModal{{$documento->id}}" class="modal" tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-body p-0">
                                                                        <div class="p-5 text-center"> <i data-lucide="x-circle" class="w-16 h-16 text-warning mx-auto mt-3"></i>
                                                                            <div class="text-2xl mt-5">Tu documento "{{$documento->nombre_documento}}" No fue Aprobado</div>
                                                                            <div class="text-slate-500 mt-2"><b>Observaciones del documento: </b>{{$documento->comentario}}</div>
                                                                        </div>
                                                                        <div class="px-5 pb-8 text-center"> <button type="button" data-tw-dismiss="modal" class="btn w-24 btn-primary">Ok</button> </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> <!-- END: Modal Content -->                                                           
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
                                        <th class="whitespace-nowrap">Acciones</th>
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
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Estado - Datos Registrados - Documentos Entregados - Documentos No Aprobados-->   
                    @if ($tramite->estado == 2 || $tramite->estado == 5 || $tramite->estado == 6 || $tramite->estado == 9 || $tramite->estado == 8 || $tramite->estado == 11)
                        <div class="text-center mt-5">
                            <a class="btn btn-primary" href="javascript:;" data-tw-toggle="modal" data-tw-target="#revisionTramiteModal">                                    
                                <svg class="svg-inline--fa fa-venus-mars w-6 h-4 text-slate-500 mr-2 blanco" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>.blanco{fill:#ffffff}</style><path  d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM216 408c0 13.3-10.7 24-24 24s-24-10.7-24-24V305.9l-31 31c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l72-72c9.4-9.4 24.6-9.4 33.9 0l72 72c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-31-31V408z"/></svg>
                                Mandar a revisión
                            </a>
                        </div>
                    @endif
                    <!-- BEGIN: Pagination 
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
    </div>          
    <!-- BEGIN: Modal Mandar a Revisión --> 
     <div id="revisionTramiteModal" class="modal" tabindex="-1" aria-hidden="true"> 
        <div class="modal-dialog"> 
            <div class="modal-content"> 
                <!-- BEGIN: Modal Header --> 
                <div class="modal-header"> 
                    <h2 class="font-medium text-base mr-auto">@if($alumno->genero == "Mujer") ¿Segura @else ¿Seguro @endif que quiere mandar a revisión?</h2>                   
                    <div class="dropdown sm:hidden"> 
                        <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown"> 
                            <i data-lucide="more-horizontal" class="w-5 h-5 text-slate-500"></i> 
                        </a>                         
                    </div> 
                </div> <!-- END: Modal Header --> 
                <!-- BEGIN: Modal Body --> 
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3"> 
                    <div class="col-span-12 sm:col-span-12"> 
                        <label for="modal-form-1" class="form-label">Si esta @if ($alumno->genero == "Mujer") segura @else seguro @endif que sus documentos estan correctos presione el botón "Confirmar".</label> 
                    </div>                     
                </div> 
                <!-- END: Modal Body --> 
                <!-- BEGIN: Modal Footer --> 
                <div class="modal-footer"> 
                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancelar</button> 
                    <a  class="btn btn-primary w-20" href="{{ route('mandar-revision-documentos') }}">Confirmar</a> 
                </div> <!-- END: Modal Footer --> 
            </div> 
        </div> 
    </div> <!-- END: Modal Mandar a Revisión -->  

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
