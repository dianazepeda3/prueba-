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
        class="computacion"
    @else
        class="biomedica"
    @endif>                  
    <p class="acomodo-titulo bold"> DICTAMEN DE EVALUACION DE<br>
        MODALIDAD Y TRABAJO DE TITULACI&Oacute;N
    </p> 
    <div class="right">
        <p>{{$alumno->carrera->clave}}/CDT/000/2023<p>
    </div>
    <div class="pos datos">
        <p>
            En reunión ordinaria celebrada por el Comité de Titulación, se evaluó la Solicitud <b>No.23/024</b>
            presentada por 
            @if ($alumno->genero == 'M') la egresada:
            @elseif($alumno->genero == 'H') el egresado: @endif  
            <b><i>{{ mb_strtoupper($alumno->user->name) }} ({{ mb_strtoupper($alumno->user->codigo) }}).</i></b>
        </p>

        <p>
            Quien propone titularse con la Modalidad: <b><i>{{ mb_strtoupper($alumno->articulo->modalidad, 'UTF-8') }}</b></i><br><br>
            Opción: <b><i>{{ mb_strtoupper($alumno->opcion_titulacion->opcion, 'UTF-8') }}</i></b><br><br>            
            @if ($alumno->id_opcion_titulacion == 1)                
                De conformidad con el Artículo 9, Fracción I del Reglamento General de Titulación de la Universidad de Guadalajara y del Artículo 9, Fracción I 
            @elseif ($alumno->id_opcion_titulacion == 2)
                De conformidad con el Artículo 9, Fracción II del Reglamento General de Titulación de la Universidad de Guadalajara y del Artículo 9, Fracción II 
            @elseif ($alumno->id_opcion_titulacion == 7)
                Con el trabajo titulado: <b>{{ mb_strtoupper($alumno->titulo_del_trabajo, 'UTF-8') }}</b><br><br>
                De conformidad con el Artículo 11, Fracción I del Reglamento General de Titulación de la Universidad de Guadalajara y del Artículo 11, Fracción I
            @elseif ($alumno->id_opcion_titulacion == 13)
                Con el trabajo titulado: <b>{{ mb_strtoupper($alumno->titulo_del_trabajo, 'UTF-8') }}</b><br><br>
                De conformidad con el Artículo 12, Fracción V del Reglamento General de Titulación de la Universidad de Guadalajara y del Artículo 12, Fracción V
            @elseif ($alumno->id_opcion_titulacion == 16)
                Con el trabajo titulado: <b>{{ mb_strtoupper($alumno->titulo_del_trabajo, 'UTF-8') }}</b><br><br>
                De conformidad con el Artículo 14, Fracción III del Reglamento General de Titulación de la Universidad de Guadalajara y del Artículo 13, Fracción III 
            @endif  
            del Reglamento de Titulación del Centro Universitario de Ciencias Exactas e Ingenierías; y en virtud del cumplimiento de los requisitos indicados por este Comité, dicha propuesta ha sido considerada:                                        
            <div class="bold cursiva center underline">
                APROBADA
            </div>
        </p> 
        <p>
            @if ($alumno->id_articulo == 1)
                Por lo cual deberá reunir en un plazo no mayor de un año, a partir de la fecha del presente oficio, la documentación necesaria para solicitar la fecha en que se efectuará la Ceremonia de Titulación.                    
            @elseif ($alumno->id_opcion_titulacion == 7 || $alumno->id_opcion_titulacion == 13 || $alumno->id_opcion_titulacion == 16)
                Ha sido designado como director de titulación <b><i>{{ $presidente }}</b></i>, como secretario <b><i>{{ $secretario }}</b> y vocal <b><i>{{ $vocal }}</b> quienes darán seguimiento y asesoría a su proceso de titulación. 
                    El Comité de Titulación ha establecido que la fecha límite para su titulación es en {{ $mes_limite }} {{ $anio_limite }}.        
            @endif
        </p>        
    </div>
    <!--<div class="pos aprobada bold cursiva">
        <p>APROBADA<br><br></p>
    </div>-->
    <div class="pos abajo">
        <p>
            A t e n t a m e n t e<br>
            <b>
                "PIENSA Y TRABAJA"<br>
                “{{$anio}}, Año del fomento a la formación integral con una Red de Centros y Sistemas Multitemáticos”<br>
            </b>
            Guadalajara, Jalisco a {{$dia}} de {{$mes}} de {{$anio}}.
        </p>
    </div>
    <img class="firma-digital-dictamen" src="{{ storage_path('app/' . $firma->ruta) }}">   
    <div class="pos presidente">
        <p>
            <b>{{ $alumno->carrera->nombre_coordinador}}</b><br>
            Coordinador de la Carrera de <br>{{ $alumno->carrera->carrera}}
        </p>  
    </div>
</body>


</html>
