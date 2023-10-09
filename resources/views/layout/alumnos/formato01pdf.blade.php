<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FORMATO 01</title>
    <link rel="preload" href="{{asset('css/formato01.css')}}" as="style">
    <link rel="stylesheet" href="{{public_path('css/formato01.css')}}" type="text/css">

</head>

<body>    
    <!-- Imagen de la cabecera -->
    <div >
        <img src="{{ public_path("img/udg.jpg") }}" >
    </div>
    
    <div class="acomodo">                                              
        <p class="formato">FORMATO 01</p>   
        <h5 class="heading">REGISTRO DE LA MODALIDAD Y TRABAJO DE TITULACI&Oacute;N</h5> 
    </div>
    <div class="datos">                        
        <div style="float: left; width: 15%;"><b>Datos Personales del Solicitante</b></div>
        <div style="float: left; width: 40%; border-bottom: solid 1px;">{{$user->name}}</div> 
        <div style="float: left; width: 3%;"></div>         
        <div style="float: left;  width: 13%;"><b>C&oacute;digo: </b></div>  
        <div style="margin-left: 65%; width: 25%; border-bottom: solid 1px;">{{$user->codigo}}</div><br>                   
           
        <div style="text-align:center">
            <p>Atentamente solicito sean aprobados la modalidad y el trabajo de titulación que a continuación indico:</p>
        </div>
    </div> 
    <div class="acomodo">
        <h5 class="articulos">ART&Iacute;CULO 9.- DESEMPEÑO ACAD&Eacute;MICO SOBRESALIENTE</h5>
        <label style="margin-left: 4%;" for="leer">I. Excelencia Acad&eacute;mica&nbsp;&nbsp;</label><input name="excelencia" style="margin-left: 10%; width: 25%;" type="checkbox"
            @if ($user->alumno->id_opcion_titulacion == "1")
            checked> 
            @else >       
            @endif
        <br>
        <label style="margin-left: 4%;" for="leer">II. Titulaci&oacute;n por Promedio&nbsp;&nbsp;</label><input style="margin-left: 7.7%; width: 25%;" type="checkbox"
            @if ($user->alumno->id_opcion_titulacion == "2")
            checked>        
            @else >       
            @endif                  
    </div>
    <div class="acomodo">
        <h5 class="articulos">ART&Iacute;CULO 10.- EX&Aacute;MENES</h5>        
        <label style="margin-left: 4%;" for="leer">I. Examen Global Te&oacute;rico&nbsp;&nbsp;</label><input style="margin-left: 22.3%; width: 25%;" type="checkbox"
            @if ($user->alumno->id_opcion_titulacion == "3")
                checked>        
            @else >       
            @endif  
        <br>
        <label style="margin-left: 4%;" for="leer">II. Examen General de Certificaci&oacute;n Profesional&nbsp;&nbsp;</label><input style="margin-left: 2%; width: 25%;" type="checkbox"
            @if ($user->alumno->id_opcion_titulacion == "4")
                checked>        
            @else >       
            @endif  
        <br>
        <label style="margin-left: 4%;" for="leer">III.	Examen de Capacitaci&oacute;n Profesional &nbsp;&nbsp;</label><input style="margin-left: 8.5%; width: 25%;" type="checkbox"   
            @if ($user->alumno->id_opcion_titulacion == "5")
                checked>        
            @else >       
            @endif  
    </div>
    <div class="acomodo">
        <h5 class="articulos">ART&Iacute;CULO 11.- PRODUCCI&Oacute;N DE MATERIALES EDUCATIVOS</h5>
        <label style="margin-left: 4%;" for="leer">I. Gu&iacute;as Comentadas o Ilustradas&nbsp;&nbsp;</label><input style="margin-left: 2.5%; width: 25%;" type="checkbox"
            @if ($user->alumno->id_opcion_titulacion == "6")
                checked>        
            @else >       
            @endif  
        <br>             
    </div>
    <div class="acomodo">
        <h5 class="articulos">ART&Iacute;CULO 12.- INVESTIGACI&Oacute;N Y ESTUDIOS DE POSGRADO</h5>
        <label style="margin-left: 4%;" for="leer">I. Seminario de Investigaci&oacute;n&nbsp;&nbsp;</label><input style="margin-left: 27.1%; width: 25%;" type="checkbox"
            @if ($user->alumno->id_opcion_titulacion == "8")
                checked>        
            @else >       
            @endif  
        <br><br>        
        <label style="margin-left: 4%; width: 15%;" for="leer">II. Diseño o Rediseño de Equipo, Aparato o Maquinaria&nbsp;&nbsp;</label><input style="margin-left: 3%; width: 25%;" type="checkbox"
            @if ($user->alumno->id_opcion_titulacion == "9")
                checked>        
            @else >       
            @endif                 
    </div>
    <div class="acomodo">                
        <h5 class="articulos">ART&Iacute;CULO 13.- TESIS E INFORMES</h5>
        <label style="margin-left: 4%;" for="leer">I. Tesis&nbsp;&nbsp;</label><input style="margin-left: 5%; width: 25%;" type="checkbox"
            @if ($user->alumno->id_opcion_titulacion == "10")
                    checked>        
                @else >       
                @endif 
        <br><br>                             
        <label style="margin-left: 4%;" for="leer">II. Informes&nbsp;&nbsp;</label><input style="margin-left: 1%; width: 25%;" type="checkbox"
            @if ($user->alumno->id_opcion_titulacion == "11")
                checked>        
            @else >       
            @endif 
        <br><br>                                     
    </div><br>
    <div style="float: left; width: 30%;"><b>T&iacute;tulo del Trabajo a Realizar:</b></div>
    <div style="margin-left: 30%; width: 50%; border-bottom: solid 1px;">&nbsp;&nbsp;</div><br><br>
    <div style="text-align: center;">Agradezco su atenci&oacute;n:</div><br><br><br>

    <div style="float: left; width: 7%;">&nbsp;&nbsp;</div>
    <div style="float: left; width: 35%;border-bottom: solid 1px;">&nbsp;&nbsp;</div>
    <div style="margin-left: 50%; width: 35%; border-bottom: solid 1px;">&nbsp;&nbsp; {{$user->name}}</div><br>
    
    <div style="float: left; width: 8%; ">&nbsp;&nbsp;</div>
    <div style="float: left; width: 38%;font-size: 15px;">Nombre y Firma del Director Propuesto</div>
    <div style="margin-left: 54%; width: 35%; font-size: 15px;">Nombre y Firma del Solicitante</div><br><br>

    <div style="float: left; width: 50%;">&nbsp;</div>
    <div style="float: left; width: 18%;">Guadalajara, Jal., a&nbsp;</div>
    <div style="float: left; width: 2%; border-bottom: solid 1px;">{{$dia}}</div>
    <div style="float: left; width: 4%;">&nbsp;&nbsp;de&nbsp;</div>
    <div style="float: left; width: 10%; border-bottom: solid 1px;">{{$mes}}</div>
    <div style="float: left; width: 5%;">&nbsp;&nbsp;del</div>
    <div style="float: left; width: 5%; border-bottom: solid 1px;">{{$anio}}</div>
    <div style="margin-left: 80%; width: 0%;"></div>
     
</body>


</html>
