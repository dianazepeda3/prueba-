<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>KARDEX</title>
    <link rel="preload" href="{{asset('css/kardex.css')}}" as="style">
    <link rel="stylesheet" href="{{public_path('css/kardex.css')}}" type="text/css">

</head>

<body>    
    <!-- Imagen de la cabecera -->

    <p>
        <img align="left" src="{{ public_path("img/logo.jpg") }}" > <br>                              
        <h1 class="heading">Kardex del estudiante</h1> 
    </p>
    
   <div class="tabla">
        <table id="datos">
            <tr class="titulo-tabla">
                <th  colspan="4">DATOS DEL ESTUDIANTE</th>
            </tr>
       
            <tr>
                <th >Código: </th><td>{{$cod["codigo"]}}</td>
                <th>Nombre: </th><td>{{$cod["nombre"]." ".$cod["apellido"]}}</td>                    
            </tr>
            <tr>
                <th>Situación: </th>
                <td>
                    @if ($cod["situacion"] == "AC")
                    ACTIVO
                    @endif
                </td>
                <th>Último ciclo: </th><td>{{$cod["ultimo_cicloDesc"]}}</td>
            </tr>
            <tr>
                <th>Carrera: </th>                
                <td colspan="3">
                    @if ($cod["carrera"] == "INCO")
                        INGENIERÍA EN COMPUTACIÓN
                    @endif
                    ({{$cod["carrera"]}})
                </td>
            </tr>
            <tr>
                <th>Centro: </th>
                <td colspan="3">
                    @if ($cod["campus"] == "CUCEI")
                    CENTRO UNIVERSITARIO DE CIENCIAS EXACTAS E INGENIERIAS
                @endif
                </td>              
            </tr>
        </table>
        <table id="tab-promedio" align="right">
            <tr>
                <th>Promedio: </th>
                <td>{{$promedio["promedio"]}}</td>
                <th>Créditos: </th>
                <td>{{$promedio["creditosAdquiridos"]}}</td>
            </tr>
            <tr>
                <th>Fecha: </th>
                <td colspan="3">{{$mes ." ". $dia . " de ". $anio}}</td>
            </tr>
        </table><br>

        <table  id="datos">
            <?php $rec = 1?>
            @for ($i=1; $i<=$ciclos; $i++)
                <tr class="titulo-tabla">
                    <th  colspan="7">CALENDARIO &nbsp;{{$materias[$rec]["ciclo"]}}</th>
                </tr>
                <tr>
                    <th>NRC</th>
                    <th>Clave</th>
                    <th>Nombre de la Materia</th>
                    <th>Calificación</th>
                    <th>Tipo</th>
                    <th>NC</th>
                    <th>Fecha</th> 
                </tr>                
                
                @for ($j=0; $j<$num_materias[$i-1]; $j++)                    
                    <tr>
                        @if($materias[$rec]["tipo"] == "EXTRAORDINARIO (E)")
                            <td colspan="3">&nbsp;</td>
                        @else
                            <!--style="text-decoration: underline; color:blue"-->
                            <td class="nrc">{{$materias[$rec]["nrc"]}}</td>
                            <td class="nrc">{{$materias[$rec]["clave"]}}</td>
                            <td style="color:#08457E;">{{$materias[$rec]["descripcion"]}}</td>  
                        @endif                      
                        @if($materias[$rec]["calificacion"] == "0(SIN DERECHO)")
                            <td style="color: red;">{{"SD (SIN DERECHO)"}}</td>
                        @else
                            <td>{{$materias[$rec]["calificacion"]}}</td>
                        @endif                        
                        <td>{{$materias[$rec]["tipo"]}}</td>
                        @if($materias[$rec]["calificacion"] == "0(SIN DERECHO)")
                            <td>{{0}}</td>
                        @else
                            <td>{{$materias[$rec]["creditos"]}}</td>
                        @endif                        
                        <td>{{date("d/m/Y",strtotime($materias[$rec]["fecha"]))}}</td>
                    </tr>  
                    <?php $rec++?>                  
                @endfor
                <tr><td colspan="7">&nbsp;</td></tr>
            @endfor 
                           
        </table><br>
        <table id="datos">
            <tr class="titulo-tabla">
                <th  colspan="4">Resumen de créditos del alumno por área de estudios</th>
            </tr>
            <tr>
                <th>CREDITOS REQUERIDOS DEL PROGRAMA:</th>
                <td>{{$creditos_requeridos}}</td>                
                <th rowspan="2">CREDITOS FALTANTES</th>
                <td rowspan="2" style="color: white; background-color: rgb(113, 166, 210); font-weight: bold;
            }">{{$creditos_faltantes}}</td>
            </tr>
            <tr>
                <th>CREDITOS ADQUIRIDOS TOTALES:</th>
                <td>{{$promedio["creditosAdquiridos"]}}</td>
            </tr>
            <tr class="titulo-tabla">
                <th>Area</th>
                <th>Requeridos</th>
                <th>Adquiridos</th>
                <th>Diferencia</th>
            </tr>
            <tr>
                <th>ESPECIALIZANTE OBLIGATORIA</th>
                <td>{{$especializantes_obl["creditosRequeridos"]}}</td>                
                <td>{{$especializantes_obl["creditosAdquiridos"]}}</td>
                <td>{{$especializantes_obl["diferencia"]}}</td> 
            </tr>
            <tr>
                <th>ESPECIALIZANTE SELECTIVA</th>
                <td>{{$especializantes_sel["creditosRequeridos"]}}</td>                
                <td>{{$especializantes_sel["creditosAdquiridos"]}}</td>
                <td>{{$especializantes_sel["diferencia"]}}</td> 
            </tr>
            <tr>
                <th>OPTATIVA ABIERTA</th>
                <td>{{$optativas["creditosRequeridos"]}}</td>                
                <td>{{$optativas["creditosAdquiridos"]}}</td>
                <td>{{$optativas["diferencia"]}}</td>
            </tr>
            <tr>
                <th>BASICO COMUN</th>
                <td>{{$basico_comun["creditosRequeridos"]}}</td>                
                <td>{{$basico_comun["creditosAdquiridos"]}}</td>
                <td>{{$basico_comun["diferencia"]}}</td>
            </tr>
            <tr>
                <th>BASICA PARTICULAR</th>
                <td>{{$basica_particular["creditosRequeridos"]}}</td>                
                <td>{{$basica_particular["creditosAdquiridos"]}}</td>
                <td>{{$basica_particular["diferencia"]}}</td>
            </tr>            
        </table>

   </div>

   
     
</body>


</html>
