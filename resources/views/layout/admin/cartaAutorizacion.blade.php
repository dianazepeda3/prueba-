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

<body>    
    <div >
        <img class="cabecera-carta" src="{{ public_path("img/cartaAtorizacion1.png") }}" >
    </div>
    <p class="acomodo-titulo-carta letra14"> 
        AUTORIZACIÓN PARA PUBLICACIÓN DE DOCUMENTOS DE TITULACIÓN <br><br>
        EN LA BIBLIOTECA DIGITAL DE LA UNIVERSIDAD DE GUADALAJARA
    </p>     
    <div class="pos2 datos2 letra13">        
        <p>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;La Coordinación de Bibliotecas a través de su Biblioteca Digital se ha dado a la tarea de digitalizar y publicar en medios electrónicos obras de producción universitaria tales como tesis, 
            tesinas, libros, revistas, periódicos, etc. Esto con el fin de preservar la información generada por nuestra casa de estudios y difundirla mediante este sitio Web en los cuales estarán disponibles 
            para el beneficio de la comunidad universitaria y público en general, este último a través de la consulta en las bibliotecas universitarias.
        </p>        
        <p>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;En base a este planteamiento, por medio de la presente y de acuerdo a la Ley Federal de Derechos de Autor, la cual especifica en el Título VI de la Ley Federal del Derecho de Autor, 
            Capítulo II de la limitación a los derechos patrimoniales 
            <em class="letra12">Art. 148.- Las obras literarias y artísticas ya divulgadas podrán utilizarse, siempre que no se afecte la explotación normal de la obra, sin autorización del titular del derecho patrimonial y sin 
            remuneración, citando invariablemente la fuente y sin alterar la obra, sólo en los siguientes casos:</em>
        </p>    
        <ol type="I" class="letra12 cursiva">
            <li>Cita de textos. </li>
            <li>Reproducción de partes de la obra, para la crítica e investigación científica, literaria o artística; </li>
            <li>Reproducción por una sola vez, y en un sólo ejemplar, de una obra literaria o artística, para uso personal y privado de quien la hace y sin fines de lucro.
                Las personas morales no podrán valerse de lo dispuesto en esta fracción salvo que se trate de una institución educativa, de investigación, o que no esté dedicada a actividades mercantiles; </li>
            <li>Reproducción de una sola copia, por parte de un archivo o biblioteca, por razones de seguridad y preservación, y que se encuentre agotada, descatalogada y en peligro de desaparecer;</li>
        </ol><br>
        <p>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Haciendo uso de los derechos que la mencionada ley me concede, autorizo a la Biblioteca Digital de la Universidad de Guadalajara a hacer uso del material que a continuación se detalla con la única condición de que se respete íntegramente el contenido del mismo 
            y de que se aplique en beneficio de la Comunidad Universitaria. <br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Esta autorización incluye el cambio al formato digital, así como el uso de este material en los sistemas informáticos de la mencionada institución, la reproducción con fines no lucrativos y otros afines, impidiendo explícitamente las reproducciones con fines 
            lucrativos en cualquier medio de difusión.
        </p>
    </div>
    <div class="pos2 datos-material letra12">
        <div class="center bold">DATOS DEL MATERIAL A PUBLICAR</div>
        <p>   
            Tipo de documento:            
            <input class="cbox3" type="checkbox" @if ($alumno->id_opcion_titulacion == 14) checked @endif>                 
            <label for="leer">Tesis</label>               
            <input class="cbox3" type="checkbox"  @if ($alumno->id_opcion_titulacion == 15) checked @endif>                              
            <label for="leer">Tesina</label> 
            <input class="cbox3" type="checkbox"  @if ($alumno->id_opcion_titulacion == 16) checked @endif>                              
            <label for="leer">Reporte de prácticas profesionales</label> 
            <input class="cbox3" type="checkbox">                              
            <label for="leer">Otro (especificar)</label></p><p>           
                             
            Título de la Tesis, Tesina o Reporte: <b>{{ $alumno->titulo_del_trabajo }}</b><br><br>        
            Autor(es): <b>{{ $alumno->autores }}</b> <br><br>
            Fecha de titulación: <b>{{ $fecha_titulacion }}</b><br>
            Título obtenido:  <b>{{ $titulo }}</b><br>
            Escuela, Facultad o Centro Universitario: <b>Centro Universitario de Ciencias Exactas e Ingenierías</b><br>
            <div class="center bold">AUTORIZÓ</div>
            Nombre completo de autor: <b>{{ $alumno->user->name }}</b>  <br>
            Dirección: <b>{{ $domicilio }}</b><br>
            Teléfono: <b>{{ $alumno->telefono_celular }}</b><br>
            Email: <b>{{ $alumno->correo_institucional }}</b><br>
            Firma: 
        </p>
    </div>
    <div class="pos linea-tipo-otro" style="margin-left: 65%; width: 10%; border-bottom: solid 0.7px;">&nbsp;&nbsp;&nbsp;</div>              
    <div class="pos linea-titulo-tesis" style="margin-left: 25%; width: 48%; border-bottom: solid 0.7px;">&nbsp;&nbsp;&nbsp;</div> 
    <div class="pos linea-titulo-tesis2" style="margin-left: 4%; width: 69%; border-bottom: solid 0.7px;">&nbsp;&nbsp;&nbsp;</div> 
    <div class="pos linea-autores" style="margin-left: 10%; width: 63%; border-bottom: solid 0.7px;">&nbsp;&nbsp;&nbsp;</div> 
    <div class="pos linea-autores2" style="margin-left: 4%; width: 69%; border-bottom: solid 0.7px;">&nbsp;&nbsp;&nbsp;</div> 
    <div class="pos linea-fecha-titulacion" style="margin-left: 15%; width: 58%; border-bottom: solid 0.7px;">&nbsp;&nbsp;&nbsp;</div> 
    <div class="pos linea-titulo" style="margin-left: 13%; width: 60%; border-bottom: solid 0.7px;">&nbsp;&nbsp;&nbsp;</div> 
    <div class="pos linea-centro" style="margin-left: 28%; width: 45%; border-bottom: solid 0.7px;">&nbsp;&nbsp;&nbsp;</div> 
    <div class="pos linea-autor" style="margin-left: 20%; width: 53%; border-bottom: solid 0.7px;">&nbsp;&nbsp;&nbsp;</div> 
    <div class="pos linea-direccion" style="margin-left: 10%; width: 63%; border-bottom: solid 0.7px;">&nbsp;&nbsp;&nbsp;</div> 
    <div class="pos linea-telefono" style="margin-left: 9.7%; width: 63.3%; border-bottom: solid 0.7px;">&nbsp;&nbsp;&nbsp;</div> 
    <div class="pos linea-email" style="margin-left: 7.5%; width: 65.5%; border-bottom: solid 0.7px;">&nbsp;&nbsp;&nbsp;</div> 
    <div class="pos linea-firma-carta" style="margin-left: 8%; width: 20%; border-bottom: solid 0.7px;">&nbsp;&nbsp;&nbsp;</div> 
    <img class="firma-digital-carta" src="{{ storage_path('app/' . $firma->ruta) }}"><br>  
    <div >
        <img class="abajo-carta" src="{{ public_path("img/cartaAtorizacion2.png") }}" >
    </div>
</body>


</html>
