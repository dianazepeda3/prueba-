@extends('../layout/' . $layout)

@section('subhead')
    <title>Trámites - Titulación CUCEI</title>
@endsection

@section('subcontent')
     
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>

    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">

    <style>
        .kbw-signature { width: 100%; height: 200px;}
        #sig canvas{
            width: 100% !important;
            height: auto;
        }
    </style>

    {{-- ERRORES --}}
    <div class="grid grid-cols-12 gap-12 mt-5"> 
        <div class="intro-y col-span-12 lg:col-span-2"></div>
        <div class="intro-y col-span-12 lg:col-span-8">  
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

    <div class="grid grid-cols-12 gap-6 ">             
        <div class="intro-y col-span-12 lg:col-span-3"></div>
        <div class="intro-y col-span-12 lg:col-span-6">                         
            <!-- BEGIN: Horizontal Form -->
            <div class="intro-y box mt-5">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">FIRMA DIGITAL</h2>                    
                </div>
                <div id="horizontal-form" class="p-5">
                    <div class="card">                        
                        <div class="card-body">
                             @if ($message = Session::get('success'))
                                 <div class="alert alert-success  alert-dismissible">
                                     <button type="button" class="close" data-dismiss="alert">×</button>  
                                     <strong>{{ $message }}</strong>
                                 </div>
                             @endif
                             
                            <form method="POST" action="{{ route('guardar-firma') }}">
                                @csrf
                                <div class="col-md-12">
                                <label class="" for="">Ingrese la firma que desea guardar:</label> <br/><br>
                                <div id="sig" ></div> <br/>                                     
                                </div>  <br/>
                                <button class="btn btn-success" type="submit">Guardar</button>
                                <button id="clear" class="btn btn-danger ">Borrar</button>
                                <textarea id="signature64" name="signed" style="display: none"></textarea>
                            </form>
                        </div>
                    </div>                    
                </div>
            </div>
            <!-- END: Horizontal Form -->                       
        </div>
    </div>
    @if (isset($firma)) 
        <div class="grid grid-cols-12 gap-6 ">             
            <div class="intro-y col-span-12 lg:col-span-3"></div>
            <div class="intro-y col-span-12 lg:col-span-6">                         
                <!-- BEGIN: Horizontal Form -->
                <div class="intro-y box mt-5">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <h2 class="font-medium text-base mr-auto">FIRMA GUARDADA</h2>                    
                    </div>
                    <div id="horizontal-form" class="p-5">                       
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">                                                                                                                    
                                                <tbody>     
                                                    <tr>
                                                        <th>Firma Guardada</th>                                                                                                                                                                                          
                                                        <td class="col-xl-12">
                                                            <!--Boton de ver-->  
                                                            <div class="btn-group mr-2">                                                          
                                                            <a href="{{ route('ver-firma', $firma) }}" class="btn btn-primary btn-icon-split" id="enviardatos">                                                            
                                                                <svg class="svg-inline--fa fa-venus-mars w-4 h-4 text-slate-500 mr-2 blanco" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>.blanco{fill:#ffffff}</style><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg> 
                                                                <span class="text">Ver</span>
                                                            </a>  
                                                            </div>
                                                        </td>
                                                    </tr>                                
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Horizontal Form -->                       
            </div>
        </div>
    @endif

    <script type="text/javascript">
        var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG', background: 'transparent'});
        $('#clear').click(function(e) {
            e.preventDefault();
            sig.signature('clear');
            $("#signature64").val('');
        });
    </script>
@endsection
