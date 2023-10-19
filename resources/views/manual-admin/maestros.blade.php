@extends('../layout/manual-layout')

@section('subhead')
    <title>Manual de Usuario</title>
@endsection

@section('subcontent')
<div class="grid grid-cols-12 gap-5">    
    <!-- BEGIN: -->
    <div class="col-span-12 xl:col-span-12">
        <div class="box intro-y p-8 mt-5">
            <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                <div class="font-medium text-2xl font-bold truncate">MAESTROS</div>
            </div>
            <div>
            <div class="form-inline text-lg font-bold"> 
                <label>#Ver Maestros</label>
            </div>  
            <div class="text-center text-base mt-3">   
                <label> En la seccion de <b>Maestros</b> en la parte de <b>Ver Maestros</b> se visualizan todos los maestros. Para cada uno se tiene la opción de editar o eliminar.</label>                 
            </div>  
            <img class="mx-auto w-3/4 mt-3" alt="Ver Maestros" src="{{ asset('build/assets/images/ver-maestros.png') }}">             
            <div class="form-inline text-lg font-bold mt-5"> 
                <label>#Agregar Maestros</label>
            </div>
            <div class="text-center text-base mt-3">   
                <label> Para agregar un nuevo Maestro, se puede desde la seccion de <b>Maestros</b> en la parte de <b>Agregar Maestro</b> o dando click en el botón de <b>Agregar Maestro</b> en la parte de ver maestros.</label>                 
            </div>  
            <img class="mx-auto w-3/4 mt-3" alt="Agregar Maestro" src="{{ asset('build/assets/images/crear-maestros.png') }}">
            <div class="text-center text-base mt-3">   
                <label>Debe de llenar todos los datos del nuevo maestro y presionar el botón de <b>Guardar</b>. </label>                
            </div>  
            <img class="mx-auto w-3/4 mt-3" alt="Guardar Maestro" src="{{ asset('build/assets/images/crear-maestros2.png') }}">
            <div class="form-inline text-lg font-bold mt-5"> 
                <label>#Editar Maestro</label>
            </div> 
            <div class="text-center text-base mt-3">   
                <label>Para editar al maestro simplemente se debe presionar el botón de <b>Editar</b>.</label>                 
            </div>
            <img class="mx-auto w-3/4 mt-3" alt="Editar Maestro" src="{{ asset('build/assets/images/editar-maestros.png') }}">                        
            <div class="text-center text-base mt-3">   
                <label>Se puede editar la información, si desea cambiar la contraseña del maestro debe de seleccionar que SI y se mostraran mas campos para ello.</label>                 
            </div>
            <img class="mx-auto w-3/6 mt-3" alt="Editar información" src="{{ asset('build/assets/images/editar-maestros2.png') }}">         
            <div class="text-center text-base mt-3">   
                <label>Se llenan los campos de contraseña y, para guardar los cambios presiona el botón de <b>Guardar</b>.</label>                 
            </div>
            <img class="mx-auto w-3/4 mt-5" alt="Guardar cambios" src="{{ asset('build/assets/images/editar-maestros3.png') }}">
            <div class="form-inline text-lg font-bold mt-3"> 
                <label>#Eliminar Maestro</label>
            </div>
            <div class="text-center text-base mt-3">   
                <label>Para eliminar a un maestro presiona el botón de <b>Eliminar</b>.</label>                 
            </div>
            <img class="mx-auto w-3/4 mt-3" alt="Eliminar Maestro" src="{{ asset('build/assets/images/eliminar-maestro.png') }}">                        
            <div class="text-center text-base mt-3">   
                <label>Saldrá una ventana para <b>confirmar</b> la eliminación donde se deberá ingresar tú contraseña de usuario.</label>                 
            </div>
            <img class="mx-auto w-3/6 mt-3" alt="Confirmar eliminación" src="{{ asset('build/assets/images/eliminar-maestro2.png') }}">            
                     
                    
        </div>
    </div>
    <!-- END: -->     
</div> 
@endsection
