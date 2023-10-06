<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CONSTANCIA DE NO ADEUDO BIBLIOTECA</title>
    <link rel="stylesheet" href="{{public_path('css/formatosGenerados.css')}}" type="text/css">
    
</head>

<body>    
    <div >
        <img class="cabecera-biblioteca" src="{{ public_path("img/formato_biblioteca.png") }}" >
    </div>
    <p class="folio-biblioteca bold letra15"> CUCEI/UDB/CID/1566/2023 </p>     
    <div class="pos-biblioteca datos-biblioteca letra15 interlineado">        
        <p>
            <b>A QUIEN CORRESPONDA:</b><br>
            <i>P R E S E N T E.-</i>
            <br><br><br>
            Por medio de la presente se hace constar que la C. <b>{{$alumno->user->name}}</b> con código <b>{{$alumno->user->codigo}}</b> de la <b>INGENIERÍA EN COMPUTACIÓN</b> no tiene adeudo de material bibliohemerográfico.    
        </p>    
     
    </div>

    <div >
        <img class="sello-biblioteca" src="{{ public_path("img/sello_biblioteca2.png") }}" >
    </div>

    <div class="pos-biblioteca atentamente-biblioteca letra15">
        <p>
            A T E N T A M E N T E<br>
            
            "PIENSA Y TRABAJA”<br>
            “{{$anio}}, Guadalajara, hogar de la Feria Internacional del Libro y Capital Mundial del Libro”<br>
            
            Guadalajara, Jalisco a <b>{{$dia}}</b> de <b>{{$mes}}</b> de <b>{{$anio}}</b>
        </p>
    </div> 
    
    <div class="nombre-biblioteca letra15">
        <p> 
            Lic. Indira Myriam Palomino Núñez <br> 
            Jefe de la Unidad de Desarrollo Bibliotecario
        </p>
    </div>
      
    <div >
        <img class="abajo-biblioteca" src="{{ public_path("img/formato_biblioteca2.png") }}" >
    </div>
</body>


</html>
