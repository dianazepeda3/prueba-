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
                <div class="font-medium text-2xl font-bold truncate">INICIO DE SESIÓN</div>
            </div>
            <div>
            <div class="form-inline text-lg font-bold"> 
                <label>#Alumnos</label>
            </div>   
            <div class="form-inline text-base mt-3">   
                <label>El Login para los alumnos estará en la seccion de <b>Acceso SIIAU</b>.</label> 
                
            </div>  
            <div class="form-inline text-base mt-3">                   
                <ul>
                    <li>- Para poder ingresar a la plataforma tendrá que introducir sus credenciales de SIIAU (Código y NIP).</li>
                    <li>- Una vez introducidas, de click en Iniciar Sesión.</li>                   
                </ul>
            </div>
            <img class="mx-auto w-1/2 mt-3" alt="Logo udg" src="{{ asset('build/assets/images/login-alumno.png') }}">
                
            <div class="alert alert-primary-soft show flex items-center mb-2 mt-3 text" role="alert"> 
                <i data-lucide="alert-circle" class="w-6 h-6 mr-2"></i> 
                Al realizar esta acción tendrá que esperar unos instantes mientras el sistema realiza comprueba las credenciales.
            </div>
            <div class="form-inline text-lg font-bold"> 
                <label>#Coordinadores</label>
            </div>   
            <div class="form-inline text-base mt-3">   
                <label>El Login para los alumnos estará en la seccion de <b>Acceso</b>.</label> 
                
            </div>  
            <div class="form-inline text-base mt-3">                   
                <ul>
                    <li>- Para poder ingresar a la plataforma tendrá que introducir sus credenciales del sistema (Correo y Contraseña)..</li>
                    <li>- Una vez introducidas, de click en Iniciar Sesión.</li>                   
                </ul>
            </div>
            <img class="mx-auto w-1/2 mt-3" alt="Logo udg" src="{{ asset('build/assets/images/login-admin.png') }}">
                                        
                   
        </div>
    </div>
    <!-- END: Lista Documentos -->     
</div> 
@endsection
