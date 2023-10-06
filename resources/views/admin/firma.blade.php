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

    <div class="grid grid-cols-12 gap-6 ">             
        <div class="intro-y col-span-12 lg:col-span-3"></div>
        <div class="intro-y col-span-12 lg:col-span-6">                         
            <!-- BEGIN: Horizontal Form -->
            <div class="intro-y box mt-5">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">FIRMA GUARDADA</h2>                    
                </div>
                <div id="horizontal-form" class="p-5">                   
                    @if (isset($firma))                          
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">                                                                                                                    
                                                <tbody>     
                                                    <tr>
                                                        <th>Firma Guardada</th>                                                                                                                                    
                                                        <td class="col-xl-6">
                                                            <!--Boton de ver-->                                                            
                                                            <a href="{{ route('ver-firma', $firma) }}" class="btn btn-primary btn-icon-split" id="enviardatos">                                                            
                                                                <span class="text"><i class="fas fa-eye"></i> Ver</span>
                                                            </a>  
                                                        </td>
                                                    </tr>                                
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <!-- END: Horizontal Form -->                       
        </div>
    </div>

    <script type="text/javascript">
        var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG', background: 'transparent'});
        $('#clear').click(function(e) {
            e.preventDefault();
            sig.signature('clear');
            $("#signature64").val('');
        });
    </script>
@endsection
