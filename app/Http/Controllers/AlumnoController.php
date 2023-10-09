<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\AlumnoDocs;
use App\Models\Tramite;
use App\Models\Maestro;
use App\Models\Documento;
use GuzzleHttp\Client;
use Carbon\Carbon;
//use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function show()
    {        
        $user = Auth::user();
        $alumno = $user->alumno;
        return view('alumno.show-datos', compact('user','alumno'));
    }

    public function showDocumentos()
    {        
        $user = Auth::user();
        $alumno = $user->alumno;
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
        $id_opcion_titulacion = $alumno->id_opcion_titulacion;
        return view('alumno.show-documentos', compact('user','id_opcion_titulacion','tramite', 'alumno', 'documentos', 'maestros', 'aprobados','alumnoDocs', 'revisados'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {        
        $user = Auth::user();
        $alumno = $user->alumno;
        
        $carreras = DB::table('carreras')->get();
        $plan_estudios = DB::table('plan_estudios')->get();        
        //$correo = $user[0]->email;
        //$this->correo = $correo;
        $articulos = DB::table('articulos')->get();
        $opciones_titulacion = DB::table('opciones_titulacion')->get();        

        return view('alumno.edit-datos', compact('user','alumno','carreras','plan_estudios', 'articulos', 'opciones_titulacion'));    
   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {            
        $user = Auth::user();  
        $alumno = $user->alumno;
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
        if($request->id_opcion_titulacion == 7 || $request->id_opcion_titulacion == 11 || $request->id_opcion_titulacion == 13|| $request->id_opcion_titulacion == 14|| $request->id_opcion_titulacion == 15|| $request->id_opcion_titulacion == 16){
            $request->validate([
                'nombre_del_trabajo' => 'nullable|string',                              
            ]);
        }  
        
        if($request->plan_estudios == 0)
            return redirect()->back()->with('info', 'Elige el Plan de Estudios');                
        if($request->articulo == 0)
            return redirect()->back()->with('info', 'Elige la Modalidad de Titulación');                
        if($request->opciones_titulacion == 0)
            return redirect()->back()->with('info', 'Elige la Opción de Titulación');        
        if($request->estado_civil == 0)
            return redirect()->back()->with('info', 'Selecciona el estado civil');                        
        if($request->genero == 0)
            return redirect()->back()->with('info', 'Selecciona el genero');                                       

        if($request->articulo == 5 || $request->opciones_titulacion == 13){
            $request->validate([
                'nombre_del_trabajo' => 'required|string',
            ]);
        }               

        //Actualizar info del alumno
        $user = $alumno->user;                     
                
        Tramite::where('alumno_id', $alumno->id)->update(['estado' => 2]);       
        
        //id_articulo
        if($request->opciones_titulacion == $alumno->id_opcion_titulacion){
            $eliminar = false;            
        }else{
            $eliminar = true;           
        }        
        
        // COMPROBACION EGRESADO
        if(($request->articulo == 1 || $request->articulo == 2) && $alumno->situacion != "EGRESADO"){
            if(($request->articulo == 2) || ($request->opciones_titulacion == 1 && $alumno->promedio >= 95) || ($request->opciones_titulacion == 2 && $alumno->promedio >= 90)){
                $alumno->id_articulo = $request->articulo;        
                //opcion_titulacion
                $alumno->id_opcion_titulacion = $request->opciones_titulacion;  
            
                //id_plan_estudios
                $alumno->id_plan_estudios = $request->plan_estudios;  
            }
        }elseif($request->articulo != 1 && $request->articulo != 2){            
            $alumno->id_articulo = $request->articulo;        
            //opcion_titulacion
            $alumno->id_opcion_titulacion = $request->opciones_titulacion;  
            
            //id_plan_estudios
            $alumno->id_plan_estudios = $request->plan_estudios; 
        }
        
        $alumno->titulo_del_trabajo = $request->nombre_del_trabajo;
        if($request->ganador_proyecto == "Si"){
            $alumno->ganador_proyecto_modular = true;
        }else{
            $alumno->ganador_proyecto_modular = false;
        }
        
        // Datos Personales
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

        // COMPROBACION EGRESADO
        if(($request->articulo == 1 || $request->articulo == 2) && $alumno->situacion == "EGRESADO"){
            return redirect()->back()->with('info', 'Para elegir esta modalidad necesitas tener tu situación como EGRESADO');
        }
        // COMPROBACIONES MODALIDAD DESEMPEÑO ACADEMICO
        //Excelencia
        if($request->opciones_titulacion == 1 && $alumno->promedio < 95){
            return redirect()->back()->with('info', 'Para elegir esta modalidad necesitas un promedio global mínimo de 95 (noventa y cinco)');
        }       
        //Promedio
        if($request->opciones_titulacion == 2 && $alumno->promedio < 90){
            return redirect()->back()->with('info', 'Para elegir esta modalidad necesitas un promedio global mínimo de 90 (noventa)');
        }     
        //Eliminar documentos              
        
        if($eliminar){
            //Eliminar los documentos
            $documentos = Documento::where('user_id', $alumno->user->id)->get();

            $nombre = (string)$alumno->user->id;
            $nombre_ruta =  $nombre . "_" . $alumno->user->name;

            if ($documentos) {
                foreach ($documentos as $documento) {
                    //Eliminamos el documento de la base de datos
                    if($documento->nombre_documento != "Kárdex"){
                        $documento->delete();
                    }
                }
            }

            $alumno = Alumno::where('user_id', $user->id)->first();
            $alumnoDocs = $alumno->alumno_docs;
            $alumnoDocs->formato_a = 0;             
            //$alumnoDocs->kardex = 0; 

            $alumnoDocs->certificado = 0;            
            $alumnoDocs->prorroga = 0;
            $alumnoDocs->testimonio_desempeno = 0;                    
            $alumnoDocs->reporte_individual_resultados = 0;         
            $alumnoDocs->formato_d = 0;                               
            $alumnoDocs->protocolo = 0;                       
            $alumnoDocs->contenido_asignatura = 0;      
            $alumnoDocs->validado = 0;      
            $alumnoDocs->carta = 0;
            $alumnoDocs->testimonio_desempeno = 0;
            $alumnoDocs->reporte_individual_resultados = 0;                              
            $alumnoDocs->save();   
            
        }   
               
        return redirect()->route('edit-datos-laborales',$alumno)->with('success', 'Información escolar y laboral guardada con éxito');                    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alumno $alumno)
    {
        //
    }

    public function logSiiau(Request $request){ 
        //VALIDACION DE DATOS
        $request->validate([            
            'codigo' => 'required|numeric',
            'password' => 'required|string|min:6',
        ]);

        $codigo = $request->input('codigo');  
        $nip = $request->input('password');            
        $cons = DB::table('users')->where('codigo','=',$codigo)->get();          
        $client = new Client();  
        try{                        
            if($cons == "[]"){              
                $res = $client->request('POST', 'http://148.202.152.33/ws_siiau.php', [
                    'form_params' => [
                        'codigo' => $codigo,
                        'nip' => $nip, 
                    ]
                ]);  
                 
                if($res->getBody() != "0"){
                    $cons = DB::table('users')->where('codigo','=',$codigo)->get();                
                    if($cons == "[]"){                                  
                        $datos = $res->getBody();
                        $aux = explode(',', $datos);    
                        $name =  $aux[2];  
                        $carrera = $aux[3];                                                   
                        
                        // -- CONSULTA KARDEX --
                        $client = new Client();                
                        
                        $res = $client->request('POST', 'https://cuceimobile.space/Titulacion/ws_token.php?codigo='. $codigo); 
                        $datos = $res->getBody();                                                      
                        
                        // Separa informacion
                        $aux = explode('}', $datos);
                        if (sizeof($aux) == 1){   
                            return redirect()->back()->withErrors([
                                'codigo' => 'Hay problemas con el inicio de sesión, intenta más tarde',
                            ]); 
                        }else{
                            $prom_materia1 = explode('[', $aux[1]);
                            
                            $longitud = count($aux)-7;
                            $ciclos = 1;
                            for ($i=0;$i<$longitud;$i++){
                                $aux[$i] = $aux[$i]."}";        
                            }
                            for ($i=2;$i<$longitud;$i++){ 
                                $aux[$i] = substr($aux[$i], 1);
                                $materias[$i] = json_decode($aux[$i], true);                 
                            }
                            
                            $cod = json_decode($aux[0], true);
                            
                            /* COMPROBAR SI ES EGRESADO */ 
                            if($cod["situacion"] != "AC"){
                                return redirect()->back()->withErrors([
                                    'codigo' => 'Debes tener tu situación como EGRESADO',
                                ]);  
                            }     
                                                        
                            $name = $cod["nombre"] . " " . $cod["apellido"];   
                            $carrera = $cod["carrera"];                        

                            //CREAR USUARIO
                            $usuario = new User();
                            $usuario->codigo = $codigo;
                            $usuario->password = bcrypt($nip);
                            $usuario->name = $name;   
                    
                            $usuario->save();                            
                            
                            $alumno = new Alumno();                                             
                            $alumno->user_id = $usuario->id;
                            $alumno->situacion = $cod["situacion"];

                            switch($carrera){
                                case "INBI":
                                    $alumno->id_carrera = 1;
                                    break;
                                case "INNI":
                                    $alumno->id_carrera = 2;
                                    break;
                                case "INFO":
                                    $alumno->id_carrera = 3;
                                    break;
                                case "INCE":
                                    $alumno->id_carrera = 4;
                                    break;
                                case "INCO":
                                    $alumno->id_carrera = 5;
                                    break;
                                case "IGFO":
                                    $alumno->id_carrera = 6;
                                    break;
                                case "INRO":
                                    $alumno->id_carrera = 7;
                                    break;
                            }

                            $alumno->save();          
                            
                            //REGISTRAR TRAMITE
                            $tramite = new Tramite();
                            $tramite->alumno_id = $alumno->id;
                            $tramite->estado = 1;
                            $tramite->save();

                            $alumnoDocs = new AlumnoDocs();
                            $alumnoDocs->alumno_id = $alumno->id;
                            //$alumnoDocs->save();                                        

                            
                            $prom_materia1[0] = $prom_materia1[0]."\"null\"}";
                            $prom_materia1[1] = $prom_materia1[1]."}";
                            $promedio = json_decode($prom_materia1[0], true);
                            $materias[1] = json_decode($prom_materia1[1], true);

                            for ($i=0;$i<$longitud;$i++){
                                $num_materias[$i] = 1;
                            }
                            $fecha = $materias[1]["ciclo"];
                            $sem = 0;        
                            for ($i=2;$i<$longitud;$i++){
                                if($fecha != $materias[$i]["ciclo"]){
                                    $ciclos++;
                                    $sem++;
                                }else{
                                    $num_materias[$sem]++;
                                }
                                $fecha = $materias[$i]["ciclo"];                      
                            }

                            // SEPARAR INFORMACIÓN DE OPTATIVAS Y ESPACIALIZANTES
                            for($i=0; $i<17;$i++){
                                $aux[$longitud] = substr($aux[$longitud], 1);
                            }
                            for($i=$longitud; $i<=$longitud+4;$i++){
                                $aux[$i] = $aux[$i]."}";
                                $aux[$i] = substr($aux[$i], 1);
                            }
                            
                            $especializantes_obl = json_decode($aux[$longitud], true); 
                            $especializantes_sel = json_decode($aux[$longitud+1], true); 
                            $optativas = json_decode($aux[$longitud+2], true); 
                            $basico_comun = json_decode($aux[$longitud+3], true); 
                            $basica_particular = json_decode($aux[$longitud+4], true); 

                            for($i=0; $i<23;$i++){
                                $aux[$longitud+5] = substr($aux[$longitud+5], 1);
                            }
                            $creditos_requeridos = $aux[$longitud+5];
                            $creditos_faltantes = intval($especializantes_obl["diferencia"]) + intval($especializantes_sel["diferencia"])
                            +intval($optativas["diferencia"]+intval($basico_comun["diferencia"]+intval($basica_particular["diferencia"])));
                            
                            // Mas datos de alumno
                            $alumno->ciclo_ingreso = $materias[1]["ciclo"];
                            $alumno->ciclo_egreso = $cod["ultimo_cicloDesc"];
                            $alumno->promedio = $promedio['promedio'];
                            $alumno->save();

                            // Cambia formato de fecha
                            $time = Carbon::now();
                            $dia = $time->format('d');
                            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");        
                            $mes = $meses[($time->format('n')) - 1];
                            $anio= $time->format('Y');  

                            $id_alumno = $alumno->id;
                            $tramite = Tramite::where('alumno_id', '=', $id_alumno)->first();
                            $id_tramite = $tramite->id;
                                    
                            
                            $pdf = PDF::loadView('layout.alumnos.kardexpdf', compact('alumno','dia', 'mes', 'anio', 'ciclos', 'cod'
                            ,'promedio', 'longitud', 'materias', 'num_materias', 'especializantes_sel','optativas','basico_comun',
                            'basica_particular', 'especializantes_obl', 'creditos_requeridos','creditos_faltantes'));
                            $pdf->setPaper('A4', 'portrait');
                            //return $pdf->stream();

                            $nombre = (string)$alumno->user->id;
                            $nombre_ruta =  $nombre . "_" . $alumno->user->name;
                            $ruta = 'alumnos/' . $nombre_ruta . '/documentos/kardex.pdf';                           

                            //GUARDA DATOS DEL DOCUMENTO EN LA BD
                            $documento = new Documento();
                            $documento->ruta = $ruta;
                            $documento->nombre_original = "kardex.pdf";
                            $documento->mime = "application/pdf";
                            $documento->user_id = $alumno->user->id;
                            $documento->id_alumno = $id_alumno;
                            $documento->tramite_id = $id_tramite;
                            $documento->nombre_documento = "Kárdex";
                            $documento->aprobado = 4;                                   

                            $documento->save();

                            // GUARDA QUE EL KARDEX SE SUBIO      
                            $alumnoDocs->kardex = 1;                 
                            $alumnoDocs->save(); 

                            //GUARDAR KARDEX EN CARPETA DE SERVIDOR
                            $content = $pdf->download()->getOriginalContent();
                            Storage::put($ruta,$content);
                        }                                              
                    }             
                }  
            } 
        }catch (Exception $e){
            return redirect()->back()->withErrors([
                'codigo' => ' No se pudieron comprobar los datos, intenta de nuevo',
            ]);  
            return redirect()->back()->with('info', 'No se pudieron comprobar los datos, intenta de nuevo');
        }    
        $credentials = $request->only('codigo', 'password');
        if (Auth::attempt($credentials)) {
            // La autenticación ha sido exitosa
            $user = Auth::user();            
            if(Gate::allows('alumno')){     
                if($user->alumno->tramite->estado == 1)
                    return redirect()->route('edit-datos');
                else        
                    return redirect()->intended('inicio');
                
            }else   if(Gate::allows('admin')){
                return redirect()->intended('tramites');
            }
        }                         

        // Si la autenticación falla, redirige de vuelta al formulario de inicio de sesión
        return redirect()->back()->withErrors([
            'codigo' => 'Tus datos no coinciden con nuestras credenciales',
        ]);  
    }

    public function uploadDocumento(Request $request)
    {                                  
        $max_size = (int) ini_get('upload_max_filesize') * 10240;        
        //VALIDACION DE ARCHIVOS
        $request->validate([
            'nombre' => 'required|string',
            'documento' => 'required|file|max:'.$max_size
        ]);
        //user
        $user = Auth::user();                
        $alumno = $user->alumno;
        $tramite = $alumno->tramite;
        
        $nombre = (string)$user->id;
        $nombre_ruta =  $nombre . "_" . $user->name;                         

        //ASIGNA NOMBRE DEL ARCHIVO QUE CORRESPONDE              
        $nombreArch = $request->nombre;

        if($nombreArch == "0"){
            return redirect()->route('show-documentos')->with('info', 'Selecciona el nombre del archivo');
        }            
        
        //GUARDAR DOCUMENTO
        if ($request->hasFile('documento') && $request->file('documento')->isValid()) {

            $ruta = $request->documento->store('alumnos/' . $nombre_ruta . '/documentos');
            $documento = new Documento();
            $documento->ruta = $ruta;
            $documento->nombre_original = $request->documento->getClientOriginalName();
            $documento->mime = $request->documento->getClientMimeType();
            $documento->user_id = $user->id;
            $documento->id_alumno = $alumno->id;
            $documento->tramite_id = $tramite->id;
            $documento->nombre_documento = $nombreArch;
   
            $documento->save();

            $alumnoDocs = $alumno->alumno_docs;            

            // GUARDA QUE DOCUMENTOS SE SUBIERON
            switch($nombreArch){
                case "0":
                    return redirect()->route('show-documentos');
                break;
                case "Formato A":
                    $alumnoDocs->formato_a = 1;
                break; 
                case "Kárdex de Estudiante":
                    $alumnoDocs->kardex = 1;
                break; 
                case "Certificado de Inglés":
                    $alumnoDocs->certificado = 1;
                break; 
                case "Solicitud de Prórroga":
                    $alumnoDocs->prorroga = 1;
                break; 
                case "Testimonio de Desempeño":
                    $alumnoDocs->testimonio_desempeno = 1;                    
                break; 
                case "Reporte Individual de Resultados":
                    $alumnoDocs->reporte_individual_resultados = 1;  
                break; 
                case "Carta dirigida al Comité de Titulación":
                    $alumnoDocs->carta = 1;
                break;
                case "Formato D":
                    $alumnoDocs->formato_d = 1;                    
                break; 
                case "Protocolo":
                    $alumnoDocs->protocolo = 1;                   
                break;
                case "Contenido de la asignatura":
                    $alumnoDocs->contenido_asignatura = 1;
                break;   
                case "Formato C":
                    $alumnoDocs->formato_c = 1;
                break;      
                case "Certificados / Constancias":
                    $alumnoDocs->certificado_constancias = 1;
                break; 
                case "Constancia de Calificaciones":
                    $alumnoDocs->constancia_calificaciones = 1;
                break;
                case "Folleto":
                    $alumnoDocs->folleto = 1;
                break;
                case "Constancia Ganador PM":
                    $alumnoDocs->constancia_ganador_pm = 1;
                break;
                case "Evidencia del ISSN o ISBN":
                    $alumnoDocs->evidencia = 1;
                break;
                case "Evidencia":
                    $alumnoDocs->evidencia = 1;
                break;
                case "Declaratoria":
                    $alumnoDocs->declaratoria = 1;
                break;
                case "Publicación":
                    $alumnoDocs->publicacion = 1;
                break;
                case "Autorización Impresión":
                    $alumnoDocs->autorizacion_impresion = 1;
                break;        
                case "Documento Trabajo":
                    $alumnoDocs->documento_trabajo = 1;
                break;
                case "Reporte Escrito":
                    $alumnoDocs->reporte_escrito = 1;
                break;
                case "Reseña del Trabajo":
                    $alumnoDocs->resena_trabajo = 1;
                break;
                case "Curriculum vitae Académico":
                    $alumnoDocs->curriculum_academico = 1;
                break;
                case "Certificados CENEVAL":
                    $alumnoDocs->certificados_ceneval = 1;
                break;
                case "Pago de Arancel":
                    $alumnoDocs->pago_arancel = 1;
                break;
            }                                
            $alumnoDocs->save(); 
        }
        return redirect()->route('show-documentos')->with('success','Documento subido correctamente');
    }

    public function visualizarDocumento(Documento $documento)
    {
        $user_id = Auth::user()->id;        
        if ($documento->user_id == $user_id) {
            //Visualize the file without downloading it
            return response()->file(storage_path('app/' . $documento->ruta));
        } else {
            return redirect()->route('alumnos.dashboard')->with('error', 'No tienes permisos para ver este archivo');
        }

    }

    public function revisionDocumentos(){        
        $user = Auth::user();
        //alumno
        $alumno = $user->alumno;
        $tramite = $alumno->tramite;
        //alumno docs
        $alumnodocs = $alumno->alumno_docs;

        $documentos = Documento::where('id_alumno', $alumno->id)->get(); 
        
        // Comprobar que no haya documentos No Aprobados
        $no_aprobados = false;
        foreach ($documentos as $documento){
            if($documento->aprobado == 2 || $documento->aprobado == 6){
                $no_aprobados = true;
            }
        }
        if($no_aprobados){
            return redirect()->route('show-documentos')->with('info','Corrige los documentos no aprobados');
        }        
        if ($tramite->estado == 2 || $tramite->estado == 3 || $tramite->estado == 5) {
            if($alumnodocs->formato_a && $alumnodocs->kardex && $alumnodocs->certificado){                                                
                // EXCELENCIA Y PROMEDIO        // EXAMEN GLOBAL TEORICO PRACTICO / EXAMEN GLOBAL TEORICO
                if($alumno->id_articulo == 1 || ($alumno->id_opcion_titulacion == 3 || $alumno->id_opcion_titulacion == 4 && $alumnodocs->carta)
                    // CENEVAL
                    || ($alumno->id_opcion_titulacion == 5 && $alumnodocs->reporte_individual_resultados && $alumnodocs->testimonio_desempeno)
                    // Examen de Capacitacion
                    || ($alumno->id_opcion_titulacion == 6 && $alumnodocs->formato_c && $alumnodocs->certificado_constancias)
                    // Guías comentadas o ilustradas / Paquete didactico
                    || ($alumno->id_opcion_titulacion == 7 || $alumno->id_opcion_titulacion == 8 && $alumnodocs->formato_d && $alumnodocs->protocolo && $alumnodocs->contenido_asignatura)
                    // Cursos o créditos de maestría o doctorado
                    || ($alumno->id_opcion_titulacion == 9 && $alumnodocs->constancia_calificaciones && $alumnodocs->folleto)
                    // Seminario de Investigacion
                    || ($alumno->id_opcion_titulacion == 11 && $alumnodocs->evidencia && $alumnodocs->declaratoria && $alumnodocs->publicacion && $alumnodocs->carta_autorizacion)
                    // Seminario de Titulación
                    || ($alumno->id_opcion_titulacion == 12 && $alumnodocs->evidencia && $alumnodocs->reporte_escrito && $alumnodocs->resena_trabajo && $alumnodocs->curriculum_academico)
                    // Diseño o rediseño / Tesis / Informe de practicas
                    || (($alumno->id_opcion_titulacion == 13 && (($alumno->ganador_proyecto_modular && $alumnodocs->constancia_ganador_pm) || !$alumno->ganador_proyecto_modular)) || $alumno->id_opcion_titulacion == 14 || $alumno->id_opcion_titulacion == 16 && $alumnodocs->protocolo)){                                                                     
                        foreach ($documentos as $documentos){
                            if($documentos->aprobado != 1 && $documentos->aprobado != 4){
                                $documentos->aprobado = 3;
                                $documentos->save();
                            }
                        }               
                        $alumnodocs->validado = 1;                
                        $alumnodocs->save();                            
                        Tramite::where('alumno_id', $alumno->id)->update(['estado' => 3]);                                                             
                }else{
                    $alumnodocs->validado = 2;
                    $alumnodocs->save();
                }   
            }else{
                $alumnodocs->validado = 2;
                $alumnodocs->save();
            }   
        }else if($tramite->estado == 6 || $tramite->estado == 9){
            if((($tramite->alumno->id_opcion_titulacion == 7 || $tramite->alumno->id_opcion_titulacion == 8 || $tramite->alumno->id_opcion_titulacion == 13 || $tramite->alumno->id_opcion_titulacion == 14 || $tramite->alumno->id_opcion_titulacion == 16)
                && $alumnodocs->autorizacion_impresion && $alumnodocs->documento_trabajo)
                || ($tramite->alumno->id_opcion_titulacion == 12 && $alumnodocs->autorizacion_impresion)
                || ($tramite->alumno->id_opcion_titulacion == 5 && $alumnodocs->certificados_ceneval)){  
                foreach ($documentos as $documentos){
                    if($documentos->aprobado != 1 && $documentos->aprobado != 5 && $documentos->aprobado != 4){
                        $documentos->aprobado = 3;
                        $documentos->save();
                    }
                }               
                $alumnodocs->validado = 3;                
                $alumnodocs->save();     
                // Estado Documentos Entregados - 2da Etapa                       
                Tramite::where('alumno_id', $alumno->id)->update(['estado' => 7]);                                                             
            }else{
                $alumnodocs->validado = 4;
                $alumnodocs->save();
            }                                 
            
        }else if($tramite->estado == 8 || $tramite->estado == 11){
            if((($tramite->alumno->id_opcion_titulacion == 7 || $tramite->alumno->id_opcion_titulacion == 8 || $tramite->alumno->id_opcion_titulacion == 13 || $tramite->alumno->id_opcion_titulacion == 14 || $tramite->alumno->id_opcion_titulacion == 16)
                && $alumnodocs->autorizacion_publicacion)
                || $tramite->alumno->id_opcion_titulacion != 7 && $tramite->alumno->id_opcion_titulacion != 8 && $tramite->alumno->id_opcion_titulacion != 13 && $tramite->alumno->id_opcion_titulacion != 14 && $tramite->alumno->id_opcion_titulacion != 16
                && ($alumnodocs->pago_arancel && $alumnodocs->constancia_no_adeudo_universidad && $alumnodocs->constancia_no_adeudo_biblioteca)){  
                foreach ($documentos as $documentos){
                    if($documentos->aprobado != 1 && $documentos->aprobado != 5 && $documentos->aprobado != 4){
                        $documentos->aprobado = 3;
                        $documentos->save();
                    }
                }               
                $alumnodocs->validado = 5;                
                $alumnodocs->save();     
                // Estado Documentos Entregados - 3ra Etapa                       
                Tramite::where('alumno_id', $alumno->id)->update(['estado' => 10]);                                                             
            }else{
                $alumnodocs->validado = 6;
                $alumnodocs->save();
            }                                 
            
        }    
        
        if($alumnodocs->validado == 2 || $alumnodocs->validado == 4 || $alumnodocs->validado == 6)
            return redirect()->route('show-documentos')->with('info','Tus documentos NO estan COMPLETOS');
    
        
        return redirect()->route('show-documentos')->with('success','Documentos enviados a revisión.');
    }

    public function descargarDocumento(Documento $documento)
    {
        $user_id = Auth::user()->id;
        if( $documento->user_id == $user_id ){
            return Storage::download($documento->ruta, $documento->nombre_original);
        }else{
            return redirect()->route('alumnos.dashboard')->with('error', 'No tiene permisos para descargar este archivo');
        }
    }

    public function eliminarDocumento(Documento $documento){        
        try{
            //$documento = Documento::find($documento->id);
            Storage::delete($documento->ruta);
            $nombre = $documento->nombre_documento;
            $documento->delete();
            $user_id = Auth::id();
            $alumno = Alumno::where('user_id', $user_id)->first();
            $alumnoDocs = AlumnoDocs::where('alumno_id', $alumno->id)->first();

            if($nombre == "Formato A"){
                $alumnoDocs->formato_a = 0;            
            }else if($nombre == "Certificado de Inglés"){
                $alumnoDocs->certificado = 0;
            }else if($nombre == "Prórroga"){
                $alumnoDocs->prorroga = 0;
            }else if($nombre == "Testimonio de Desempeño"){
                $alumnoDocs->testimonio_desempeno = 0;
            }else if($nombre == "Reporte Individual de Resultados"){
                $alumnoDocs->reporte_individual_resultados = 0;
            }else if($nombre == "Formato D"){
                $alumnoDocs->formato_d = 0;
            }else if($nombre == "Protocolo"){
                $alumnoDocs->protocolo = 0;
            }else if($nombre == "Contenido de la asignatura"){
                $alumnoDocs->contenido_asignatura = 0;
            }else if($nombre == "Carta dirigida al Comité de Titulación"){
                $alumnoDocs->carta = 0;
            }else if($nombre == "Formato C"){
                $alumnoDocs->formato_c = 0;                                                          
            }else if($nombre == "Certificados / Constancias"){
                $alumnoDocs->certificado_constancias = 0;
            }else if($nombre == "Folleto"){
                $alumnoDocs->folleto = 0;
            }else if($nombre == "Constancia de Calificaciones"){
                $alumnoDocs->constancia_calificaciones = 0;
            }else if($nombre == "Constancia Ganador PM"){
                $alumnoDocs->constancia_ganador_pm = 0;
            }else if($nombre == "Evidencia del ISSN o ISBN"){
                $alumnoDocs->evidencia = 0;
            }else if($nombre == "Evidencia"){
                $alumnoDocs->evidencia = 0;
            }else if($nombre == "Declaratoria"){
                $alumnoDocs->declaratoria = 0;
            }else if($nombre == "Publicación"){
                $alumnoDocs->publicacion = 0;
            }else if($nombre == "Autorización Impresión"){
                $alumnoDocs->autorizacion_impresion = 0;
            }else if($nombre == "Autorizacion de Publicación Tesis"){
                $alumnoDocs->autorizacion_publicacion = 0;
            }else if($nombre == "Documento Trabajo"){
                $alumnoDocs->documento_trabajo = 0;
            }else if($nombre == "Reporte Escrito"){
                $alumnoDocs->reporte_escrito = 0;
            }else if($nombre == "Reseña del Trabajo"){
                $alumnoDocs->resena_trabajo = 0;
            }else if($nombre == "Curriculum vitae Académico"){
                $alumnoDocs->curriculum_academico = 0;
            }else if($nombre == "Certificados CENEVAL"){
                $alumnoDocs->certificados_ceneval = 0;
            }else if($nombre == "Pago de Arancel"){
                $alumnoDocs->pago_arancel = 0;
            }
                
            $alumnoDocs->save();           

        }catch(\Exception $e){
            if(Gate::allows('alumno')){
                return redirect()->route('show-documentos')->with('info', 'No se pudo eliminar el documento.');
            }else{
                return redirect()->route('showTramite')->with('info', 'No se pudo eliminar el documento.');            
            }
        }

        if(Gate::allows('alumno')){
            return redirect()->route('show-documentos')->with('success','Documento "'.$nombre.'" eliminado');
        }else{
            return redirect()->route('showTramite')->with('success','Documento "'.$nombre.'" eliminado');
        }        
    }

    public function descargaFormato01(){
        //user
        $user = Auth::User();   
        $time = Carbon::now();          
        
        $dia = $time->format('d');
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");        
        $mes = $meses[($time->format('n')) - 1];
        $anio= $time->format('Y');  
        
        $pdf = PDF::loadView('layout.alumnos.formato01pdf', compact('user','dia','mes','anio'));
        $pdf->setPaper('A4', 'portrait');
        //$pdf->setPaper('letter');   
        
        //return $pdf->stream();
        return $pdf->download('Formato A.pdf');        
    }

    public function solicitarCarta(AlumnoDocs $alumnoDocs){
        /*$tramite->estado = 9;
        $tramite->save();*/
        $alumnoDocs->solicitud_constancia_no_adeudo_biblioteca = 1;
        $alumnoDocs->save();

        return redirect()->back()->with('success', 'Carta de No Adeudo solicitada a Biblioteca');         
    }

    public function solicitarCartaCE(AlumnoDocs $alumnoDocs){
        /*$tramite->estado = 11;
        $tramite->save();*/
        $alumnoDocs->solicitud_constancia_no_adeudo_universidad = 1;
        $alumnoDocs->save();

        return redirect()->back()->with('success', 'Carta de No Adeudo solicitada a Control Escolar');
         
    }

    public function getSubcategorias($id)
    {
        return DB::table('opciones_titulacion')->where('articulo_id', '=', $id)->get();
    }
}
