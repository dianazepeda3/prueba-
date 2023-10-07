<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\Alumno;
use App\Models\AlumnoDocs;
use App\Models\Tramite;
use App\Models\Documento;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use Exception;

class AuthController extends Controller
{
    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loginView()
    {
        return view('login.main', [
            'layout' => 'login-layout'
        ]);
    }

    /**
     * Authenticate login user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {                  
        //VALIDACION DE DATOS
        $request->validate([            
            'codigo' => 'required|numeric',
            'password' => 'required|string',
        ]);           
    
        $codigo = $request->codigo;  
        $nip = $request->password;            
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
                            echo $alumno->situacion;
                            dd();      
                            
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
                            return $pdf->stream();

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
            //throw new \Exception('No se pudieron comprobar los datos, intenta de nuevo.');
            return redirect()->back()->with('info', 'No se pudieron comprobar los datos, intenta de nuevo');
        }          
        /*if (!Auth::attempt([
            'codigo' => $request->codigo,
            'password' => $request->password
        ])) {
            //throw new \Exception('Codigo o Nip incorrecto.');
            return redirect()->route('login')->with('info', 'Codigo o Nip incorrecto.');
        }   */     
        if (Auth::attempt($credentials)) {
            // La autenticación ha sido exitosa
            if(Gate::allows('alumno')){
                return redirect()->intended('documentos');
            }else   if(Gate::allows('admin')){
                return redirect()->intended('inicio');
            }
        }     
        return redirect()->route('login')->with('info', 'Codigo o Nip incorrecto.');
                
    }

    /**
     * Logout user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
