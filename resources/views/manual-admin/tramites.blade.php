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
                <label>Debe de llenar todos los datos del nuevo usuario y presionar el botón de <b>Guardar</b>. </label>                
            </div>  
            <img class="mx-auto w-3/4 mt-3" alt="Guardar Usuario" src="{{ asset('build/assets/images/crear-tramite-admin2.png') }}">            
            <div class="text-center text-base mt-3">   
                <label> Para subir documentos, en la seccion de <b>Mis Documentos</b> se visualizan todos los documentos requeridos dependiendo la modalidad elegida.</label>                 
            </div>  
            <img class="mx-auto w-3/4 mt-3" alt="Documentos" src="{{ asset('build/assets/images/validar-admin.png') }}">
            <div class="text-center text-base mt-3">   
                <label>Debe seleccionar el nombre del archivo que desea subir. </label>                
            </div>  
            <img class="mx-auto w-3/4 mt-3" alt="Seleccionar nombre" src="{{ asset('build/assets/images/validar-admin2.png') }}">
            <div class="text-center text-base mt-3">   
                <label>Seguido, deberás cargar el documento y presionar el botón de <b>Subir</b>.</label>                 
            </div>
            <img class="mx-auto w-3/4 mt-3" alt="Cargar documento" src="{{ asset('build/assets/images/validar-admin3.png') }}">
            <div class="text-center text-base mt-3">   
                <label>Al subir un documento se puede visualizar en la tabla de abajo en los documentos entregados, lo puedes visualizar o eliminar y volver a subir otro documento.</label>                 
            </div>            
            <img class="mx-auto w-3/4 mt-3" alt="Ver documento" src="{{ asset('build/assets/images/subir-documentos3.png') }}">
            <div class="alert alert-primary-soft show flex items-center mb-2 mt-3 text" role="alert"> 
                <i data-lucide="alert-circle" class="w-6 h-6 mr-2"></i> 
               Una vez elegido el documento no se puede subir otro con el mismo nombre, por lo que debe ser eliminado para poder subir otro.
            </div>  
            <div class="form-inline text-lg font-bold"> 
                <label>#Eliminar Documento</label>
            </div> 
            <div class="text-center text-base mt-3">   
                <label>Para eliminar un documento simplemente se debe presionar el botón de <b>Eliminar</b> que es el que tiene el icono de basura.</label>                 
            </div>
            <img class="mx-auto w-3/4 mt-3" alt="Eliminar documeto" src="{{ asset('build/assets/images/eliminar-doc.png') }}">                        
            <div class="text-center text-base mt-3">   
                <label>Seguido, saldrá una ventana para confirmar que deseas eliminarlo.</label>                 
            </div>
            <img class="mx-auto w-3/6 mt-3" alt="Confirmación de eliminación" src="{{ asset('build/assets/images/eliminar-doc2.png') }}">
            <div class="form-inline text-lg font-bold mt-3"> 
                <label>#Mandar a Revisión</label>
            </div> 
            <div class="text-center text-base mt-3">   
                <label>Para mandar a revisión deben estar completos todos los documentos obligatorios de la modalidad seleccionada.</label>                 
            </div>
            <img class="mx-auto w-3/4 mt-3" alt="Documentos requeridos" src="{{ asset('build/assets/images/subir-documentos4.png') }}">
            <div class="text-center text-base mt-3">   
                <label>Una vez completos presiona el botón de <b>Mandar a Revisión</b>.</label>                 
            </div>
            <img class="mx-auto w-3/4 mt-3" alt="Mandar a revisión" src="{{ asset('build/assets/images/mandar-revision.png') }}">                        
            <div class="text-center text-base mt-3">   
                <label>Saldrá una ventana para <b>confirmar</b>.</label>                 
            </div>
            <img class="mx-auto w-3/6 mt-3" alt="Confirmar revisión" src="{{ asset('build/assets/images/subir-documentos5.png') }}">            
            <div class="text-center text-base mt-3">   
                <label>Una vez confirmado los documentos estarán en revisión (tiene que esperar a que la coordinación los revise).</label>                 
            </div>
            <img class="mx-auto w-3/4 mt-3" alt="Documentos en revisión" src="{{ asset('build/assets/images/subir-documentos6.png') }}">
            <div class="text-center text-base mt-3">   
                <label>Cuando tus documentos hayan sido revisados recibirás un correo en el que se te indicará si tus documentos fueron aprobados o no. Si <b>no fueron aprobados</b> recibirás el siguiente correo.</label>                 
            </div>
            <img class="mx-auto w-3/4 mt-3" alt="Logo udg" src="{{ asset('build/assets/images/documentos-revisados-email.png') }}">            
            <div class="form-inline text-lg font-bold mt-3"> 
                <label>#Documentos No Aprobados</label>
            </div>
            <div class="text-center text-base mt-3">   
                <label>En la parte de <b>Documentos Entregados</b> se pueden visualizar que documentos no han sido aprobados, tienes la opción de ver la observación y de eliminarlo para subirlo de nuevo.</label>                 
            </div>
            <img class="mx-auto w-3/4 mt-3" alt="Ver Documentos no aprobados" src="{{ asset('build/assets/images/subir-documentos7.png') }}">
            <div class="text-center text-base mt-3">   
                <label>Al presionar el icono de comentario se abre una ventana para ver las observaciones del documento.</label>                 
            </div>
            <img class="mx-auto w-3/6 mt-3" alt="Ver Comentario" src="{{ asset('build/assets/images/ver-comentario.png') }}">
            <div class="alert alert-primary-soft show flex items-center mb-2 mt-3 text" role="alert"> 
                <i data-lucide="alert-circle" class="w-6 h-6 mr-2"></i> 
               Una vez elegido corregidos los documentos no aprobados se debe mandar a revisión y volver a esperar la revisión.
            </div>                
                    
        </div>
    </div>
    <!-- END: Lista Documentos -->     
</div> 
@endsection
