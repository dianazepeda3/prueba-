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

<body   
    @if ($alumno->carrera->clave == "INCO" || $alumno->carrera->clave == "ICOM")
        class="computacion letra12"
    @else
        class="biomedica letra12"
    @endif>  
               
    <p class="titulo-comprobante2 letra14"> COMPROBANTE ACADÉMICO</p>      
    <div class="pos datos-comprobante">
        <p> 
            El Comité de Titulación de la Carrera de {{ $carrera }} hace constar que el (la) egresado (a):
            <b class="underline">{{$alumno->user->name}}</b>    
            Código: 
            <b class="underline">({{$alumno->user->codigo}})</b>    
            Folio:
            <b class="underline">{{ $folio }}</b><br>        
            Egresado del Plan Semestral en Sistema de Créditos, ha cumplido con los requisitos académicos que le dan derecho a solicitar ceremonia de titulación.  
            La modalidad y opción que le han sido aprobadas se indica en la siguiente tabla:
        </p>       
        
        <table>            
            <tr>
                <td rowspan="2">
                    Artículo 9.<br>
                    Desempeño Académico Sobresaliente
                </td>                     
                <td class="seleccion-mod">@if ($alumno->id_opcion_titulacion == 1) &nbsp; X @endif</td>  
                <td>I.-Excelencia Académica. </td>
            </tr>
           <tr>
                <td class="seleccion-mod">@if ($alumno->id_opcion_titulacion == 2) &nbsp; X @endif</td>
                <td>II.- Titulación por Promedio. </td>
           </tr>                                 
            <tr>
                <td rowspan="4">
                    Artículo 10.<br>
                    Exámenes
                </td>
                <td class="seleccion-mod">@if ($alumno->id_opcion_titulacion == 3) &nbsp; X @endif</td>
                <td>I.- Examen Global Teórico Práctico</td>                
            </tr>
            <tr>
                <td class="seleccion-mod">@if ($alumno->id_opcion_titulacion == 4) &nbsp; X @endif</td>
                <td>II.- Examen Global Teórico</td>
            </tr>
            <tr>                
                <td class="seleccion-mod">@if ($alumno->id_opcion_titulacion == 5) &nbsp; X @endif</td>
                <td>III.- Examen General de Certificación Profesional</td>
            </tr>            
            <tr>                
                <td class="seleccion-mod">@if ($alumno->id_opcion_titulacion == 6) &nbsp; X @endif</td>
                <td>IV.- Examen de Capacitación Profesional</td>
            </tr>
            <tr>
                <td rowspan="2">
                    Artículo 11.<br>
                    Producción de Materiales Educativos
                </td>
                <td class="seleccion-mod">@if ($alumno->id_opcion_titulacion == 7) &nbsp; X @endif</td>
                <td>I.- Guías Comentadas o Ilustradas.</td>
            </tr>
            <tr>
                <td class="seleccion-mod">@if ($alumno->id_opcion_titulacion == 8) &nbsp; X @endif</td>
                <td>II.- Paquete Didáctico.</td>
            </tr>
            <tr>
                <td rowspan="5">
                    Artículo 12.<br>
                    Investigación y Estudios 
                    de Posgrado
                </td>
                <td class="seleccion-mod">@if ($alumno->id_opcion_titulacion == 9) &nbsp; X @endif</td>
                <td>I.- Cursos de Maestría o Doctorado en IES de reconocido Prestigio. </td>
            </tr>
            <tr>
                <td class="seleccion-mod">@if ($alumno->id_opcion_titulacion == 10) &nbsp; X @endif</td>
                <td>II.- Trabajo Monográfico de Actualización </td>
            </tr>
            <tr>
                <td class="seleccion-mod">@if ($alumno->id_opcion_titulacion == 11) &nbsp; X @endif</td>
                <td>III.- Seminario de Investigación. </td>
            </tr>
            <tr>
                <td class="seleccion-mod">@if ($alumno->id_opcion_titulacion == 12) &nbsp; X @endif</td>
                <td>IV.- Seminario de Titulación. </td>
            </tr>
            <tr>
                <td class="seleccion-mod">@if ($alumno->id_opcion_titulacion == 13) &nbsp; X @endif</td>
                <td>V.- Diseño o Rediseño de Equipos, Aparatos, Maquinaria, proceso o Sistema de Computación y/o Informática. </td>
            </tr>
            <tr>
                <td rowspan="3">
                    Artículo 14.<br>
                    Tesis, Tesina e Informes
                </td>
                <td class="seleccion-mod">@if ($alumno->id_opcion_titulacion == 14) &nbsp; X @endif</td>
                <td>I.- Tesis</td>
            </tr>
            <tr>
                <td class="seleccion-mod">@if ($alumno->id_opcion_titulacion == 15) &nbsp; X @endif</td>
                <td>II.- Tesina</td>
            </tr>  
            <tr>
                <td class="seleccion-mod">@if ($alumno->id_opcion_titulacion == 16) &nbsp; X @endif</td>
                <td>III.- Informe de Prácticas Profesionales</td>
            </tr>            
        </table>        
        <p> Y han sido designados los profesores: </p>    
        <div class="centrar-profes2">   
            <form>                  
            <input class="cbox2" type="checkbox" @if ($alumno->id_opcion_titulacion >= 13) checked @endif>                 
            <label for="leer">&nbsp;&nbsp;                  
                @if ($alumno->id_opcion_titulacion >= 13)
                    Presidente: {{ $presidente }}, Secretario: {{ $secretario }} y Vocal: {{ $vocal }} del jurado respectivamente.
                @else
                    Presidente, Secretario y Vocal del jurado respectivamente.
                @endif</label><br>                
            <input class="cbox2" type="checkbox"  @if ($alumno->id_opcion_titulacion < 13) checked @endif>
            @if ($alumno->id_opcion_titulacion < 13) <br> @endif                        
            <label for="leer">&nbsp;&nbsp;* Miembros del Comité para realizar la ceremonia.</label>   
                <br>            
            </form>
        </div>               
    </div>   
    
    <div class="pos atentamente-comprobante2 tam-letra">
        <p class="letra14">
            <b>A T E N T A M E N T E</b><br>
            <b>"Piensa y Trabaja”<br></b>
        </p>
        <p>
            “{{$anio}}, Año del fomento a la formación integral con una Red de Centros y Sistemas Multitemáticos”<br>            
            Guadalajara, Jalisco a {{$dia}} de {{$mes}} de {{$anio}}
        </p>
    </div>           
    <div class="pos linea-firma2" style="margin-left: 19%; width: 35%; border-bottom: solid 1px;">&nbsp;&nbsp;&nbsp;</div> 
    <img class="firma-digital2" src="{{ storage_path('app/' . $firma->ruta) }}">    
    <div class="pos coordi ">
        <p>
            {{ $alumno->carrera->coordinador->user->name }}<br>
            Presidente del comité de titulación en {{ $alumno->carrera->carrera}}
        </p> 
        <p class="letra10 cursiva">JLDBC/Ipbc</p> 
    </div>
    
</body>


</html>
