<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\PDF;
use App\Mail\NotificacionTramiteMail;
use App\Models\User;
use App\Models\Alumno;
use App\Models\Maestro;
use App\Models\Tramite;
use App\Models\Documento;
use App\Models\Carrera;
use App\Models\PlanEstudios;
use App\Models\Articulo;
use App\Models\OpcionTitulacion;
use App\Models\AlumnoDocs;
use App\Models\Firma;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function tramites() {
        $user = Auth::user();
        $tramites = Tramite::all();   
        $alumnos = Alumno::all();
        return view('admin/tramites', compact('user','tramites','alumnos'));
    }

    public function verTramite(Alumno $alumno){
        $user = Auth::user();
        $tramite = $alumno->tramite;
        $documentos = Documento::where('tramite_id', $tramite->id)->get();
        $alumnoDocs = $alumno->alumno_docs;
        
        $aprobados = true;               
        foreach($documentos as $documento){
            if ($documento->aprobado == 2 || $documento->aprobado == 3 || $documento->aprobado == 6 || $documento->aprobado == 7){                
                $aprobados = false;
            }            
        }                              

        $revisados = true;
        foreach($documentos as $documento){
            if ($documento->aprobado == 3 || $documento->aprobado == 7){                
                $revisados = false;
            }
        }                        
        $maestros = Maestro::all();
        
        return view('admin/showTramite', compact('user','tramite', 'alumno', 'documentos', 'maestros', 'aprobados','alumnoDocs', 'revisados'));
    }

    public function editDatosPersonales(Alumno $alumno){
        $user = Auth::user();
        return view('admin/datos-pesonales-form', compact('user','alumno'));
    }

    public function editDatosEscolares(Alumno $alumno){
        $user = Auth::user();
        $carreras = Carrera::all();
        $plan_estudios = PlanEstudios::all();
        $articulos = Articulo::all();
        $opciones_titulacion = OpcionTitulacion::all();
        return view('admin/datos-escolares-form', compact('user','alumno','carreras','plan_estudios','articulos','opciones_titulacion'));
    }

    public function updateDatosEscolares(Request $request, Alumno $alumno){  
        if(!Gate::allows('alumno')){
            //Validacion de campos
            $request->validate([  
                'nombre' => 'required|string',
                'codigo' =>'required|digits:9|numeric',                                  
                'carrera' => 'required|string',
                'promedio' =>'required|numeric',   
                /*'situacion' => 'required|string',*/
                'ciclo_ingreso' => 'required|string',
                'ciclo_egreso' => 'required|string',                      
            ]);  
        }      
         //Validacion de campos
         $request->validate([                
            'articulo' => 'required|numeric|min:1',
            'opciones_titulacion' => 'required|numeric|min:1',                  
            'plan_estudios' => 'required|numeric|min:1',
            
        ]);          
        if($request->id_opcion_titulacion == 7 || $request->id_opcion_titulacion == 11 || $request->id_opcion_titulacion == 13|| $request->id_opcion_titulacion == 14|| $request->id_opcion_titulacion == 15|| $request->id_opcion_titulacion == 16){
            $request->validate([
                'nombre_del_trabajo' => 'nullable|string',                              
            ]); 
            /*if($request->id_opcion_titulacion == 13){
                $request->validate([
                    'ganador_proyecto' => 'nullable|string',                              
                ]);            
            } */          
        }      

        if (!Gate::allows('alumno') && $request->carrera == 0) {
            return redirect()->back()->with('info', 'Selecciona la carrera');
        }
        
        //dd($request);
        // COMPROBACIONES MODALIDAD DESEMPEÑO ACADEMICO       
        //Excelencia
        if (Gate::allows('alumno')){
            if($request->opciones_titulacion == 1 && $alumno->promedio < 95)
                return redirect()->back()->with('info', 'Para elegir esta modalidad necesitas un promedio global mínimo de 95 (noventa y cinco)');        
            //Promedio
            if($request->opciones_titulacion == 2 && $alumno->promedio < 90)
                return redirect()->back()->with('info', 'Para elegir esta modalidad necesitas un promedio global mínimo de 90 (noventa)');            
        }else{
            if($request->opciones_titulacion == 1 && $request->promedio < 95)
                return redirect()->back()->with('info', 'Para elegir esta modalidad necesitas un promedio global mínimo de 95 (noventa y cinco)');        
            //Promedio
            if($request->opciones_titulacion == 2 && $request->promedio < 90)
                return redirect()->back()->with('info', 'Para elegir esta modalidad necesitas un promedio global mínimo de 90 (noventa)');                    
        } 
        
        if(!Gate::allows('alumno')){
            $user = $alumno->user;
            try{
                $user->name = $request->nombre;
                $user->codigo = $request->codigo;
                $user->save();
            }catch(Exception $e){
                return redirect()->back()->with('info', 'Ya existe un alumno con ese código');
            }
            $alumno->id_carrera = $request->carrera;
            $alumno->promedio = $request->promedio;
            $alumno->ciclo_ingreso = $request->ciclo_ingreso;
            $alumno->ciclo_egreso = $request->ciclo_egreso;
        }

        if($request->ganador_proyecto == "SI"){
            $alumno->ganador_proyecto_modular = 1;
        }else{
            $alumno->ganador_proyecto_modular = 0;
        }
                        
        $alumno->id_articulo = $request->articulo;
        $alumno->id_plan_estudios = $request->plan_estudios; 
        $alumno->id_opcion_titulacion = $request->opciones_titulacion;
        $alumno->titulo_del_trabajo = $request->nombre_del_trabajo;

        $alumno->save();

        if(Gate::allows('alumno')){
            return redirect()->route('show-datos',$alumno)->with('success','Información Escolar actualizada');    
        }

        return redirect()->back()->with('success','Información Escolar actualizada');
    }

    public function updateDatosPersonales(Request $request, Alumno $alumno){
        //Validacion de campos
        $request->validate([                               
            'fecha_nacimiento' => 'required|date|before:today|after:1900-01-01',                   
            'estado_nacimiento' => 'required|string',            
            'municipio_nacimiento' => 'required|string',
            'estado_civil' => 'required|string', 
            'genero' => 'required|string',
            'telefono_celular' => 'required|numeric|digits:10',
            'telefono_particular' => 'nullable|numeric|digits:10',            

            'domicilio_calle' => 'required|string',
            'domicilio_numero' => 'required|numeric',
            'domicilio_colonia' => 'required|string',
            'domicilio_cp' => 'required|numeric|digits:5',
            'domicilio_estado' => 'required|string',
            'domicilio_municipio' => 'required|string',
            
            'correo_institucional' => 'required|regex:/(.+)@(alumnos)\.(udg)\.(mx)/i',
            'correo_particular' => 'required|regex:/(.+)@(.+)\.(.+)/i',                       
        ]);                     
       
        $alumno->fecha_nacimiento = $request->fecha_nacimiento;
        $alumno->genero = $request->genero;
        $alumno->telefono_celular= $request->telefono_celular;
        $alumno->telefono_particular = $request->telefono_particular;
        $alumno->correo_institucional = $request->correo_institucional;
        $alumno->correo_part = $request->correo_particular;
        $alumno->estado_civil = $request->estado_civil;
        $alumno->estado_nacimiento = $request->estado_nacimiento;
        $alumno->municipio_nacimiento = $request->municipio_nacimiento;
        $alumno->dom_calle = $request->domicilio_calle;
        $alumno->dom_numero = $request->domicilio_numero;
        $alumno->dom_colonia = $request->domicilio_colonia;
        $alumno->dom_CP = $request->domicilio_cp;
        $alumno->dom_municipio = $request->domicilio_municipio;
        $alumno->dom_estado = $request->domicilio_estado;

        $alumno->save();

        if(Gate::allows('alumno')){
            return redirect()->route('show-datos',$alumno)->with('success','Información Personal actualizada');    
        }

        return redirect()->route('showTramite',$alumno)->with('success','Información Personal actualizada');
   }

    public function updateDatosLaborales(Request $request, Alumno $alumno){
        if($request->trabaja == "NO"){
            $alumno->trabaja = 0;
        }elseif($request->trabaja == "SI" && $request->afin == "SI"){
            $alumno->trabaja = 1;
            $alumno->afin = 1;
            //Validacion de campos
            $request->validate([                                                
                'nombre_empresa' => 'required|string',
                'sueldo_mensual' => 'required|numeric',     
                'empresa_calle' => 'nullable|string',
                'empresa_numero' => 'nullable|numeric',
                'empresa_colonia' => 'nullable|string',
                'empresa_CP' => 'nullable|numeric|digits:5',
                'empresa_estado' => 'nullable|string',
                'empresa_municipio' => 'nullable|string',
                'telefono_empresa' => 'required|numeric|digits:10',          
            ]); 
        }elseif($request->trabaja == "SI" && $request->afin == "NO"){
            $alumno->trabaja = 1;
            $alumno->afin = 0;
            //Validacion de campos
            $request->validate([                                                
                'descripcion' => 'required|string',                          
            ]);
        }
                            
        // Datos Laborales       
        if($alumno->afin){
            $alumno->nombre_empresa = $request->nombre_empresa;
            $alumno->puesto = $request->puesto;
            $alumno->sueldo_mensual = $request->sueldo_mensual;
            $alumno->empresa_calle = $request->empresa_calle;
            $alumno->empresa_numero = $request->empresa_numero;
            $alumno->empresa_colonia = $request->empresa_colonia;
            $alumno->empresa_CP = $request->empresa_CP;
            $alumno->empresa_municipio = $request->empresa_municipio;
            $alumno->empresa_estado = $request->empresa_estado;
            $alumno->tel_empresa = $request->telefono_empresa;
            $alumno->descripcion = null;
        }else{
            $alumno->descripcion = $request->descripcion;
            $alumno->nombre_empresa = null;
            $alumno->puesto = null;
            $alumno->sueldo_mensual = null;
            $alumno->empresa_calle = null;
            $alumno->empresa_numero = null;
            $alumno->empresa_colonia = null;
            $alumno->empresa_CP = null;
            $alumno->empresa_municipio = null;
            $alumno->empresa_estado = null;
            $alumno->tel_empresa = null;
        }       

        $alumno->save();

        if(Gate::allows('alumno')){
            return redirect()->route('show-datos',$alumno)->with('success','Información Laboral actualizada');    
        }
        
        return redirect()->route('showTramite',$alumno)->with('success','Información Laboral actualizada');
    }

    public function editDatosLaborales(Alumno $alumno){
        $user = Auth::user();
        return view('admin/datos-laborales-form', compact('user','alumno'));
    }

    public function aprobarDocumento(Documento $documento)
    {                
        $tramite = Tramite::find($documento->tramite_id);        
        if($tramite->estado == 7){
            Documento::where('id', $documento->id)->update(['aprobado' => 5]);
        }else{
            Documento::where('id', $documento->id)->update(['aprobado' => 1]);
        }
        
        return redirect()->route('showTramite', $tramite)->with('success', 'Documento "'. $documento->nombre_documento . '" Aprobado');
    }

    public function desaprobarDocumento(Request $request, Documento $documento)
    {                
        //VALIDACION
        $request->validate([
            'comentario' => 'required|string',
        ]);
        $tramite = Tramite::find($documento->tramite_id);
        if($tramite->estado == 5){
            Documento::where('id', $documento->id)->update(['aprobado' => 6]);
            Documento::where('id', $documento->id)->update(['comentario' => $request->comentario]);
        }else{
            Documento::where('id', $documento->id)->update(['aprobado' => 2]);
            Documento::where('id', $documento->id)->update(['comentario' => $request->comentario]);
        }
        return redirect()->route('showTramite', $tramite)->with('success', 'Documento "'. $documento->nombre_documento . '" No Aprobado');
    }

    public function revisarDocumento(Tramite $tramite){
        $alumno = $tramite->alumno;
        //Estado - Documentos Entregados
        if($tramite->estado == 7){
            //Estado - Documentos No Aprobados
            Tramite::where('id', $tramite->id)->update(['estado' => 9]);
            AlumnoDocs::where('alumno_id', $tramite->alumno->id)->update(['validado' => 4]);
        }else{
            //Estado - Documentos No Aprobados
            Tramite::where('id', $tramite->id)->update(['estado' => 5]);
            AlumnoDocs::where('alumno_id', $tramite->alumno->id)->update(['validado' => 2]);
        }
        Tramite::where('id', $tramite->id)->update(['error' => null]);
        
        //Enviar correo de notificacion
        $details = [
            'title' => 'Documentos Revisados',
            'alumno' => $alumno->user->name,
            'body' => "Le informamos que sus documentos han sido revisados y requieren correcciones. Le invitamos a acceder a la plataforma para realizar las modificaciones necesarias.",                                   
        ];

        try{
            Mail::to($alumno->correo_institucional)->send(new NotificacionTramiteMail($details));
        } catch (\Exception $e) {     
            return redirect()->route('showTramite', $alumno)->with('info', 'Documentos validados correctamente. No se pudo enviar el correo.');
        }

        return redirect()->route('showTramite', $alumno)->with('success', 'Documentos revisados.');
    }

    public function validarDocumento(Tramite $tramite){
        $alumno = $tramite->alumno;
        //Estado - Documentos Entregados
        if($tramite->estado == 7){
            //Estado - Documentos validados
            Tramite::where('id', $tramite->id)->update(['estado' => 8]);            

            /*Enviar correo de notificacion*/
            $details = [
                'title' => 'Documentos Validados',
                'alumno' => $alumno->user->name,
                'body' => "Le informamos que sus documentos han sido validados de manera satisfactoria. Ahora puede proceder con el siguiente paso en el proceso de titulación con su división.",
            ];

            try{
                Mail::to($alumno->correo_institucional)->send(new NotificacionTramiteMail($details));
            } catch (\Exception $e) {
                echo $e;
                dd();
                return redirect()->route('showTramite', $alumno)->with('info', 'Documentos validados correctamente. No se pudo enviar el correo.');
            }
        }else{
            //Estado - Documentos Validados
            Tramite::where('id', $tramite->id)->update(['estado' => 4]);
        }
        Tramite::where('id', $tramite->id)->update(['error' => null]);        

        return redirect()->route('showTramite', $alumno)->with('success', 'Documentos validados correctamente.');
    }

    public function generate_dictamen(Request $request, Tramite $tramite){            
        //alumno       
        $alumno =  $tramite->alumno;        
        $modalidad = $alumno->id_opcion_titulacion;
        $time = Carbon::now();          
        //$name = auth()->user()->id .'_'. auth()->user()->name;
        $firma = Firma::where('user_id', auth()->user()->id)->first();       
        if(!isset($firma)) {
            return redirect()->route('tramites')->with('info', 'No tiene firma guardada');
        } 
        
        $dia = $time->format('d');
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");        
        $mes = $meses[($time->format('n')) - 1];
        $anio= $time->format('Y');  
        
        $maestros = Maestro::all();
        
        //Si hay comite_titulacion en el request
        if($request->comite_titulacion != null){
            try{                
                $presidente = Maestro::where('is_presidente_comite', $alumno->id_carrera)->first();
                $secretario = Maestro::where('is_secretario_comite', $alumno->id_carrera)->first();
                $vocal = Maestro::where('is_vocal_comite', $alumno->id_carrera)->first();

                $alumno->id_maestro_presidente = $presidente->id;
                $alumno->nombre_presidente = $presidente->nombre;

                $alumno->id_maestro_secretario = $secretario->id;
                $alumno->nombre_secretario = $secretario->nombre;

                $alumno->id_maestro_vocal = $vocal->id;
                $alumno->nombre_vocal = $vocal->nombre;
            }catch(Exception $e){
                return redirect()->route('admin.dashboard')->with('info', 'No se encontraron los maestros para el comite de titulacion');
            }

        }else{
            if($request->presidente !=null){
                //buscar presidente
                $presidente = Maestro::where('id', $request->presidente)->first();
                $alumno->id_maestro_presidente = $presidente->id;
                $alumno->nombre_presidente = $presidente->nombre;
            }
            if($request->secretario !=null){
                //buscar secretario
                $secretario = Maestro::where('id', $request->secretario)->first();

                $alumno->id_maestro_secretario = $secretario->id;
                $alumno->nombre_secretario = $secretario->nombre;

            }
            if($request->vocal !=null){
                //buscar vocal
                $vocal = Maestro::where('id', $request->vocal)->first();

                $alumno->id_maestro_vocal = $vocal->id;
                $alumno->nombre_vocal = $vocal->nombre;
            }
        }
        //buscar director de division
        $director_division = Maestro::where('is_director_division', '1')->first();
        $secretario_division = Maestro::where('is_secretario_division', '1')->first();

        //actualizamos los datos
               
        //$alumno->fecha_limite = $request->fecha_limite;
        $alumno->numero_de_consecutivo = $request->numero_de_consecutivo;
        $alumno->anio_graduacion = $request->anio_graduacion;
        $alumno->consecutivo = $alumno->numero_de_consecutivo . "/" . $alumno->anio_graduacion;
        $alumno->titulo_del_trabajo = $request->titulo_del_trabajo;        

        $alumno->id_director_division = $director_division->id;        
        $alumno->nombre_director_division = $director_division->nombre;
        
        $alumno->id_secretario_division = $secretario_division->id;
        
        $alumno->nombre_secretario_division = $secretario_division->nombre;        

        $alumno->save();        

        // Divide el valor en un arreglo usando el carácter "-"
        /*$partes = explode('-', $request->fecha_limite);

        // La primera parte es el año (index 0) y la segunda es el mes (index 1)
        $anio_limite = $partes[0];
        $mes_limite = $partes[1];*/        

        //buscas la carrera y el plan de estudio del alumno
        $carrera = $alumno->id_carrera;
        $plan = $alumno->id_plan_estudios;    

        $firma = Firma::where('user_id', auth()->user()->id)->first();   
        $time = Carbon::now();          
        //$name = auth()->user()->id .'_'. auth()->user()->name;            
        $modalidad = $alumno->id_opcion_titulacion;
        $dia = $time->format('d');
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");        
        $mes = $meses[($time->format('n')) - 1];     
        //$mes_limite = $meses[$mes_limite - 1];   
        $anio= $time->format('Y');  

        if($alumno->id_opcion_titulacion >= 13){
            $presidente = $this->retornarMaestroGrado($alumno->id_maestro_presidente);
            $secretario = $this->retornarMaestroGrado($alumno->id_maestro_secretario);
            $vocal = $this->retornarMaestroGrado($alumno->id_maestro_vocal);    
        }else{
            $presidente="";
            $secretario="";
            $vocal="";
        }  
         
        $pdf = PDF::loadView('layout.admin.dictamenEvaluacion2', compact('firma','alumno','dia','mes','anio','modalidad','presidente','secretario','vocal'/*,'anio_limite','mes_limite'*/));
        $pdf->setPaper('letter');        
        //return $pdf->stream();
        
        $tramite = $alumno->tramite;
        $nombre = (string)$alumno->user_id;
        $nombre_ruta =  $nombre . "_" . $alumno->user->name;
        $ruta = 'alumnos/' . $nombre_ruta . '/documentos/dictamen.pdf';                           

        //GUARDA DATOS DEL DOCUMENTO EN LA BD
        $documento = new Documento();
        $documento->ruta = $ruta;
        $documento->nombre_original = "dictamen.pdf";
        $documento->mime = "application/pdf";
        $documento->user_id = $alumno->user_id;
        $documento->id_alumno = $alumno->id;
        $documento->tramite_id = $tramite->id;
        $documento->nombre_documento = "Dictamen";
        $documento->aprobado = 4;                                   

        $documento->save();     

        //GUARDAR EN CARPETA DE SERVIDOR
        $content = $pdf->download()->getOriginalContent();
        $content = $pdf->download()->getOriginalContent();
        Storage::put($ruta,$content);

        AlumnoDocs::where('alumno_id', $alumno->id)->update(['dictamen' => 1]);          

        //return $pdf->stream();        
        return redirect()->route('showTramite', $alumno)->with('success', 'Dictamen generado.');
                     
    }

    public function firma(){
        $user = Auth::user();
        $firma = Firma::where('user_id', auth()->user()->id)->first();     
        return view('admin.firma', compact('user','firma'));
    }

    public function uploadFirma(Request $request)
    {        
        $user = auth()->user();
        $name = $user->id . '_' . $user->name;
       
        $folderPath = storage_path('app/firmas/');
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0755, true);
        }
        
        $image_parts = explode(";base64,", $request->signed);              
        $image_type_aux = explode("image/", $image_parts[0]);           
        $image_type = $image_type_aux[1];        
        $image_base64 = base64_decode($image_parts[1]);                   
        $file =  $folderPath . $name .'.'. $image_type;   

        //uniqid()
        file_put_contents($file, $image_base64);      

        //GUARDAR EN CARPETA DE SERVIDOR
        Storage::put('firmas/' . $name . '.' . $image_type, $image_base64);

        // Crear nueva entrada en la tabla firmas
        $firm = Firma::where('user_id', auth()->user()->id)->first();    
        if(!isset($firm)){
            $firma = new Firma;
            $firma->nombre_original = "firma";
            $firma->nombre_documento = $name;
            $firma->ruta = 'firmas/' . $name .'.'. $image_type; 
            $firma->mime = "image/png";
            $firma->user_id = auth()->user()->id;
            $firma->save();
        }
        return redirect()->route('tramites')->with('success', 'Firma guardada exitosamente');
    }

    public function visualizarFirma(Firma $firma)
    {            
        try{
            return response()->file(storage_path('app/' . $firma->ruta));
        }catch(\Exception $e){
            echo $e;
            dd();
            return redirect()->route('firma')->with('info', 'No se pudo visualizar la firma.');
        }
    }

    public function eliminarDocumento(Documento $archivo)
    {
        try{
            $documento = Documento::find($archivo->id);
            
            if($documento->nombre_documento == "Dictamen"){
                AlumnoDocs::where('alumno_id', $documento->id_alumno)->update(['dictamen' => 0]);
            }elseif($documento->nombre_documento == "Comprobante Academico"){
                AlumnoDocs::where('alumno_id', $documento->id_alumno)->update(['comprobante_academica' => 0]);
            }elseif($documento->nombre_documento == "Constancia de No Adeudo Biblioteca"){
                AlumnoDocs::where('alumno_id', $documento->id_alumno)->update(['constancia_no_adeudo_biblioteca' => 0]);
            }elseif($documento->nombre_documento == "Constancia de No Adeudo Universidad"){
                AlumnoDocs::where('alumno_id', $documento->id_alumno)->update(['constancia_no_adeudo_universidad' => 0]);
            }
            Storage::delete($documento->ruta);
            $documento->delete();
        }catch(\Exception $e){            
            return redirect()->route('admin.dashboard')->with('info', 'No se pudo eliminar el documento.');
        }

        $tramite = Tramite::find($archivo->tramite_id);
        return redirect()->route('admin.tramite.show', $tramite)->with('success', 'Documento eliminado');
    }

    //Funcion para retornar al maestro de la forma DR. NOMBRE_MAESTRO
    public function retornarMaestroGrado($id)
    {
        $maestro_id = Maestro::where('id', $id)->first();
        $maestro = mb_strtoupper($maestro_id->nombre);

        if($maestro_id->grado == 'Doctorado'){
            if ($maestro_id->genero == 'H') {
                $maestro = 'DR. ' . $maestro;
            }else{
                $maestro = 'DRA. ' . $maestro;
            }
        }
        else if($maestro_id->grado == 'Ingeniería'){
            $maestro = 'ING. ' . $maestro;
        }
        else if($maestro_id->grado == 'Licenciatura'){
            $maestro = 'LIC. ' . $maestro;
        }
        else {
            if ($maestro_id->genero == 'H') {
                $maestro = 'MTRO. ' . $maestro;
            }else{
                $maestro = 'MTRA. ' . $maestro;
            }
        }

        return $maestro;
    }
}
