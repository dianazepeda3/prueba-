<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>COMPROBANTE ACADEMICO</title>
    
    <link rel="stylesheet" href="{{public_path('css/formatosGenerados.css')}}" type="text/css">

</head>

<body>          
    <div class="right2">
        <p>{{$alumno->carrera->clave}}/CTD/000/2023<p>
    </div>            
    <p class="titulo-comprobante"> COMPROBANTE ACADÉMICO</p>      
    <div class="pos top20 tam-letra">
        <p> El Comité de Titulación de la Carrera de 
            {{ $carrera }}
            hace constar que la estudiante:
        </p>
        <p class="center">
            <b class="underline">{{$alumno->user->name}}</b>    
            Código: 
            <b class="underline">({{$alumno->user->codigo}})</b>    
            Folio:
            <b class="underline">{{ $folio }}</b>
        </p>

        <p>
            Egresado del plan semestral en sistema de {{$plan}}, ha cumplido con los requisitos académicos que le dan derecho a solicitar ceremonia de titulación. 
            La modalidad y opción que le han sido aprobadas, se indica a continuación:
        </p>       
        
        <!--<table>
            <tr>
                <th rowspan="2">
                    Artículo 9.
                    Desempeño Académico Sobresaliente
                </th>                     
                <td class="seleccion-mod">@if ($alumno->id_opcion_titulacion == 1) &nbsp; X @endif</td>  
                <td>I.-Excelencia Académica. </td>
            </tr>
           <tr>
                <td class="seleccion-mod">@if ($alumno->id_opcion_titulacion == 2) &nbsp; X @endif</td>
                <td>II.- Titulación por Promedio. </td>
           </tr>                                 
            <tr>
                <th rowspan="3">
                    Artículo 10.
                    Exámenes
                </th>
                <td class="seleccion-mod">@if ($alumno->id_opcion_titulacion == 3) &nbsp; X @endif</td>
                <td>II.- Examen Global Teórico</td>
            </tr>
            <tr>                
                <td class="seleccion-mod">@if ($alumno->id_opcion_titulacion == 4) &nbsp; X @endif</td>
                <td>III.- Examen General de Certificación Profesional (Ceneval)</td>
            </tr>
            <tr>                
                <td class="seleccion-mod">@if ($alumno->id_opcion_titulacion == 5) &nbsp; X @endif</td>
                <td>IV.- Examen de Capacitación Profesional (Certificación)</td>
            </tr>
            <tr>
                <th>
                    Artículo 11.
                    Producción de Materiales Educativos
                </th>
                <td class="seleccion-mod">@if ($alumno->id_opcion_titulacion == 6) &nbsp; X @endif</td>
                <td>I. Guías Comentadas o Ilustradas.</td>
            </tr>
            <tr>
                <th rowspan="2">
                    Artículo 12.
                    Investigación y Estudios 
                    de Posgrado
                </th>
                <td class="seleccion-mod">@if ($alumno->id_opcion_titulacion == 8) &nbsp; X @endif</td>
                <td>III. -Seminario de Investigación. </td>
            </tr>
            <tr>
                <td class="seleccion-mod">@if ($alumno->id_opcion_titulacion == 9) &nbsp; X @endif</td>
                <td>V. -Diseño o Rediseño de Equipo, Aparato o Maquinaria. </td>
            </tr>
            <tr>
                <th rowspan="2">
                    Artículo 14.
                    Tesis, Tesina e Informes
                </th>
                <td class="seleccion-mod">@if ($alumno->id_opcion_titulacion == 10) &nbsp; X @endif</td>
                <td>I.- Tesis</td>
            </tr>
            <tr>
                <td class="seleccion-mod">@if ($alumno->id_opcion_titulacion == 11) &nbsp; X @endif</td>
                <td>III.- Informe de Prácticas Profesionales</td>
            </tr>            
        </table>-->
        <p>
            Modalidad: <b>{{ mb_strtoupper($alumno->articulo->modalidad, 'UTF-8')}}</b><br>
            Opción: <b>{{ mb_strtoupper($alumno->opcion_titulacion->opcion, 'UTF-8')}}</b><br>                                           
            @if ( $alumno->articulo->id == 1)
                Promedio: <b>{{$promedio}}</b>
            @endif            
        </p>
        <p>
            Y han sido designados los profesores: el Dr. Gutiérrez García Juan Carlos, el Dr. Serrano García David Ignacio y el Dr. Flores Núñez Jorge Luis como:                                                                                                        
        </p>    
        <div class="centrar-profes">    
            <input class="cbox" type="checkbox" checked>                   
            <label for="leer">&nbsp;&nbsp;Presidente, Secretario y Vocal del jurado respectivamente.</label><br><br>
            <input class="cbox " type="checkbox">                        
            <label for="leer">&nbsp;&nbsp;Miembros del Comité para realizar la ceremonia.</label>   
        </div>               
    </div>   
    
    <div class="pos atentamente tam-letra">
        <p>
            A t e n t a m e n t e<br>
            <b>
                "PIENSA Y TRABAJA”<br>
                “{{$anio}}, Año del fomento a la formación integral con una Red de Centros y Sistemas Multitemáticos”<br>
            </b>
            Guadalajara, Jalisco a {{$dia}} de {{$mes}} de {{$anio}}
        </p>
    </div>    
    <img class="firma-digital" src="{{ storage_path('app/' . $firma->ruta) }}">    
    <div class="pos top80 tam-letra">
        <p>
            <b>{{ $alumno->carrera->nombre_coordinador}}</b><br>         
            Coordinador de la Carrera de <br>{{ $alumno->carrera->carrera}}
        </p>  
    </div>
</body>


</html>
