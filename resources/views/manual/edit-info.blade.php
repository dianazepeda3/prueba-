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
                <div class="font-medium text-2xl font-bold truncate">EDITAR MI INFORMACIÓN</div>
            </div>
            <div>
            <div class="form-inline text-lg font-bold"> 
                <label>#Alumnos</label>
            </div>   
            <div class="text-center text-base mt-3">   
                <label>En la sección de <b>Mis Datos</b> se encuentran toda la información ingresada con anterioridad. Para <b>editar</b>
                    la información debes dar click en el icono del lápiz.</label>                 
            </div>  
            <img class="mx-auto w-3/4 mt-3" alt="Logo udg" src="{{ asset('build/assets/images/editar-mis-datos.png') }}">
            <div class="text-center text-base mt-3">   
                <label>Y puedes editar los <b>datos ecolares, personales y/o laborales</b>. Una vez editada la información, de click en Guardar.</label>                 
            </div>  
            <img class="mx-auto w-3/4 mt-3" alt="Logo udg" src="{{ asset('build/assets/images/editar-mis-datos2.png') }}">
                 
            <!--<div class="alert alert-primary-soft show flex items-center mb-2 mt-3 text" role="alert"> 
                <i data-lucide="alert-circle" class="w-6 h-6 mr-2"></i> 
                oeihfiu
            </div>-->
        </div>
    </div>
    <!-- END: Lista Documentos -->     
</div> 
@endsection
