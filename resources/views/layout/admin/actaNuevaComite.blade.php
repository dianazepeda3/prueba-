<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ACTA DE TITULACIÓN</title>
    <link rel="preload" href="{{asset('css/formato01.css')}}" as="style">
    <link rel="stylesheet" href="{{public_path('css/actaTitulacion.css')}}" type="text/css">

</head>

<body class="fondo">    
            
    <p class="acomodo-titulo bold"> ACTA DE TITULACIÓN</p>     
    <table class="table1">
        <tr>
            <td>FECHA DE EXPEDICIÓN</td>
            <td>LIBRO</td>
            <td>NÚMERO DE ACTA</td>
        </tr>
        <tr>
            <th>{{ $fecha_titulacion }}</th>
            <th>001</th>
            <th>{{ $num_acta }}</th>
        </tr>       
    </table><br>
    <table class="table2">
        <tr>
            <td colspan="2">LUGAR</td>
        </tr>
        <tr>
            <th colspan="2">Guadalajara, Jalisco</th>
        </tr>       
    </table><br>
    <div  class="pos top27">
        <p>Siendo las {{ $hora_actual }} horas, en la ciudad de Guadalajara, Jalisco y con fundamento en el Artículo 
            @if($alumno->id_opcion_titulacion == 1 || $alumno->id_opcion_titulacion == 2)
                18 
            @else
                29
            @endif 
            del Reglamento General de Titulación de la Universidad de Guadalajara, se reunió el siguiente personal académico:            
        </p>
    </div>
    <div class="pos top31">
        <p>
            @if($alumno->id_opcion_titulacion == 1 || $alumno->id_opcion_titulacion == 2)
                Presidente(a) del Comité de Titulación<br>
                Integrante del Comité de Titulación<br>
                Integrante del Comité de Titulación<br>
                <!--Integrante del Comité de Titulación-->
            @else
                Presidente del Jurado<br>
                Secretario del Jurado<br>
                Vocal del Jurado<br>
            @endif
        </p>
    </div>
    <div class="pos top31b">
        <p>
           {{ $presidente }}<br>
           {{ $secretario }}<br>
           {{ $vocal }}<br>
           <!--@if($alumno->id_opcion_titulacion == 1 || $alumno->id_opcion_titulacion == 2)
                Integrante 
           @endif-->
        </p>
    </div>
    <div  >
        <p class="pos top40">Como 
            @if($alumno->id_opcion_titulacion == 1 || $alumno->id_opcion_titulacion == 2)
                miembros del 
            @else
                integrantes del Jurado designado por el 
            @endif
             Comité de Titulación del plan de estudios:
        </p>
        <p class="pos top40b">{{ $carrera }}</p>
        <p class="pos top44">con el objetivo de verificar que quien sustenta:</p>
        <p class="pos top44b">{{ $alumno->user->name }}</p>
        <p class="pos top48">
            con código: <b>{{ $alumno->user->codigo }}</b><br>
            cubra los requisitos establecidos en el Reglamento General de Titulación y del Reglamento Particular de 
            Titulación del <b>Centro Universitario de Ciencias Exactas e Ingenierías</b><br>
            para titularse bajo la modalidad: <b>{{ $modalidad }}</b><br>
            con la opción específica: <b>{{ $opcion_tit }}</b><br>
            @if($alumno->id_opcion_titulacion != 1 && $alumno->id_opcion_titulacion != 2)
                con el nombre: <b>"{{$titulo_trabajo}}"</b><br>         
            @endif
            en la que se consideró que	<b>APROBÓ</b><br>
            con la calificación 
            @if($alumno->id_opcion_titulacion == 1 || $alumno->id_opcion_titulacion == 2)
                (o promedio) 
            @endif
            : <b>{{ $promedio }}</b><br>
            @if($alumno->id_opcion_titulacion != 1 && $alumno->id_opcion_titulacion != 2)
                Fungiendo como Director de Titulación:	<b>Mtro. nombre</b>         
            @endif
            <br>
            A continuación, quien preside el Jurado, procedió a tomar protesta de quien sustenta, en los siguientes términos: 
            “¿Protesta usted ejercer la profesión con honradez, consagrar su ejercicio al bien de la colectividad, velando 
            siempre por el buen nombre de la Universidad de Guadalajara?”. A lo que contestó: “Sí, protesto”. Acto seguido, 
            quien preside este Comité añadió: “Si así lo hiciere su conciencia y la colectividad se lo premien y si no, se 
            lo demanden”. Por lo que se dio por concluido el acto, levantándose la presente para constancia, que firman las 
            autoridades correspondientes y quien lo sustenta, acorde al numeral VI y VIII del artículo 30 del Reglamento 
            General de Titulación de esta Institución.
        </p>
    </div>

    
    @if($alumno->id_opcion_titulacion == 1 || $alumno->id_opcion_titulacion == 2)
        <div class="pos top65 foto-titulacion"></div>
        <div class="pos top67"><p>Por el Comité de Titulación</p></div>
        <div class="pos top80"><p>Autorizan</p></div>
        <div class="pos presidente">        
            <p class="firma">
                <b>{{ $presidente }}</b><br>
                Presidente(a) del Comité de Titulación
            </p>         
        </div>
        <div class="pos integrante">
            <p class="firma">
                <b>{{ $secretario }}</b><br>
                Integrante del Comité de Titulación
            </p>         
        </div>
        <div class="pos directora">        
            <p class="firma">
                <b>Dra. Alma Yolanda Alanís García</b><br>
                 Directora de la División de Tecnologías para la Integración Ciber-Humana
            </p>         
        </div> 
        <div class="pos secretario">        
            <p class="firma">
                <b>Mtro. Eduardo Méndez Palos</b><br>
                Secretario de División de la División de Tecnologías para la Integración Ciber-Humana
            </p>         
        </div> 
        <div class="pos sustentante">        
            <p class="firma">
                <b>{{ $alumno->user->name }}</b><br>
                SUSTENTATE
            </p>         
        </div>  
    @else
        <div class="pos top65b foto-titulacion"></div>
        <div class="pos top67b"><p>Por el Jurado de Titulación</p></div>
        <div class="pos top80b"><p>Autorizan</p></div>
        <div class="pos presidente2">        
            <p class="firma">
                <b>{{ $presidente }}</b><br>
                Presidente del Jurado
            </p>         
        </div>
        <div class="pos integrante2">
            <p class="firma">
                <b>{{ $secretario }}</b><br>
                Secretario del Jurado
            </p>         
        </div>
        <div class="pos directora2">        
            <p class="firma">
                <b>{{ $presidente }}</b><br>
                 Directora de la División de Tecnologías para la Integración Ciber-Humana
            </p>         
        </div> 
        <div class="pos secretario2">        
            <p class="firma">
                <b>{{ $secretario }}</b><br>
                Secretario de División de la División de Tecnologías para la Integración Ciber-Humana
            </p>         
        </div> 
        <div class="pos sustentante2">        
            <p class="firma">
                <b>{{ $alumno->user->name }}</b><br>
                SUSTENTATE
            </p>         
        </div>  
    @endif      
    
    <!--<img class="firma-digital-dictamen" src="{{ storage_path('app/' ) }}">   -->               
</body>


</html>
