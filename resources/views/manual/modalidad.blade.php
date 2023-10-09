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
                <div class="font-medium text-2xl font-bold truncate">SELECCIONAR MODALIDAD DE TITULACIÓN</div>
            </div>
            <div>
            <div class="form-inline text-lg font-bold"> 
                <label>#Alumnos</label>
            </div>   
            <div class="form-inline text-base mt-3">   
                <label>Al ingresar a la plataforma, deberás escoger la modalidad de titulación llenando los <b>datos escolares</b> faltantes y 
                   registrar tus <b>datos personales</b>. Una vez introducidas, de click en Guardar.</label>                 
            </div>  
            <img class="mx-auto w-3/4 mt-3" alt="Logo udg" src="{{ asset('build/assets/images/registrar-datos.png') }}">
            <div class="form-inline text-base mt-3">   
                <label>Seguido, deberás llenar los <b>datos laborales</b>. Una vez introducidas, de click en Guardar.</label>                 
            </div>  
            <img class="mx-auto w-3/4 mt-3" alt="Logo udg" src="{{ asset('build/assets/images/registrar-datos2.png') }}">
                 
            <div class="alert alert-primary-soft show flex items-center mb-2 mt-3 text" role="alert"> 
                <i data-lucide="alert-circle" class="w-6 h-6 mr-2"></i> 
                Dependiendo de si se selecciona si trabaja o no y si es afin a la carrera o no se pedirán llenar distitos campos.
            </div>           
        </div>
    </div>
    <!-- END: Lista Documentos -->     
</div> 
@endsection
