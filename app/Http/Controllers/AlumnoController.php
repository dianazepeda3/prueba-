<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\AlumnoDocs;
use App\Models\Tramite;
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
    public function show(Alumno $alumno)
    {        
        $user = Auth::user();
        return view('alumno.show-datos', compact('user','alumno'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumno $alumno)
    {
        $user = $alumno->user;
        
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
    public function update(Request $request, Alumno $alumno)
    {       
        echo "hola";
        dd();
         //Validacion de campos
         $request->validate([                        
            'fecha_nacimiento' => 'required|date|before:today|after:1900-01-01',

            'estado_nacimiento' => 'required|string',
            'municipio_nacimiento' => 'required|string',
            'telefono_celular' => 'required|numeric|digits:10',
            'telefono_particular' => 'nullable|numeric|digits:10',
            'estado_civil' => 'required',
            'genero' => 'required',

            'domicilio_calle' => 'required|string',
            'domicilio_numero' => 'required|numeric',
            'domicilio_colonia' => 'required|string',
            'domicilio_cp' => 'required|numeric|digits:5',
            'domicilio_estado' => 'required|string',
            'domicilio_municipio' => 'required|string',
            
            'correo_institucional' => 'required|regex:/(.+)@(alumnos)\.(udg)\.(mx)/i',
            'correo_particular' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'estado_civil' => 'required|string',

            'articulo' => 'required|numeric|min:1',
            'opciones_titulacion' => 'required|numeric|min:1',                  
            'plan_estudios' => 'required|numeric|min:1',                        
        ]);           
        
        if($request->trabaja){
            if($request->afin){
                $request->validate([
                    'nombre_empresa' => 'required|string',
                    'puesto' => 'required|string',
                    'sueldo' => 'required|numeric',
                    'telefono_empresa' => 'required|numeric|digits:10',   
                    'empresa_calle' => 'nullable|string',
                    'empresa_numero' => 'nullable|numeric',
                    'empresa_colonia' => 'nullable|string',
                    'empresa_CP' => 'nullable|numeric|digits:5',
                    'empresa_estado' => 'nullable|string',
                    'empresa_municipio' => 'nullable|string',                               
                ]);
            }else{
                $request->validate([
                    'descripcion' => 'nullable|string',
                ]);
            }
        }

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

        // Datos Laborales
        //echo($request->trabaja);
        //dd();
        $alumno->trabaja = $request->trabaja;
        $alumno->afin = $request->afin;
        if($request->afin){
            $alumno->nombre_empresa = $request->nombre_empresa;
            $alumno->puesto = $request->puesto;
            $alumno->sueldo_mensual = $request->sueldo;
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

        //$alumnoDocs = alumnoDocs::find($alumno->id);
        //$alumnoDocs = AlumnoDocs::where('alumno_id', $alumno->id)->first();        
        //user_id               

        //$alumnoDocs->id_opcion_titulacion = $request->opciones_titulacion;        

        //$alumnoDocs->save();
        //Eliminar documentos
        $user_id = Auth::id();        
        
        if($eliminar){
            //Eliminar los documentos
            $documentos = Documento::where('user_id', $alumno->user_id)->get();

            $nombre = (string)$alumno->user_id;
            $nombre_ruta =  $nombre . "_" . $alumno->user->name;

            //$directory = 'alumnos/' . $nombre_ruta . '/';
            //Storage::deleteDirectory($directory);

            if ($documentos) {
                foreach ($documentos as $documento) {
                    //Eliminamos el documento de la base de datos
                    if($documento->nombre_documento != "Kárdex"){
                        $documento->delete();
                    }
                }
            }

            $alumno = Alumno::where('user_id', $user_id)->first();
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
               
        return redirect()->route('show-datos')->with('success', 'Información actualizada con éxito');
        
            
        //return view('alumnos.documentacion', compact('alumno', 'id_opcion_titulacion','id_plan_estudios'));
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

                            $nombre = (string)$alumno->user_id;
                            $nombre_ruta =  $nombre . "_" . $alumno->user->name;
                            $ruta = 'alumnos/' . $nombre_ruta . '/documentos/kardex.pdf';                           

                            //GUARDA DATOS DEL DOCUMENTO EN LA BD
                            $documento = new Documento();
                            $documento->ruta = $ruta;
                            $documento->nombre_original = "kardex.pdf";
                            $documento->mime = "application/pdf";
                            $documento->user_id = $alumno->user_id;
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
            echo $e;
            dd();
            return redirect()->back()->withErrors([
                'codigo' => $e . ' No se pudieron comprobar los datos, intenta de nuevo',
            ]);  
            return redirect()->back()->with('info', 'No se pudieron comprobar los datos, intenta de nuevo');
        }    
        $credentials = $request->only('codigo', 'password');
        //$credentials['codigo'] = Crypt::encrypt($credentials['codigo']);
                
        if (Auth::attempt($credentials)) {
            // La autenticación ha sido exitosa
            return redirect()->intended('inicio');
        }

        // Si la autenticación falla, redirige de vuelta al formulario de inicio de sesión
        return redirect()->back()->withErrors([
            'codigo' => 'Tus datos no coinciden con nuestras credenciales',
        ]);  
    }

    public function getSubcategorias($id)
    {
        return DB::table('opciones_titulacion')->where('articulo_id', '=', $id)->get();
    }
}
