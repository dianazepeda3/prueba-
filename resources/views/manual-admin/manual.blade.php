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
                <div class="font-medium text-2xl font-bold truncate">MANUAL DE USUARIO</div>
            </div>
            <div>
            <div class="form-inline text-lg font-bold"> 
                <label>Bienvenid@</label>
            </div>   
            <div class="form-inline text-base mt-3">   
                <label>Sistema de Titulación de CUCEI</label> 
            </div>              
            <div class="form-inline text-lg font-bold mt-5"> 
                <label>Ayuda</label>
            </div>  
            <div class="form-inline text-base text-justify mt-3">                                        
                <p>A continuación podrás encontrar una serie de guías que podrán ayudarte a comprender la plataforma de <b>Titulación</b>. O resolver problemas con los que te estás enfrentando.</label><label class="form-label sm:w-20"></p>                                                                                             
            </div>                          
                   
        </div>
    </div>
    <!-- END: Lista Documentos -->     
</div> 
@endsection
