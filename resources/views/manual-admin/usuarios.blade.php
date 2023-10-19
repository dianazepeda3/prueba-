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
                <div class="font-medium text-2xl font-bold truncate">USUARIOS</div>
            </div>
            <div>
            <div class="form-inline text-lg font-bold"> 
                <label>#Ver Usuarios</label>
            </div>  
            <div class="text-center text-base mt-3">   
                <label> En la seccion de <b>Usuarios</b> en la parte de <b>Ver Usuarios</b> se visualizan todos los usuarios. Para cada usuario se tiene la opción de editar o eliminar.</label>                 
            </div>  
            <img class="mx-auto w-3/4 mt-3" alt="Ver Usuarios" src="{{ asset('build/assets/images/ver-usuarios.png') }}">             
            <div class="form-inline text-lg font-bold mt-5"> 
                <label>#Agregar Usuarios</label>
            </div>
            <div class="text-center text-base mt-3">   
                <label> Para agregar un nuevo usuario, se puede desde la seccion de <b>Usuarios</b> en la parte de <b>Agregar Usuario</b> o dando click en el botón de <b>Agregar Nuevo Usuario</b> en la parte de ver usuarios.</label>                 
            </div>  
            <img class="mx-auto w-3/4 mt-3" alt="Agregar Usuario" src="{{ asset('build/assets/images/crear-usuarios.png') }}">
            <div class="text-center text-base mt-3">   
                <label>Debe de llenar todos los datos del nuevo usuario y presionar el botón de <b>Guardar</b>. </label>                
            </div>  
            <img class="mx-auto w-3/4 mt-3" alt="Guardar Usuario" src="{{ asset('build/assets/images/crear-usuarios2.png') }}">
            <div class="text-center text-base mt-3">   
                <label><b>Importante: </b>al seleccionar el tipo de usuario, si este es Coordinador se muestra otro campo para elegir la carrera.</label>                 
            </div>                      
            <img class="mx-auto w-3/4 mt-3" alt="Seleccionar Carrera" src="{{ asset('build/assets/images/elegir-carrera-usuario.png') }}">             
            <div class="form-inline text-lg font-bold mt-5"> 
                <label>#Editar Usuario</label>
            </div> 
            <div class="text-center text-base mt-3">   
                <label>Para editar un usuario simplemente se debe presionar el botón de <b>Editar</b>.</label>                 
            </div>
            <img class="mx-auto w-3/4 mt-3" alt="Editar Usuario" src="{{ asset('build/assets/images/editar-usuarios.png') }}">                        
            <div class="text-center text-base mt-3">   
                <label>Se puede editar la información, si desea cambiar la contraseña del usuario debe de seleccionar que SI y se mostraran mas campos para ello.</label>                 
            </div>
            <img class="mx-auto w-3/6 mt-3" alt="Editar información" src="{{ asset('build/assets/images/editar-usuarios2.png') }}">         
            <div class="text-center text-base mt-3">   
                <label>Se llenan los campos de contraseña y, para guardar los cambios presiona el botón de <b>Guardar</b>.</label>                 
            </div>
            <img class="mx-auto w-3/4 mt-5" alt="Guardar cambios" src="{{ asset('build/assets/images/editar-usuarios3.png') }}">
            <div class="form-inline text-lg font-bold mt-3"> 
                <label>#Eliminar Usuario</label>
            </div>
            <div class="text-center text-base mt-3">   
                <label>Para eliminar un usuario presiona el botón de <b>Eliminar</b>.</label>                 
            </div>
            <img class="mx-auto w-3/4 mt-3" alt="Eliminar Usuario" src="{{ asset('build/assets/images/eliminar-usuarios.png') }}">                        
            <div class="text-center text-base mt-3">   
                <label>Saldrá una ventana para <b>confirmar</b> la eliminación donde se deberá ingresar tú contraseña de usuario.</label>                 
            </div>
            <img class="mx-auto w-3/6 mt-3" alt="Confirmar eliminación" src="{{ asset('build/assets/images/eliminar-usuarios2.png') }}">            
                     
                    
        </div>
    </div>
    <!-- END: -->     
</div> 
@endsection
