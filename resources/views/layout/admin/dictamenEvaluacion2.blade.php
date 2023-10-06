<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ mb_strtoupper($alumno->opcion_titulacion->opcion, 'UTF-8') }}</title>
    <link rel="stylesheet" href="{{public_path('css/formatosGenerados.css')}}" type="text/css">
    
</head>

<body 
    @if ($alumno->carrera->clave == "INCO" || $alumno->carrera->clave == "ICOM")
        class="computacion letra14"
    @else
        class="biomedica letra14"
    @endif>    
   
    <div class="folio">
        <p>
            CUCEI/CDCOM/{{ $alumno->consecutivo }}<br>
            Código: <b>{{ $alumno->user->codigo }}</b>
        <p>
        
    </div>
    <div class="pos datos2">
        <p>
            <b>C. {{ mb_strtoupper($alumno->user->name) }}</b><br> 
            @if ($alumno->genero == 'M') EGRESADA
            @elseif($alumno->genero == 'H') EGRESADO @endif  
            DE LA CARRERA {{ mb_strtoupper($alumno->carrera->carrera) }}<br>
            P R E S E N T E
        </p>

        <p>
            Por este conducto le damos a conocer el Dictamen emitido por el Comité de Titulación de Ingeniería en Computación con relación a su solicitud de aprobación 
            de modalidad y opción de titulación, conforme al Reglamento General de Titulación de la Universidad de Guadalajara:
        </p>        

        <p>
            Artículo {{ $alumno->articulo->numero_articulo}}, <br>
            Opción {{ $alumno->opcion_titulacion->fraccion}}, <br><br>                    
            Y conforme al reglamento particular del Centro Universitario de Ciencias Exactas e Ingenierías <br><br>
            Artículo {{ $alumno->articulo->numero_articulo}}, <br>
            Opción {{ $alumno->opcion_titulacion->fraccion}}, <br><br>     
            @if($alumno->id_opcion_titulacion >= 13)
                Con el titulo: <b>{{ $alumno->titulo_del_trabajo }}</b><br><br>
            @endif               
            Con base en lo anterior este Comité emite el siguiente:
            <div class="bold cursiva center underline">
                DICTAMEN APROBADO
            </div><br>
            @if($alumno->id_opcion_titulacion >= 13)
                Que queda asentado en el acta de sesión con fecha {{ $dia }} de {{ $mes }} de {{ $anio }}, con el folio No. {{$alumno->numero_de_consecutivo }}/23, y en la que este Comité designa como: Presidente: <b>{{ $presidente }}</b>, Secretario: <b>{{ $secretario }}</b>, y como Vocal: <b>{{ $vocal }}</b>. <br><br>                     
                Con base al procedimiento académico-administrativo de titulación del CUCEI se le otorga el plazo de 1 año a partir de la fecha de su dictaminación para la presentación del trabajo.
            @else
                Queda asentado en el acta de sesión con fecha {{ $dia }} de {{ $mes }} de {{ $anio }}, con el folio No. {{$alumno->numero_de_consecutivo }}/23, este Comité llevará a cabo la Ceremonia de Titulación. <br><br>
                Con base al procedimiento académico-administrativo de titulación del CUCEI se le otorga el plazo de un año a partir de la fecha de su dictaminación.            
            @endif
        </p>       
    </div>
    <div class="modalidad">
        {{ $alumno->articulo->modalidad}} <br>
        {{ $alumno->opcion_titulacion->opcion }} <br><br><br><br>  
        {{ $alumno->articulo->modalidad}} <br>
        {{ $alumno->opcion_titulacion->opcion }} <br><br>           
    </div>
    <div class="pos abajo">
        <p>
            <b>
                A T E N T A M E N T E<br>
            
                "Piensa y Trabaja"<br><br>
            </b>
            “{{$anio}}, Año del fomento a la formación integral con una Red de Centros y Sistemas Multitemáticos”<br>            
            Guadalajara, Jalisco a {{$dia}} de {{$mes}} de {{$anio}}.
        </p>
    </div>         
    <div class="pos linea-firma" style="margin-left: 19%; width: 35%; border-bottom: solid 1px;">&nbsp;&nbsp;&nbsp;</div> 
    <img class="firma-digital-dictamen2" src="{{ storage_path('app/' . $firma->ruta) }}"><br>  
    <div class="pos presidente">
        <p>
            {{ $alumno->carrera->nombre_coordinador}}<br>
            Presidente del comité de titulación en {{ $alumno->carrera->carrera}}
        </p>  
        <p class="letra10 cursiva">JLDBC/Ipcb</p> 
    </div>
</body>


</html>
