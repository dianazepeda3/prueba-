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
                <div class="font-medium text-2xl font-bold truncate">FIRMA</div>
            </div>
            <div>
            <div class="form-inline text-lg font-bold"> 
                <label>#Agregar Firma</label>
            </div>   
            <div class="text-center text-base mt-3">   
                <label>Para guardar tu firma digital ingresa a la sección de <b>Firma Digital</b>.</label>                 
            </div>              
            <img class="mx-auto w-3/4 mt-3" alt="Firma" src="{{ asset('build/assets/images/firma.png') }}">                           
            <div class="text-center text-base mt-3">   
                <label>Ingresa la firma en el recuadro y presiona el botón de <b>Guardar</b>.</label>                 
            </div>
            <img class="mx-auto w-3/4 mt-3" alt="Firma" src="{{ asset('build/assets/images/firma2.png') }}">
            <div class="form-inline text-lg font-bold mt-5"> 
                <label>#Ver Firma</label>
            </div>   
            <div class="form-inline text-base mt-3">   
                <label>Si tiene una firma guardada se muestra en la parte inferioi una tablita, presiona el botón <b>Ver</b> para visualizar la firma.</label>                 
            </div>             
            <img class="mx-auto w-1/2 mt-3" alt="Logo udg" src="{{ asset('build/assets/images/firma3.png') }}">
                                        
                   
        </div>
    </div>
    <!-- END: Lista Documentos -->     
</div> 
@endsection
