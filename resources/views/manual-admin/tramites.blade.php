@extends('../layout/manual-layout')

@section('subhead')
    <title>Manual de Usuario</title>
@endsection

@section('subcontent')
<div class="grid grid-cols-12 gap-5">    
    <!-- BEGIN: Lista Documentos -->
    <div class="col-span-12 xl:col-span-12">
        <div class="box intro-y p-8 mt-5">
            <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                <div class="font-medium text-2xl font-bold truncate">TRÁMITES</div>
            </div>
            <div>
            <div class="form-inline text-lg font-bold"> 
                <label>#Ver Trámites</label>
            </div>  
            <div class="text-center text-base mt-3">   
                <label> En la seccion de <b>Trámites</b> se visualizan todos los trámites, con su nombre, código, estado del trámite y otros datos. Para ver uno en especifico simplemente se debe presionar el botón de <b>Ver</b>.</label>                 
            </div>  
            <img class="mx-auto w-3/4 mt-3" alt="Ver Tramites" src="{{ asset('build/assets/images/ver-tramites-admin.png') }}">                         
            <div class="text-center text-base mt-3">   
                <label> Se pueden visualizar los datos escolares, personales y laborales del alumno.</label>                                 
            </div>  
            <img class="mx-auto w-3/4 mt-3" alt="Ver Tramite" src="{{ asset('build/assets/images/ver-tramites-admin2.png') }}">
            <div class="alert alert-primary-soft show flex items-center mb-2 mt-3 text" role="alert"> 
                <i data-lucide="alert-circle" class="w-6 h-6 mr-2"></i> 
                Dependiendo del estado del trámite se pueden realizar distintos procesos.
            </div>  
            <div class="form-inline text-lg font-bold mt-5"> 
                <label>#Agregar Trámites</label>
            </div>  
            <div class="text-center text-base mt-3">   
                <label> Para agregar un nuevo trámite, se debe presionar el botón de <b>Crear Trámite</b> en la parte de ver trámites.</label>                 
            </div> 
            <img class="mx-auto w-3/6 mt-3" alt="Agregar Trámites" src="{{ asset('build/assets/images/crear-tramite-admin.png') }}">
            <div class="text-center text-base mt-3">   
                <label>Debe de llenar todos los datos escolares del nuevo usuario y presionar el botón de <b>Guardar</b>. </label>                
            </div>              
            <img class="mx-auto w-3/4 mt-3" alt="Guardar Usuario" src="{{ asset('build/assets/images/crear-tramite-admin2.png') }}">            
            <div class="form-inline text-lg font-bold mt-5"> 
                <label>#Editar Información de Trámites</label>
            </div>
            <div class="text-center text-base mt-3">   
                <label>Para editar la información del alumno, se debe presionar el <b>icono de lápiz</b> de la información que desea editar, ya sean los datos escolares, personales o laborales.</label>                 
            </div>              
            <img class="mx-auto w-3/4 mt-3" alt="Documentos" src="{{ asset('build/assets/images/editar-tramites-admin.png') }}">
            <div class="text-center text-base mt-3">   
                <label>Una vez editada la información presiona el botón de <b>Guardar</b> para guardar los cambios.</label>                 
            </div>              
            <img class="mx-auto w-3/4 mt-3" alt="Documentos" src="{{ asset('build/assets/images/editar-tramites-admin2.png') }}">            
            <div class="form-inline text-lg font-bold mt-5"> 
                <label>#Eliminar Trámites</label>
            </div>
            <div class="text-center text-base mt-3">   
                <label>Para eliminar algún trámite presiona el botón de <b>Eliminar</b>.</label>                 
            </div>
            <img class="mx-auto w-3/4 mt-3" alt="Eliminar Usuario" src="{{ asset('build/assets/images/eliminar-tramite.png') }}">                        
            <div class="text-center text-base mt-3">   
                <label>Saldrá una ventana para <b>confirmar</b> la eliminación donde se deberá ingresar tú contraseña de usuario.</label>                 
            </div>
            <img class="mx-auto w-3/6 mt-3" alt="Confirmar eliminación" src="{{ asset('build/assets/images/eliminar-tramite2.png') }}">            
            <div class="form-inline text-lg font-bold mt-5"> 
                <label>#Aprobar / No Aprobar documentos</label>
            </div>
            <div class="text-center text-base mt-3">   
                <label>Cuando el trámite este en algún estado de revisión, abajo en la tabla de <b>Documentos Entregados</b> se puede <b>aprobar</b> presionando el icono de una palomita o <b>no aprobar</b> presionando el icono de la x.</label>                 
            </div>  
            <img class="mx-auto w-3/4 mt-3" alt="Documentos" src="{{ asset('build/assets/images/validar-admin.png') }}">
            <div class="text-center text-base mt-3">   
                <label>Al aprobar o no aprobar cambia el estado del documento</label>                
            </div>  
            <img class="mx-auto w-3/4 mt-3" alt="Estado del documento" src="{{ asset('build/assets/images/validar-admin2.png') }}">
            <div class="text-center text-base mt-3">   
                <label>Para no aprobar el documento se abrirá una ventana para agregar un comentario y/u observación del documento, y simplemente se da click en confirmar para no aprobarlo.</label>                
            </div>  
            <img class="mx-auto w-3/6 mt-3" alt="No aprobar" src="{{ asset('build/assets/images/no-aprobar.png') }}">            
            <div class="text-center text-base mt-3">   
                <label>Una vez que se hayan revisado todos los documentos (ya no haya ninguno en estado de revisión), se activa el botón de <b>Revisar Documentos</b> si hay documentos no aprobados.</label>                 
            </div>
            <img class="mx-auto w-3/6 mt-3" alt="Revisar documentos" src="{{ asset('build/assets/images/revisar-documentos.png') }}">
            <div class="text-center text-base mt-3">   
                <label>Seguido, se le manda el siguiente correo al alumno informandole que coriija sus documentos.</label>                 
            </div>
            <img class="mx-auto w-3/4 mt-3" alt="Correo" src="{{ asset('build/assets/images/documentos-revisados-email.png') }}">
            <div class="text-center text-base mt-3">   
                <label>Una vez que el alumno vuelva a mandar a <b>Revisión</b> sus documentos solo queda aprobar o desaprobarlos de nuevo.</label>                 
            </div>
            <img class="mx-auto w-3/4 mt-3" alt="Aprobar o no aprobar documentos" src="{{ asset('build/assets/images/validar-admin3.png') }}">
            <div class="text-center text-base mt-3">   
                <label>Si todos los documentos fueron aprobados se activa el botón de <b>Aprobar Documentos</b> para pasar al siguiente proceso.</label>                 
            </div>
            <img class="mx-auto w-3/6 mt-3" alt="Validar documentos" src="{{ asset('build/assets/images/validar-documentos.png') }}">            
        </div>
    </div>
    <!-- END: Lista Documentos -->     
</div> 
@endsection
