<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
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
use App\Models\Coordinador;
use App\Models\Firma;
use Carbon\Carbon;
use NumberFormatter;

class AdminController extends Controller
{
    public function login(Request $request){ 
        //VALIDACION DE DATOS
        $request->validate([            
            'codigo' => 'required|regex:/(.+)@(.+)\.(.+)/i', 
            'password' => 'required|string|min:6',
        ]);
           
        $credentials = $request->only('codigo', 'password');
        if (Auth::attempt($credentials)) {
            // La autenticación ha sido exitosa
            $user = Auth::user();                        
            return redirect()->intended('tramites');            
        }                         

        // Si la autenticación falla, redirige de vuelta al formulario de inicio de sesión
        return redirect()->back()->withErrors([
            'codigo' => 'Tus datos no coinciden con nuestras credenciales',
        ]);  
    }
    
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
            if ($documento->aprobado == 2 || $documento->aprobado == 3 || $documento->aprobado == 6 || $documento->aprobado == 7 || $documento->aprobado == 9 || $documento->aprobado == 10){                
                $aprobados = false;
            }            
        }                              

        $revisados = true;
        foreach($documentos as $documento){
            if ($documento->aprobado == 3 || $documento->aprobado == 7 || $documento->aprobado == 10){                
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
        }else if($tramite->estado == 3){
            Documento::where('id', $documento->id)->update(['aprobado' => 1]);
        }else{
            Documento::where('id', $documento->id)->update(['aprobado' => 8]);
        }
        $alumno = $tramite->alumno;
        return redirect()->route('showTramite', $alumno)->with('success', 'Documento "'. $documento->nombre_documento . '" Aprobado');
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
        }else if($tramite->estado == 3){
            Documento::where('id', $documento->id)->update(['aprobado' => 2]);
            Documento::where('id', $documento->id)->update(['comentario' => $request->comentario]);
        }else{
            Documento::where('id', $documento->id)->update(['aprobado' => 9]);
            Documento::where('id', $documento->id)->update(['comentario' => $request->comentario]);
        }
        $alumno = $tramite->alumno;
        return redirect()->route('showTramite', $alumno)->with('success', 'Documento "'. $documento->nombre_documento . '" No Aprobado');
    }

    public function revisarDocumento(Tramite $tramite){
        $alumno = $tramite->alumno;
        //Estado - Documentos Entregados
        if($tramite->estado == 7){
            //Estado - Documentos No Aprobados
            Tramite::where('id', $tramite->id)->update(['estado' => 9]);
            AlumnoDocs::where('alumno_id', $tramite->alumno->id)->update(['validado' => 4]);
        }else if($tramite->estado == 3){
            //Estado - Documentos No Aprobados
            Tramite::where('id', $tramite->id)->update(['estado' => 5]);
            AlumnoDocs::where('alumno_id', $tramite->alumno->id)->update(['validado' => 2]);
        }else{
            //Estado - Documentos No Aprobados
            Tramite::where('id', $tramite->id)->update(['estado' => 12]);
            AlumnoDocs::where('alumno_id', $tramite->alumno->id)->update(['validado' => 6]);            
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
                return redirect()->route('showTramite', $alumno)->with('info', 'Documentos validados correctamente. No se pudo enviar el correo.');
            }
        }else if($tramite->estado == 3){
            //Estado - Documentos Validados
            Tramite::where('id', $tramite->id)->update(['estado' => 4]);
        }else{
             //Estado - Documentos Validados
             Tramite::where('id', $tramite->id)->update(['estado' => 11]);
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
        if(!isset($firma))           
            return redirect()->route('showTramite',$alumno)->with('info', 'No tiene firma guardada');        
        
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

    public function generate_comprobante_academico(Tramite $tramite){         
        $name = auth()->user()->name .'_'. auth()->user()->id;  
        $firma = Firma::where('user_id', auth()->user()->id)->first();       
        if(!isset($firma)) {
            return redirect()->route('admin.tramite.show', $tramite)->with('info', 'No tiene firma guardada');
        }    
        //alumno
        $alumno = $tramite->alumno;        
        $modalidad = $alumno->id_opcion_titulacion;
        $time = Carbon::now();      
        
        $dia = $time->format('d');
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");        
        $mes = $meses[($time->format('n')) - 1];
        $anio= $time->format('Y');       
        
        $folio = $alumno->consecutivo;
                
        $carrera =  Carrera::where('id', $alumno->id_carrera)->first();
        $carrera = $carrera->carrera;
                
        $plan = PlanEstudios::where('id', $alumno->id_plan_estudios)->first();
        $plan = mb_strtolower($plan->nombre, 'UTF-8');

        $promedio = $alumno->promedio;
        $promedio = number_format($promedio, 2);
        $formatterES = new NumberFormatter("es", NumberFormatter::SPELLOUT);

        //checar si después del punto hay un cero
        if( substr($promedio, strpos($promedio, '.')+1, 1) == "0"){
            $promedio = $formatterES->format($promedio);
            $promedio = str_replace('coma', 'punto', $promedio);
        }else{
            //Dividir el promedio antes y después del punto
            $promedio_antes = substr($promedio, 0, strpos($promedio, '.'));
            $promedio_despues = substr($promedio, strpos($promedio, '.')+1, strlen($promedio));

            $promedio_antes = $formatterES->format($promedio_antes);
            $promedio_despues = $formatterES->format($promedio_despues);

            $promedio = $promedio_antes . " punto " . $promedio_despues;
        }

        $promedio = mb_strtoupper($promedio);
        $prom = number_format($alumno->promedio, 2);
        $promedio_numero = (string)$prom;
        $promedio =  $promedio_numero . " (". $promedio .")";   
        
        if($alumno->id_opcion_titulacion >= 13){
            //Presidente
            $presidente = $this->retornarMaestroGrado($alumno->id_maestro_presidente);
            //Secretario
            $secretario = $this->retornarMaestroGrado($alumno->id_maestro_secretario);
            //Vocal
            $vocal = $this->retornarMaestroGrado($alumno->id_maestro_vocal);
        }else{
            $presidente = "";
            $secretario = "";
            $vocal = "";
        }
        
        $pdf = PDF::loadView('layout.admin.comprobanteAcademico2', compact('plan','firma','name','alumno','dia','mes','anio','modalidad','folio'
        ,'carrera','promedio','presidente','secretario','vocal'));     
        $pdf->setPaper('letter');
        
        //return $pdf->stream();
        
        $tramite = Tramite::where('alumno_id', '=', $alumno->id)->first();
        $nombre = (string)$alumno->user_id;
        $nombre_ruta =  $nombre . "_" . $alumno->user->name;
        $ruta = 'alumnos/' . $nombre_ruta . '/documentos/comprobanteAcademico.pdf';                           

        //GUARDA DATOS DEL DOCUMENTO EN LA BD
        $documento = new Documento();
        $documento->ruta = $ruta;
        $documento->nombre_original = "comprobanteAcademico.pdf";
        $documento->mime = "application/pdf";
        $documento->user_id = $alumno->user_id;
        $documento->id_alumno = $alumno->id;
        $documento->tramite_id = $tramite->id;
        $documento->nombre_documento = "Comprobante Academico";
        $documento->aprobado = 4;                                   

        $documento->save();     

        //GUARDAR EN CARPETA DE SERVIDOR
        $content = $pdf->download()->getOriginalContent();
        $content = $pdf->download()->getOriginalContent();
        Storage::put($ruta,$content);

        AlumnoDocs::where('alumno_id', $alumno->id)->update(['comprobante_academica' => 1]);

        //return $pdf->stream();        
        return redirect()->route('showTramite', $alumno)->with('success', 'Comprobante academico generado.');
    }

    public function pasarEtapa2(Tramite $tramite){
        $alumno = $tramite->alumno;
        if($alumno->id_articulo == 1)
            Tramite::where('id', $tramite->id)->update(['estado' => 8]);
        else
            Tramite::where('id', $tramite->id)->update(['estado' => 6]);
        
        
        //Enviar correo de notificacion
        $details = [
            'title' => 'Modalidad Aprobada',
            'alumno' => $alumno->user->name,
            'body' => "Le informamos que su modalidad de titulación ha sido aceptada, su Dictamen de Aprobación y su Comprobante Académico ya se encuentran disponibles en la plataforma. 
            Ahora puede proceder con el siguiente paso en el proceso de titulación.",
        ];

        try{
            Mail::to($alumno->correo_institucional)->send(new NotificacionTramiteMail($details));
        } catch (\Exception $e) {
            return redirect()->route('showTramite', $alumno)->with('info', 'Documentos validados correctamente. No se pudo enviar el correo.');
        }

        return redirect()->route('showTramite', $alumno)->with('success', 'Alumno en 2da etapa');
    }

    //Funcion para devolver la vista de editar Datos Titulacion
    public function editDatosTitulacion(Alumno $alumno)
    {
        $user = $alumno->user;
        $maestros = Maestro::all();
        return view('admin.datos-titulacion', compact('user','alumno', 'maestros'));
    }

    //Funcion para devolver la vista de editar Datos Titulacion
    public function updateDatosTitulacion(Request $request, Alumno $alumno)
    {
        //VALIDACION DE DATOS
        $request->validate([            
            'numero_de_consecutivo' => 'required|numeric', 
            'anio_graduacion' => 'required|numeric', 
            'consecutivo' => 'required|string', 
            'fecha_egreso' => 'required|date',
            'fecha_titulacion' => 'required|date',            
            'tipo_de_ceremonia' => 'required',            
            'presidente' => 'required',
            'secretario' => 'required',
            'vocal' => 'required',
            'hora_inicio_citatorio' => 'required|string',
            'hora_fin_citatorio' => 'required|string',
            'fecha_citatorio' => 'required|date',
            'tipo_de_ceremonia_presencial_virtual' => 'required',
            'lugar_de_ceremonia' => 'required|string', 
        ]);

        //primero buscamos al alumno
        $alumno = Alumno::find($alumno->id);

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
                return redirect()->route('showTramite',$alumno)->with('info', 'No se encontraron los maestros para el comite de titulacion');
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
        $alumno->numero_de_consecutivo = $request->numero_de_consecutivo;
        $alumno->numero_de_consecutivo = $request->numero_de_consecutivo;
        $alumno->anio_graduacion = (int)$request->anio_graduacion;
        $alumno->consecutivo = $request->consecutivo;
        $alumno->fecha_egreso = $request->fecha_egreso;
        $alumno->fecha_titulacion = $request->fecha_titulacion;
        $alumno->hora_inicio_citatorio = $request->hora_inicio_citatorio;
        $alumno->hora_fin_citatorio = $request->hora_fin_citatorio;
        $alumno->hora_fin_citatorio = $request->hora_fin_citatorio;
        $alumno->fecha_citatorio = $request->fecha_citatorio;
        $alumno->tipo_de_ceremonia = $request->tipo_de_ceremonia;
        $alumno->tipo_de_ceremonia_presencial_virtual = $request->tipo_de_ceremonia_presencial_virtual;
        $alumno->lugar_de_ceremonia = $request->lugar_de_ceremonia;

        $alumno->id_director_division = $director_division->id;        
        $alumno->nombre_director_division = $director_division->nombre;
        
        $alumno->id_secretario_division = $secretario_division->id;
        
        $alumno->nombre_secretario_division = $secretario_division->nombre;

        if($alumno->id_opcion_titulacion == 6){
            $alumno->calificacion_examen_capacitacion = $request->calificacion_examen_capacitacion;
        }
        //Si es global_teorico
        else if($alumno->id_opcion_titulacion == 4){
            $alumno->promedio_global_teorico = $request->promedio_global_teorico;
        }
        //Si es global_teorico
        else if($alumno->id_opcion_titulacion == 7 || $alumno->id_opcion_titulacion == 11 || $alumno->id_opcion_titulacion == 13 || $alumno->id_opcion_titulacion == 14 || $alumno->id_opcion_titulacion == 16){
            $alumno->calificacion_trabajo = $request->calificacion_trabajo;
        }

        $alumno->save();        

        //buscas la carrera y el plan de estudio del alumno
        $carrera = $alumno->id_carrera;
        $plan = $alumno->id_plan_estudios;

        if($request->anio_graduacion != null){
            $anio = (int)$request->anio_graduacion;
        }else{
            $anio = date('Y');
        }

        if($request->numero_de_consecutivo != null){
            $consecutivo = $request->numero_de_consecutivo;
        }else{
            //Mandar a llamar la funcion para el consecutivo
            $consecutivo = $this->getConsecutivo($carrera, $plan);
        }

        if($request->consecutivo != null){
            $tramite_consecutivo = $request->consecutivo;
        }else{
            //Generar el consecutivo del tramite
            $tramite_consecutivo = $consecutivo . '/' . $anio;
        }


        Alumno::where('id', $alumno->id)->update(['numero_de_consecutivo' => $consecutivo, 'anio_graduacion' => $anio , 'consecutivo' => $tramite_consecutivo ]);

        //buscar tramite
        $tramite = Tramite::where('alumno_id', $alumno->id)->update(['estado' => '13']);

        $tramite = Tramite::where('alumno_id', $alumno->id)->first();


        return redirect()->route('showTramite', $alumno)->with('success', 'Datos de titulación actualizados correctamente');
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

    public function eliminarDocumento(Documento $documento)
    {
        try{                       
            if($documento->nombre_documento == "Dictamen"){
                AlumnoDocs::where('alumno_id', $documento->id_alumno)->update(['dictamen' => 0]);
            }elseif($documento->nombre_documento == "Comprobante Academico"){
                AlumnoDocs::where('alumno_id', $documento->id_alumno)->update(['comprobante_academica' => 0]);
            }elseif($documento->nombre_documento == "Constancia de No Adeudo Biblioteca"){
                AlumnoDocs::where('alumno_id', $documento->id_alumno)->update(['constancia_no_adeudo_biblioteca' => 0]);
            }elseif($documento->nombre_documento == "Constancia de No Adeudo Universidad"){
                AlumnoDocs::where('alumno_id', $documento->id_alumno)->update(['constancia_no_adeudo_universidad' => 0]);
            }elseif($documento->nombre_documento == "Acta de Titulacion Firmada"){
                Alumno::where('id', '=', $documento->id_alumno)->update(['acta_firmada' => 0]);
            }
            Storage::delete($documento->ruta);
            $documento->delete();
        }catch(\Exception $e){       
            echo $e;
            dd();     
            return redirect()->route('admin.tramite.show', $tramite)->with('info', 'No se pudo eliminar el documento.');
        }

        $tramite = Tramite::find($documento->tramite_id);
        return redirect()->route('showTramite', $tramite->alumno)->with('success', 'Documento eliminado');
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

    //Retorna el numero de acta en el formato debido
    public function retornarNumActa(Alumno $alumno){
        $numero_acta = $alumno->numero_de_consecutivo;
        //saber cuantos digitos tiene el numero de acta
        $numero_digitos = strlen($numero_acta);
        if($numero_digitos == 1){
            $numero_acta = '00'.$numero_acta;
        }elseif($numero_digitos == 2){
            $numero_acta = '0'.$numero_acta;
        }

        //agregarle /anio al numero de acta
        $numero_acta = $numero_acta.'/'.$alumno->anio_graduacion;

        return $numero_acta;
    }

    //Generar Carta de No Adeudo
    public function generarformatoNoAdeudo(Alumno $alumno)
    { 
        //Descargar el documento con los datos
        try{
            $time = Carbon::now(); 
            $fecha_tit = $alumno->fecha_titulacion; //$time->format('d/m/Y');
            $fecha_titulacion = date("d/m/Y", strtotime($fecha_tit));
            $hora_actual = $alumno->hora_inicio_citatorio; //$time->format('H:i');
            $num_acta = $this->retornarNumActa($alumno); //Numero de acta
            $codigo = $alumno->user->codigo; //Codigo del alumno            
            $meses = array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");        
            $mes = $meses[($time->format('n')) - 1];   
            $dia = $time->format('d');
            $anio = $time->format('Y');
            
        }catch(\Exception $e){
            return redirect()->route('showTramite',$alumno)->with('info', 'Ha ocurrido un error al generar el documento.');
        }  
        try{
            $pdf = PDF::loadView('layout.admin.cartaNoAdeudoBiblioteca', compact('alumno','dia','mes','anio'));
            $pdf->setPaper('letter', 'landscape');

            //return $pdf->stream();

            $tramite = $alumno->tramite;
            $nombre_ruta = $alumno->user_id . "_" . $alumno->user->name;
            $ruta = 'alumnos/' . $nombre_ruta . '/documentos/Constancia_No_Adeudo_Biblioteca.pdf';

            //Storage::put($ruta, file_get_contents($tempFile)); // Guardar el contenido del archivo                                

            //GUARDA DATOS DEL DOCUMENTO EN LA BD
            $documento = new Documento();
            $documento->ruta = $ruta;
            $documento->nombre_original = "Constancia de No Adeudo Bilbioteca.pdf";
            $documento->mime =  "application/pdf";;
            $documento->user_id = $alumno->user_id;
            $documento->id_alumno = $alumno->id;
            $documento->tramite_id = $tramite->id;
            $documento->nombre_documento = "Constancia de No Adeudo Biblioteca";
            $documento->aprobado = 4;                                   

            $documento->save();     
            
            $alumno->alumno_docs->constancia_no_adeudo_biblioteca = 1;
            $alumno->alumno_docs->save();
            
            //GUARDAR EN CARPETA DE SERVIDOR
            $content = $pdf->download()->getOriginalContent();
            $content = $pdf->download()->getOriginalContent();
            Storage::put($ruta,$content);

            //AlumnoDocs::where('alumno_id', $alumno->id)->update(['carta_autorizacion' => 1]);
        
            /*$template = new \PhpOffice\PhpWord\TemplateProcessor('Formato_Carta_No_Adeudo.docx');
            //$template->setValue('num_acta', $num_acta);
            $template->setValue('alumno', $alumno->user->name);
            $template->setValue('codigo', $alumno->user->codigo);
            $template->setValue('carrera', mb_strtoupper($alumno->carrera->carrera));
            $template->setValue('dia', $time->format('d'));
            $template->setValue('mes', $mes);
            $template->setValue('anio', $time->format('Y'));                                          
                
            $tempFile = tempnam(sys_get_temp_dir(), 'PHPWord');
            $template->saveAs($tempFile);

            $tramite = $alumno->tramite;
            $nombre_ruta = $alumno->user_id . "_" . $alumno->user->name;
            $ruta = 'alumnos/' . $nombre_ruta . '/documentos/FormatoNoAdeudo.docx';

            Storage::put($ruta, file_get_contents($tempFile)); // Guardar el contenido del archivo                                

            //GUARDA DATOS DEL DOCUMENTO EN LA BD
            $documento = new Documento();
            $documento->ruta = $ruta;
            $documento->nombre_original = "FormatoNoAdeudo.docx";
            $documento->mime = "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
            $documento->user_id = $alumno->user_id;
            $documento->id_alumno = $alumno->id;
            $documento->tramite_id = $tramite->id;
            $documento->nombre_documento = "Constancia de No Adeudo Biblioteca";
            $documento->aprobado = 4;                                   

            $documento->save();  
            // Corregir la cabecera Content-Type
            $headers = array(
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            );      */      

            //response()->download($tempFile, "FormatoNoAdeudo.docx" , $headers)->deleteFileAfterSend(true);
            return redirect()->back()->with('success', 'Formato de No Adeudo creado');
        } catch (\PhpOffice\PhpWord\Exception\Exception $e) {
            return redirect()->route('showTramite',$alumno)->with('info', 'Ha ocurrido un error al generar el documento');
        }

    }

    public function generarformatoNoAdeudoCE(Alumno $alumno)
    { 
        //Descargar el documento con los datos
        try{
            $time = Carbon::now(); 
            $fecha_tit = $alumno->fecha_titulacion; //$time->format('d/m/Y');
            $fecha_titulacion = date("d/m/Y", strtotime($fecha_tit));
            $hora_actual = $alumno->hora_inicio_citatorio; //$time->format('H:i');
            $num_acta = $this->retornarNumActa($alumno); //Numero de acta
            $codigo = $alumno->user->codigo; //Codigo del alumno            
            $meses = array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");        
            $mes = $meses[($time->format('n')) - 1];   
            $dia = $time->format('d');
            $anio = $time->format('Y');
            
        }catch(\Exception $e){
            return redirect()->route('showTramite',$alumno)->with('info', 'Ha ocurrido un error al generar el documento ' . $e->getMessage());
        }  
        try{
            $pdf = PDF::loadView('layout.admin.cartaNoAdeudoBiblioteca', compact('alumno','dia','mes','anio'));
            $pdf->setPaper('letter', 'landscape');

            //return $pdf->stream();

            $tramite = $alumno->tramite;
            $nombre_ruta = $alumno->user_id . "_" . $alumno->user->name;
            $ruta = 'alumnos/' . $nombre_ruta . '/documentos/Constancia_No_Adeudo_Universidad.pdf';

            //Storage::put($ruta, file_get_contents($tempFile)); // Guardar el contenido del archivo                                

            //GUARDA DATOS DEL DOCUMENTO EN LA BD
            $documento = new Documento();
            $documento->ruta = $ruta;
            $documento->nombre_original = "Constancia de No Adeudo Universidad.pdf";
            $documento->mime =  "application/pdf";;
            $documento->user_id = $alumno->user_id;
            $documento->id_alumno = $alumno->id;
            $documento->tramite_id = $tramite->id;
            $documento->nombre_documento = "Constancia de No Adeudo Universidad";
            $documento->aprobado = 4;                                   

            $documento->save();     
            
            $alumno->alumno_docs->constancia_no_adeudo_universidad = 1;
            $alumno->alumno_docs->save();
            
            //GUARDAR EN CARPETA DE SERVIDOR
            $content = $pdf->download()->getOriginalContent();
            $content = $pdf->download()->getOriginalContent();
            Storage::put($ruta,$content);     
            
            return redirect()->back()->with('success', 'Formato de No Adeudo creado');
        } catch (\PhpOffice\PhpWord\Exception\Exception $e) {
            return redirect()->route('showTramite',$alumno)->with('info', 'Ha ocurrido un error al generar el documento');
        }

    }

    //Generar Acta de Titulacion
    public function generarDocumentoActaTitulacion(Alumno $alumno)
    {
        //Descargar el documento con los datos
        try{
            //$time = Carbon::now(); 
            $fecha_tit = $alumno->fecha_titulacion; //$time->format('d/m/Y');
            $fecha_titulacion = date("d/m/Y", strtotime($fecha_tit));
            $hora_actual = $alumno->hora_inicio_citatorio; //$time->format('H:i');
            $num_acta = $this->retornarNumActa($alumno); //Numero de acta
            $codigo = $alumno->user->codigo; //Codigo del alumno
            $dia_titulacion = $this->setDiaFechaTitulacion($alumno); //Fecha de titulacion
            $mes_titulacion = $this->setMesFechaTitulacion($alumno); //Fecha de titulacion
            $anio_titulacion = $alumno->anio_graduacion; //Fecha de titulacion
            $presidente = $this->retornarMaestroGrado($alumno->id_maestro_presidente);//Presidente
            $secretario = $this->retornarMaestroGrado($alumno->id_maestro_secretario);//Secretario
            $vocal = $this->retornarMaestroGrado($alumno->id_maestro_vocal);//Vocal
            $lugar = $alumno->lugar_de_ceremonia;

            $carrera_id = Carrera::where('id', $alumno->id_carrera)->first();
            $carrera = mb_strtoupper($carrera_id->carrera) ; //Titulo de la carrera
        }catch(\Exception $e){
            echo $e;
            dd();
            return redirect()->route('showTramite',$alumno)->with('info', 'Ha ocurrido un error al generar el documento ' . $e->getMessage());
        }        

        $pasante = mb_strtoupper($alumno->user->name); //Pasante
        $titulo = $this->setCarreraGenero($alumno); //Titulo de la carrera

        //sacar de "Articulo 12. Modalidad de Investigación y Estudio de Posgrado" el numero de articulo
        $articulo = Articulo::where('id', $alumno->id_articulo)->first();
        $num_art = $articulo->numero_articulo;
        $modalidad = mb_strtoupper($articulo->modalidad);

        //sacar de la opcion de titulacion "I. Excelencia académica". el numero de la opcion
        $opcion = OpcionTitulacion::where('id', $alumno->id_opcion_titulacion)->first();
        $fraccion = substr($opcion->nombre, 0, strpos($opcion->nombre, '.'));
        $opcion_tit = $opcion->opcion;
        $opcion_tit = mb_strtoupper($opcion_tit);

        $titulo_trabajo = mb_strtoupper($alumno->titulo_del_trabajo); //Titulo del trabajo

        $sustentante = $pasante; //Sustentante
        $secretario_division = $this->retornarMaestroGrado($alumno->id_secretario_division);//Vocal
        $director_division = $this->retornarMaestroGrado($alumno->id_director_division);//Vocal

        $formatterES = new NumberFormatter("es", NumberFormatter::SPELLOUT);

        //si es examen de capacitacion
        if($alumno->id_opcion_titulacion == 6){
            //$calificacion_examen_capacitacion = $formatterES->format($alumno->calificacion_examen_capacitacion);
            $calificacion_examen_capacitacion = $formatterES->format($alumno->calificacion_examen_capacitacion);
            //remplazar coma por punto
            $calificacion_examen_capacitacion = str_replace('coma', 'punto', $calificacion_examen_capacitacion);
            $calificacion_examen_capacitacion = mb_strtoupper($calificacion_examen_capacitacion);
            $calificacion_examen_capacitacion = $alumno->calificacion_examen_capacitacion . " (". $calificacion_examen_capacitacion .")";
        }
        //Ceneval
        else if($alumno->id_opcion_titulacion == 5){
            $puntos_globales = $alumno->puntos_globales_ceneval;

            $promedio_ceneval = $formatterES->format($alumno->promedio_examenes_ceneval);
            //remplazar coma por punto
            $promedio_ceneval = str_replace('coma', 'punto', $promedio_ceneval);
            $promedio_ceneval = mb_strtoupper($promedio_ceneval);
            $promedio_ceneval = $alumno->promedio_examenes_ceneval . " (". $promedio_ceneval .")";
        }
        //Cursos o creditos
        else if($alumno->id_opcion_titulacion == 9){

            $calificacion_curso = $formatterES->format($alumno->calificacion_curso);
            $calificacion_curso = str_replace('coma', 'punto', $calificacion_curso);
            $calificacion_curso = mb_strtoupper($calificacion_curso);
            $calificacion_curso = $alumno->calificacion_curso . " (". $calificacion_curso .")";

            $nombre_del_curso = mb_strtoupper($alumno->nombre_del_curso);

            $cant_materias = $alumno->cant_materias;
        }
        //Global Teorico
        else if($alumno->id_opcion_titulacion == 4){

            $materia_1_global_teorico = mb_strtoupper($alumno->materia_1_global_teorico);
            $materia_2_global_teorico = mb_strtoupper($alumno->materia_2_global_teorico);
            $materia_3_global_teorico = mb_strtoupper($alumno->materia_3_global_teorico);
            $materia_4_global_teorico = mb_strtoupper($alumno->materia_4_global_teorico);

            $calificacion = $alumno->promedio_global_teorico;
            $calificacion = round($calificacion, 1);
            $calificacion_letras = $this->retornarCalificacionLetra($calificacion);//Calificacion
            $calificacion .= " ". $calificacion_letras;

        }
        //Excelencia Academica
        else if($alumno->id_articulo == 1){

            $promedio = $alumno->promedio;
            $promedio = number_format($promedio, 2);

            //checar si después del punto hay un cero
            if( substr($promedio, strpos($promedio, '.')+1, 1) == "0"){
                $promedio = $formatterES->format($promedio);
                $promedio = str_replace('coma', 'punto', $promedio);
            }else{
                //Dividir el promedio antes y después del punto
                $promedio_antes = substr($promedio, 0, strpos($promedio, '.'));
                $promedio_despues = substr($promedio, strpos($promedio, '.')+1, strlen($promedio));

                $promedio_antes = $formatterES->format($promedio_antes);
                $promedio_despues = $formatterES->format($promedio_despues);

                $promedio = $promedio_antes . " punto " . $promedio_despues;
            }

            $promedio = mb_strtoupper($promedio);
            $prom = number_format($alumno->promedio, 2);
            $promedio_numero = (string)$prom;
            $promedio =  $promedio_numero . " (". $promedio .")";

        }else{

            //redondear el promedio
            $calificacion = $alumno->calificacion_trabajo; //Calificacion
            $calificacion = round($calificacion, 1);
            $calificacion_letras = $this->retornarCalificacionLetra($calificacion);//Calificacion
            $calificacion .= " ". $calificacion_letras;
        }
        
        if(($alumno->id_opcion_titulacion >= 11 && $alumno->id_opcion_titulacion <= 16 ) || $alumno->id_opcion_titulacion == 7){
            $acta_segun_opcion = 'Formato_Acta_Nueva_Jurado.docx';
        }else{
            $acta_segun_opcion = 'Formato_Acta_Nueva_Comite.docx';
        }

        try{
            $template = new \PhpOffice\PhpWord\TemplateProcessor($acta_segun_opcion);
            $template->setValue('num_acta', $num_acta);
            $template->setValue('codigo', $codigo);
            $template->setValue('fecha', $fecha_titulacion);
            $template->setValue('hora', $hora_actual);
            $template->setValue('lugar', $lugar);
            $template->setValue('presidente', $presidente);
            $template->setValue('secretario', $secretario);
            $template->setValue('vocal', $vocal);
            $template->setValue('carrera', $carrera);
            $template->setValue('pasante', $pasante);
            $template->setValue('titulo', $titulo);
            $template->setValue('modalidad', $modalidad);
            $template->setValue('opcion_tit', $opcion_tit);
            $template->setValue('sustentante', $sustentante);
            $template->setValue('secretario_division', $secretario_division);
            $template->setValue('director_division', $director_division);

            //Examen de capacitacion
            if($alumno->id_opcion_titulacion == 6){
                $template->setValue('promedio', $calificacion_examen_capacitacion);
            //Ceneval
            }else if ($alumno->id_opcion_titulacion == 5){
                $template->setValue('promedio', $promedio_ceneval);
            }
            //Global Teorico
            else if($alumno->id_opcion_titulacion == 4){                
                $template->setValue('promedio', $calificacion);
            }
            else if ($alumno->id_opcion_titulacion == 9){
                $template->setValue('promedio', $calificacion_curso);
            }
            else if ($alumno->id_articulo == 1){
                $template->setValue('promedio', $promedio);
            }
            else{
                $template->setValue('titulo_trabajo', $titulo_trabajo);
                $template->setValue('calificacion', $calificacion);
            }            


            $tempFile = tempnam(sys_get_temp_dir(), 'PHPWord');
            $template->saveAs($tempFile);

            $headers = array(
                'Content-Type' => 'octet-stream',
            );

            $nombre_doc = 'ACTA '. mb_strtoupper((string)$alumno->user->name).'.docx';

            return response()->download($tempFile, $nombre_doc , $headers)->deleteFileAfterSend(true);

        } catch (\PhpOffice\PhpWord\Exception\Exception $e) {
            return redirect()->route('showTramite',$alumno)->with('info', 'Ha ocurrido un error al generar el documento');
        }        

    }

    public function generarDocumentoProtesta(Alumno $alumno)
    {        
        //Descargar el documento con los datos
        $fecha_titulacion = $this->setFecha($alumno->fecha_titulacion); //Fecha de titulacion
        $titulo = $this->setCarreraGenero($alumno); //Titulo de la carrera
        //Poner si es justa o justo
        if($alumno->genero == 'M'){
            $justa_justo = 'justa';
        }else{
            $justa_justo = 'justo';
        }
        $sustentante = mb_strtoupper($alumno->user->name); //Sustentante
        $presidente = $this->retornarMaestroGrado($alumno->id_maestro_presidente);//Presidente
        $secretario = $this->retornarMaestroGrado($alumno->id_maestro_secretario);//Secretario
        $vocal = $this->retornarMaestroGrado($alumno->id_maestro_vocal);//Vocal
        $secretario_division = $this->retornarMaestroGrado($alumno->id_secretario_division);//Vocal
        $director_division = $this->retornarMaestroGrado($alumno->id_director_division);//Vocal

        try{
            $template = new \PhpOffice\PhpWord\TemplateProcessor('Formato_Protesta_Nueva.docx');
            //$template = new \PhpOffice\PhpWord\TemplateProcessor('Formato_Protesta.docx');
            $template->setValue('fecha_titulacion', $fecha_titulacion);
            $template->setValue('titulo', $titulo);
            $template->setValue('justa_justo', $justa_justo);
            $template->setValue('sustentante', $sustentante);
            $template->setValue('presidente', $presidente);
            $template->setValue('secretario', $secretario);
            $template->setValue('vocal', $vocal);
            $template->setValue('director_division', $director_division);
            $template->setValue('secretario_division', $secretario_division);

            $tempFile = tempnam(sys_get_temp_dir(), 'PHPWord');
            $template->saveAs($tempFile);

            $headers = array(
                'Content-Type' => 'octet-stream',
            );

            $nombre_doc = 'PROTESTA '. mb_strtoupper((string)$alumno->user->name).'.docx';

            return response()->download($tempFile, $nombre_doc , $headers)->deleteFileAfterSend(true);

        } catch (\PhpOffice\PhpWord\Exception\Exception $e) {
            return redirect()->route('showTramite',$alumno)->with('info', 'Ha ocurrido un error al generar el documento');
        }

    }
    //Retorna el dia de la titulacion en el formato 12 (DOCE)
    public function setDiaFechaTitulacion(Alumno $alumno){
        $dia_titulacion = $alumno->fecha_titulacion;
        $dia_titulacion = date('d', strtotime($dia_titulacion));
        $dia_a_letra = $this->setDiaALetras($dia_titulacion);

        $dia_titulacion .= " (" . $dia_a_letra . ")";

        return $dia_titulacion;
    }

    //Retorna el dia de la titulacion en el formato 12 (DOCE)
    public function setDiaALetras($dia_titulacion){
        //convertir el dia a letras Ejemplo: 12 (DOCE)
        switch ($dia_titulacion) {
            case '00':
                $dia_titulacion = 'CERO';
                break;
            case '01':
                $dia_titulacion = 'UNO';
                break;
            case '02':
                $dia_titulacion = 'DOS';
                break;
            case '03':
                $dia_titulacion = 'TRES';
                break;
            case '04':
                $dia_titulacion = 'CUATRO';
                break;
            case '05':
                $dia_titulacion = 'CINCO';
                break;
            case '06':
                $dia_titulacion = 'SEIS';
                break;
            case '07':
                $dia_titulacion = 'SIETE';
                break;
            case '08':
                $dia_titulacion = 'OCHO';
                break;
            case '09':
                $dia_titulacion = 'NUEVE';
                break;
            case '10':
                $dia_titulacion = 'DIEZ';
                break;
            case '11':
                $dia_titulacion = 'ONCE';
                break;
            case '12':
                $dia_titulacion = 'DOCE';
                break;
            case '13':
                $dia_titulacion = 'TRECE';
                break;
            case '14':
                $dia_titulacion = 'CATORCE';
                break;
            case '15':
                $dia_titulacion = 'QUINCE';
                break;
            case '16':
                $dia_titulacion = 'DIECISEIS';
                break;
            case '17':
                $dia_titulacion = 'DIECISIETE';
                break;
            case '18':
                $dia_titulacion = 'DIECIOCHO';
                break;
            case '19':
                $dia_titulacion = 'DIECINUEVE';
                break;
            case '20':
                $dia_titulacion = 'VEINTE';
                break;
            case '21':
                $dia_titulacion = 'VEINTIUNO';
                break;
            case '22':
                $dia_titulacion = 'VEINTIDOS';
                break;
            case '23':
                $dia_titulacion = 'VEINTITRES';
                break;
            case '24':
                $dia_titulacion = 'VEINTICUATRO';
                break;
            case '25':
                $dia_titulacion = 'VEINTICINCO';
                break;
            case '26':
                $dia_titulacion = 'VEINTISEIS';
                break;
            case '27':
                $dia_titulacion = 'VEINTISIETE';
                break;
            case '28':
                $dia_titulacion = 'VEINTIOCHO';
                break;
            case '29':
                $dia_titulacion = 'VEINTINUEVE';
                break;
            case '30':
                $dia_titulacion = 'TREINTA';
                break;
            case '31':
                $dia_titulacion = 'TREINTA Y UNO';
                break;
        }

        return $dia_titulacion;
    }

    //Retorna el mes de la titulacion en el formato ENERO, FEBRERO, MARZO, etc
    public function setMesFechaTitulacion(Alumno $alumno){
        $mes_titulacion = $alumno->fecha_titulacion;
        $mes_titulacion = date('m', strtotime($mes_titulacion));
        $mes_titulacion = $this->setMesALetras($mes_titulacion);

        return $mes_titulacion;
    }

    //Retorna el mes de la titulacion en el formato ENERO, FEBRERO, MARZO, etc
    public function setMesALetras($mes_titulacion){
        //convertir el dia a letras Ejemplo: 12 (DOCE)
        switch ($mes_titulacion) {
            case '01':
                $mes_titulacion = 'ENERO';
                break;
            case '02':
                $mes_titulacion = 'FEBRERO';
                break;
            case '03':
                $mes_titulacion = 'MARZO';
                break;
            case '04':
                $mes_titulacion = 'ABRIL';
                break;
            case '05':
                $mes_titulacion = 'MAYO';
                break;
            case '06':
                $mes_titulacion = 'JUNIO';
                break;
            case '07':
                $mes_titulacion = 'JULIO';
                break;
            case '08':
                $mes_titulacion = 'AGOSTO';
                break;
            case '09':
                $mes_titulacion = 'SEPTIEMBRE';
                break;
            case '10':
                $mes_titulacion = 'OCTUBRE';
                break;
            case '11':
                $mes_titulacion = 'NOVIEMBRE';
                break;
            case '12':
                $mes_titulacion = 'DICIEMBRE';
                break;
        }

        return $mes_titulacion;
    }

    //Funcion para retornar al maestro de la forma DR. NOMBRE_MAESTRO
    public function setCarreraGenero(Alumno $alumno)
    {
        //Buscar la carrera
        $carrera_id = Carrera::where('id', $alumno->id_carrera)->first();

        //Si es licenciatura
        //Genero
        if($carrera_id->id == 3){
            //Poner Licenciada si es mujer o Licenciado si es hombre
            if($alumno->genero == 'M'){
                $genero = 'LICENCIADA EN INFORMÁTICA';
            }else{
                $genero = 'LICENCIADO EN INFORMÁTICA';
            }

        }else{
            //Poner Ingeniera si es mujer o Ingeniero si es hombre
            if($alumno->genero == 'M'){
                $genero = 'INGENIERA';
            }else{
                $genero = 'INGENIERO';
            }
        }

        $carrera = $genero;

        if($carrera_id->id == 1){
            if($alumno->genero == 'H'){
                $carrera .= ' BIOMÉDICO';
            }else{
                $carrera .= ' BIOMÉDICA';
            }
        }

        if($carrera_id->id == 2){
            //Poner Si es informatico Si es femenino como quiera se queda así
            if($alumno->genero == 'H'){
                $carrera .= ' INFORMÁTICO';
            }else{
                $carrera .= ' INFORMÁTICA';
            }
        }

        if($carrera_id->id == 4){
            $carrera .= ' EN COMUNICACIONES Y ELECTRÓNICA';
        }

        if($carrera_id->id == 5){
            $carrera .= ' EN COMPUTACIÓN';
        }

        if($carrera_id->id == 6){
            $carrera .= ' EN FOTÓNICA';
            //Sustituir Robotica por En Robotica
            // $carrera = str_replace('Fotónica', $info, $carrera);
        }

        if($carrera_id->id == 7){
            $carrera .= ' EN ROBÓTICA';
            //Sustituir Robotica por En Robotica
            // $carrera = str_replace('Robótica', $info, $carrera);
        }

        $carrera = mb_strtoupper($carrera);

        return $carrera;
    }

    //Funcion para retornar al maestro de la forma DR. NOMBRE_MAESTRO
    public function setCarreraGenerosinmayus(Alumno $alumno)
    {
        //Buscar la carrera
        $carrera_id = Carrera::where('id', $alumno->id_carrera)->first();

        //Si es licenciatura
        if($carrera_id->id == 3){
            //Poner Licenciada si es mujer o Licenciado si es hombre
            if($alumno->genero == 'M'){
                $genero = 'Licenciada';
            }else{
                $genero = 'Licenciado';
            }

            //Sustituir Ingeniería segun el genero
            $carrera_id = str_replace('Licenciatura', $genero, $carrera_id->carrera);

        }else{
            //Poner Ingeniera si es mujer o Ingeniero si es hombre
            if($alumno->genero == 'M'){
                $genero = 'Ingeniera';
            }else{
                $genero = 'Ingeniero';
            }

            //Sustituir Ingeniería segun el genero
            $carrera = str_replace('Ingeniería', $genero, $carrera_id->carrera);
        }


        return $carrera;
    }

    //Retorna la calificacion del alumno en el formato 100 (CIEN)
    public function retornarHoraLetras($hora_completa){
        //horas
        $horas = substr($hora_completa, 0, 2);
        $horas = $this->setDiaALetras($horas);
        $horas = mb_strtolower($horas);

        //minutos
        $minutos = substr($hora_completa, 3, 2);
        $minutos = $this->setMinutosLetras($minutos);
        $minutos = mb_strtolower($minutos);

        $hora_completa = $horas." horas y ".$minutos ." minutos";

        return $hora_completa;
    }

    //Funcion para subir acta firmada
    public function setMinutosLetras($calificacion)
    {
        switch($calificacion){
        case '01':
            $calificacion = 'UNO';
            break;
        case '02':
            $calificacion = 'DOS';
            break;
        case '03':
            $calificacion = 'TRES';
            break;
        case '04':
            $calificacion = 'CUATRO';
            break;
        case '05':
            $calificacion = 'CINCO';
            break;
        case '06':
            $calificacion = 'SEIS';
            break;
        case '07':
            $calificacion = 'SIETE';
            break;
        case '08':
            $calificacion = 'OCHO';
            break;
        case '09':
            $calificacion = 'NUEVE';
            break;
        case '10':
            $calificacion = 'DIEZ';
            break;
        case '11':
            $calificacion = 'ONCE';
            break;
        case '12':
            $calificacion = 'DOCE';
            break;
        case '13':
            $calificacion = 'TRECE';
            break;
        case '14':
            $calificacion = 'CATORCE';
            break;
        case '15':
            $calificacion = 'QUINCE';
            break;
        case '16':
            $calificacion = 'DIECISEIS';
            break;
        case '17':
            $calificacion = 'DIECISIETE';
            break;
        case '18':
            $calificacion = 'DIECIOCHO';
            break;
        case '19':
            $calificacion = 'DIECINUEVE';
            break;
        case '20':
            $calificacion = 'VEINTE';
            break;
        case '21':
            $calificacion = 'VEINTIUNO';
            break;
        case '22':
            $calificacion = 'VEINTIDOS';
            break;
        case '23':
            $calificacion = 'VEINTITRES';
            break;
        case '24':
            $calificacion = 'VEINTICUATRO';
            break;
        case '25':
            $calificacion = 'VEINTICINCO';
            break;
        case '26':
            $calificacion = 'VEINTISEIS';
            break;
        case '27':
            $calificacion = 'VEINTISIETE';
            break;
        case '28':
            $calificacion = 'VEINTIOCHO';
            break;
        case '29':
            $calificacion = 'VEINTINUEVE';
            break;
        case '30':
            $calificacion = 'TREINTA';
            break;
        case '31':
            $calificacion = 'TREINTA Y UNO';
            break;
        case '32':
            $calificacion = 'TREINTA Y DOS';
            break;
        case '33':
            $calificacion = 'TREINTA Y TRES';
            break;
        case '34':
            $calificacion = 'TREINTA Y CUATRO';
            break;
        case '35':
            $calificacion = 'TREINTA Y CINCO';
            break;
        case '36':
            $calificacion = 'TREINTA Y SEIS';
            break;
        case '37':
            $calificacion = 'TREINTA Y SIETE';
            break;
        case '38':
            $calificacion = 'TREINTA Y OCHO';
            break;
        case '39':
            $calificacion = 'TREINTA Y NUEVE';
            break;
        case '40':
            $calificacion = 'CUARENTA';
            break;
        case '41':
            $calificacion = 'CUARENTA Y UNO';
            break;
        case '42':
            $calificacion = 'CUARENTA Y DOS';
            break;
        case '43':
            $calificacion = 'CUARENTA Y TRES';
            break;
        case '44':
            $calificacion = 'CUARENTA Y CUATRO';
            break;
        case '45':
            $calificacion = 'CUARENTA Y CINCO';
            break;
        case '46':
            $calificacion = 'CUARENTA Y SEIS';
            break;
        case '47':
            $calificacion = 'CUARENTA Y SIETE';
            break;
        case '48':
            $calificacion = 'CUARENTA Y OCHO';
            break;
        case '49':
            $calificacion = 'CUARENTA Y NUEVE';
            break;
        case '50':
            $calificacion = 'CINCUENTA';
            break;
        case '51':
            $calificacion = 'CINCUENTA Y UNO';
            break;
        case '52':
            $calificacion = 'CINCUENTA Y DOS';
            break;
        case '53':
            $calificacion = 'CINCUENTA Y TRES';
            break;
        case '54':
            $calificacion = 'CINCUENTA Y CUATRO';
            break;
        case '55':
            $calificacion = 'CINCUENTA Y CINCO';
            break;
        case '56':
            $calificacion = 'CINCUENTA Y SEIS';
            break;
        case '57':
            $calificacion = 'CINCUENTA Y SIETE';
            break;
        case '58':
            $calificacion = 'CINCUENTA Y OCHO';
            break;
        case '59':
            $calificacion = 'CINCUENTA Y NUEVE';
            break;
        case '60':
            $calificacion = 'SESENTA';
            break;
        }
        return $calificacion;
    }

     //Funcion para retornar al maestro de la forma DR. NOMBRE_MAESTRO
     public function setFecha($fecha)
     {
         //Poner fecha en formato: miercoles, 12 de enero de 2020
         $fecha_corregida = Carbon::parse($fecha)->formatLocalized('%A %d de %B de %Y');
         //Traducir la fecha a español
         $fecha_corregida = str_replace('Monday', 'lunes', $fecha_corregida);
         $fecha_corregida = str_replace('Tuesday', 'martes', $fecha_corregida);
         $fecha_corregida = str_replace('Wednesday', 'miércoles', $fecha_corregida);
         $fecha_corregida = str_replace('Thursday', 'jueves', $fecha_corregida);
         $fecha_corregida = str_replace('Friday', 'viernes', $fecha_corregida);
         $fecha_corregida = str_replace('Saturday', 'sábado', $fecha_corregida);
         $fecha_corregida = str_replace('Sunday', 'domingo', $fecha_corregida);
 
         $fecha_corregida = str_replace('January', 'enero', $fecha_corregida);
         $fecha_corregida = str_replace('February', 'febrero', $fecha_corregida);
         $fecha_corregida = str_replace('March', 'marzo', $fecha_corregida);
         $fecha_corregida = str_replace('April', 'abril', $fecha_corregida);
         $fecha_corregida = str_replace('May', 'mayo', $fecha_corregida);
         $fecha_corregida = str_replace('June', 'junio', $fecha_corregida);
         $fecha_corregida = str_replace('July', 'julio', $fecha_corregida);
         $fecha_corregida = str_replace('August', 'agosto', $fecha_corregida);
         $fecha_corregida = str_replace('September', 'septiembre', $fecha_corregida);
         $fecha_corregida = str_replace('October', 'octubre', $fecha_corregida);
         $fecha_corregida = str_replace('November', 'noviembre', $fecha_corregida);
         $fecha_corregida = str_replace('December', 'diciembre', $fecha_corregida);
 
         return $fecha_corregida;
     }

     //Funcion para subir acta firmada
    public function subirActaFirmada(Request $request, Alumno $alumno)
    {

        $max_size = (int) ini_get('upload_max_filesize') * 10240;
        //user_id
        //alumno
        $id_alumno = $alumno->id;
        $nombre = (string)$alumno->user_id;
        $nombre_alumno = (string)$alumno->user->codigo;
        $nombre_ruta =  $nombre . "_" . $nombre_alumno;

        //VALIDACION DE ARCHIVOS
        $request->validate([
            'acta_firmada' => 'required|file|max:'.$max_size
        ]);

         //Actualizar el estado del alumno
        Alumno::where('id', '=', $id_alumno)->update(['acta_firmada' => 1]);
        $tramite = Tramite::where('alumno_id', '=', $id_alumno)->first();
        $id_tramite = $tramite->id;

        try {
            //GUARDAR DOCUMENTO
            if ($request->hasFile('acta_firmada') && $request->file('acta_firmada')->isValid()) {

                $ruta = $request->acta_firmada->store('alumnos/' . $nombre_ruta . '/documentos');
                $documento = new Documento();
                $documento->ruta = $ruta;
                $documento->nombre_original = $request->acta_firmada->getClientOriginalName();
                $documento->mime = $request->acta_firmada->getClientMimeType();
                $documento->user_id = $alumno->user_id;
                $documento->id_alumno = $id_alumno;
                $documento->tramite_id = $id_tramite;
                $documento->nombre_documento = 'Acta de Titulacion Firmada';
                $documento->aprobado = 4;

                $documento->save();     
            }
        } catch (\Exception $e) {
             return redirect()->back()->with('error', 'Error al subir el archivo');
        }

        return redirect()->route('showTramite', $alumno)->with('success','Documento de Acta de Titulación Firmada subido correctamente');

    }

     //Generar Acta Circunstanciada
     public function generarDocumentoActaCircunstanciada(Alumno $alumno)
     {
         //Descargar el documento con los datos
         $dia_titulacion = $this->setDiaFechaTitulacion($alumno); //Fecha de titulacion
         $dia_titulacion = mb_strtolower($dia_titulacion);
         $mes_titulacion = $this->setMesFechaTitulacion($alumno); //Fecha de titulacion
         $mes_titulacion = mb_strtolower($mes_titulacion);
         $anio_titulacion = $alumno->anio_graduacion; //Fecha de titulacion
         $anio_titulacion = mb_strtolower($anio_titulacion);
 
         //Secretario de division
         $secretario_division_id = Maestro::where('id', $alumno->id_secretario_division)->first();
 
         $secretario_division = $secretario_division_id->nombre;
 
         if($secretario_division_id->grado == 'Doctorado'){
             if ($secretario_division_id->genero == 'H') {
                 $secretario_division = 'Dr. ' . $secretario_division;
             }else{
                 $secretario_division = 'Dra. ' . $secretario_division;
             }
         }
         else {
             if ($secretario_division_id->genero == 'H') {
                 $secretario_division = 'Mtro. ' . $secretario_division;
             }else{
                 $secretario_division = 'Mtra. ' . $secretario_division;
             }
         }
 
         //Poner si "el _nombre" o "la _nombre"
         if($alumno->genero == 'H'){
             $la_el = 'el';
         }else{
             $la_el = 'la';
         }
 
         //Poner si "el _nombre" o "la _nombre" en mayuscula
         if($alumno->genero == 'H'){
             $el_la_may = 'El';
         }else{
             $el_la_may = 'La';
         }
 
         $nombre = mb_strtoupper($alumno->user->name); //Nombre del alumno
         $codigo = $alumno->user->codigo; //Codigo del alumno
         //Carrera
         $carrera_id = Carrera::where('id', $alumno->id_carrera)->first();
         $carrera = $carrera_id->carrera; //Titulo de la carrera
 
         $titulo = $this->setCarreraGenerosinmayus($alumno); //Titulo de la carrera
 
         //poner si es referida o referido
         if($alumno->genero == 'H'){
             $referida_referido = 'referido';
         }else{
             $referida_referido = 'referida';
         }
 
 
         $num_acta = $this->retornarNumActa($alumno); //Numero de acta
 
         //sacar el dia de la fecha de titulacion
         $dia_acta = $alumno->fecha_titulacion;
         $dia_acta = date('d', strtotime($dia_acta));
         $enlace = $alumno->lugar_de_ceremonia; //Lugar de la ceremonia
 
         $presidente = $this->retornarMaestroGrado($alumno->id_maestro_presidente);//Presidente
         $secretario = $this->retornarMaestroGrado($alumno->id_maestro_secretario);//Secretario
         $vocal = $this->retornarMaestroGrado($alumno->id_maestro_vocal);//Vocal
         //Hora de fin de la ceremonia
         $hora_fin = $alumno->hora_fin_citatorio;
         $hora_fin = date('H:i', strtotime($hora_fin));
 
         $hora_letras = $this->retornarHoraLetras($alumno->hora_fin_citatorio); //Hora de fin de la ceremonia
 
         try{
             $template = new \PhpOffice\PhpWord\TemplateProcessor('Formato_Acta_Circunstanciada_Online.docx');
             $template->setValue('dia', $dia_titulacion);
             $template->setValue('mes', $mes_titulacion);
             $template->setValue('anio', $anio_titulacion);
             $template->setValue('secretario_division', $secretario_division);
             $template->setValue('el_la', $la_el);
             $template->setValue('nombre', $nombre);
             $template->setValue('codigo', $codigo);
             $template->setValue('carrera', $carrera);
             $template->setValue('titulo', $titulo);
             $template->setValue('referida_referido', $referida_referido);
             $template->setValue('num_acta', $num_acta);
             $template->setValue('dia_acta', $dia_acta);
             $template->setValue('presidente', $presidente);
             $template->setValue('secretario', $secretario);
             $template->setValue('vocal', $vocal);
             $template->setValue('enlace', $enlace);
             $template->setValue('hora_fin', $hora_fin);
             $template->setValue('hora_letras', $hora_letras);
             $template->setValue('el_la_may', $el_la_may);
 
             $tempFile = tempnam(sys_get_temp_dir(), 'PHPWord');
             $template->saveAs($tempFile);
 
             $headers = array(
                 'Content-Type' => 'octet-stream',
             );
 
             $nombre_doc = 'ACTA CIRCUNSTANCIADA '. mb_strtoupper((string)$alumno->user->name).'.docx';
 
             return response()->download($tempFile, $nombre_doc , $headers)->deleteFileAfterSend(true);
 
         } catch (\PhpOffice\PhpWord\Exception\Exception $e) {
            return redirect()->route('showTramite',$alumno)->with('info', 'Ha ocurrido un error al generar el documento');
         }
 
     }

     //Tramites
    public function eliminarTramite(Request $request, Alumno $alumno)
    {
        $tramite = $alumno->tramite;
        $user = $alumno->user;
        $value = Hash::check($request->password, auth()->user()->password);

        if ($value == false) {
            $request->validate([
                'password' => 'required|current_password',
            ]);
        }

        try{
            //Eliminar los documentos del tramite
            $documentos = Documento::where('tramite_id', $tramite->id)->get();

            //alumno
            $alumnoDocs = $alumno->alumno_docs;

            $nombre = (string)$alumno->user_id;
            $nombre_ruta =  $nombre . "_" . $alumno->user->name;

            $directory = 'alumnos/' . $nombre_ruta;

            Storage::deleteDirectory($directory);

            foreach ($documentos as $documento) {
                //Eliminamos el documento del almacenamiento
                Storage::delete($documento->ruta);

                //Eliminamos el documento de la base de datos
                $documento->delete();
            }

            //Eliminar el tramite
            $tramite->delete();
            $alumnoDocs->delete();

            //Eliminar el alumno del tramite            
            $alumno->delete();
            $user->delete();
        } catch (Exception $e) {
            return redirect()->route('tramites')->with('info', $e.' Ocurrio un error al eliminar el tramite.');
        }

        return redirect()->route('tramites')->with('success', 'Tramite eliminado correctamente.');
    }

    public function createTramite()
    {
        $carreras = DB::table('carreras')->get();
        $plan_estudios = DB::table('plan_estudios')->get();
        $articulos = DB::table('articulos')->get();
        $opciones_titulacion = DB::table('opciones_titulacion')->get();
        $user = Auth::user();

        return view('admin.datos-escolares-form', compact('user','carreras','plan_estudios', 'articulos', 'opciones_titulacion'));
    }

    public function setDatosInfo(Request $request){               
        //Validacion de campos
        $request->validate([
            'nombre' => 'required|string|min:5|max:255',                     
            'codigo' => 'required|min:9|max:9|unique:users',
            'promedio' => 'required|numeric|min:0|max:100',
            'carrera' => 'required',
            'situacion' => 'required|string',            
            'ciclo_ingreso' => 'required|string',
            'ciclo_egreso' => 'required|string',
            'password' => 'required|string|min:6',
            'password_confirmed' => 'required|string|min:6',
            /*'plan_estudios' => 'required|numeric|min:1',
            'articulo' => 'required|numeric|min:1',
            'opciones_titulacion' => 'required|numeric|min:1',*/
        ]);  
        if ($request->password != $request->password_confirmed) {
            return redirect()->back()->with('info', 'Las contraseñas no coinciden');
        }   

        //Creacion del Usuario
        try{
            $user = new User();
            $user->name = $request->nombre;
            $user->codigo = $request->codigo;
            $user->password = Hash::make($request->password);
            $user->save();
        }catch(Exception $e){
            return redirect()->back()->with('info', 'Ya existe un alumno con ese código');
        }
        //Creacion del Alumno
        $alumno = new Alumno();

        $alumno->user_id = $user->id;
        $alumno->ciclo_ingreso = $request->ciclo_ingreso;
        $alumno->ciclo_egreso = $request->ciclo_egreso;
        $alumno->id_carrera = $request->carrera; 
        $alumno->promedio = $request->promedio;  
                        
        //Opcion_titulacion
        if($request->plan_estudios != 0)
            $alumno->id_articulo = $request->articulo;
        if($request->opciones_titulacion != 0)
            $alumno->id_opcion_titulacion = $request->opciones_titulacion;  
        //Plan_estudios
        if($request->plan_estudios != 0)
            $alumno->id_plan_estudios = $request->plan_estudios;                         
        $alumno->save();

        $id_alumno = DB::table('alumnos')->where('user_id', '=', $user->id)->get();

        //REGISTRAR TRAMITE
        $tramite = new Tramite();
        $tramite->alumno_id = $alumno->id;
        $tramite->estado = 1;
        $tramite->save();

        $alumnoDocs = new AlumnoDocs();
        $alumnoDocs->alumno_id = $alumno->id;
        $alumnoDocs->save(); 

        return redirect()->route('tramites')->with('success', 'El trámite se creo correctamente');

    
    }

    public function editTramite(Tramite $tramite)
    {

        $alumno = Alumno::where('id', $tramite->alumno_id)->first();
        $documentos = Documento::where('tramite_id', $tramite->id)->get();

        $carreras = DB::table('carreras')->get();
        $plan_estudios = DB::table('plan_estudios')->get();
        $articulos = DB::table('articulos')->get();
        $opciones_titulacion = DB::table('opciones_titulacion')->where('articulo_id','=',$alumno->id_articulo)->get();

        return view('admin.createTramite', compact('tramite', 'alumno', 'documentos', 'carreras', 'plan_estudios', 'articulos', 'opciones_titulacion'));
    }

    //Usuarios
    public function storeUsuarios(Request $request)
    {                
        //VALIDACION DE DATOS
        $request->validate([
            'nombre' => 'required|string|min:5|max:255',
            'tipo' => 'required|numeric',
            'carrera' =>'nullable|numeric',
            'password' => 'required|string|min:6',
            'password_confirmed' => 'required|string|min:6',
        ]);  

        if(is_numeric($request->codigo)){           
            $request->validate(['codigo' => 'required|numeric|unique:users',]);
        }else{
            $request->validate(['codigo' => 'required|string',]);
        }
        
        if ($request->password != $request->password_confirmed) {
            return redirect()->route('usuarios-form')->with('info', 'Las contraseñas no coinciden');
        }
        if ($request->tipo == 0) {
            return redirect()->route('usuarios-form')->with('info', 'Selecciona el tipo de usuario');
        }
        
        //CREAR USUARIO
        $user = new User();
        $user->name = $request->nombre;
        $user->codigo = $request->codigo;
        $user->password = Hash::make($request->password);
        $user->is_admin = 1;
        $user->admin_type = $request->tipo;
        $user->save();        

        /*if($request->tipo == 2){
            $coordinador = new Coordinador();
            $coordinador->user_id = $user->id;
            $coordinador->id_carrera = $request->carrera;
            $coordinador->save();
        }*/

        return redirect()->route('usuarios')->with('success', 'Nuevo usuario creado con éxito');

    }

    public function updateUsuario(Request $request, User $user)
    {               
        //VALIDACION DE DATOS
        $request->validate([
            'nombre' => 'required|string|min:5|max:255',  
            'tipo' => 'required|numeric',          
            'carrera' =>'nullable|numeric',
        ]);
        if(is_numeric($request->codigo)){
            if($request->codigo == $user->codigo){
                $request->validate(['codigo' => 'required|numeric',]);
            }else{
                $request->validate(['codigo' => 'required|numeric|unique:users',]);
            }
        }else{
            $request->validate(['codigo' => 'required|string',]);
        }

        if($request->contra == "SI"){
            $request->validate([
                'password' => 'required|string|min:6',
                'password_confirmed' => 'required|string|min:6',
            ]);  
            if ($request->password != $request->password_confirmed) {
                return redirect()->back()->with('info', 'Las contraseñas no coinciden');
            }
            $user->password = Hash::make($request->password);
        }

        if ($request->tipo == 0) {
            return redirect()->route('usuarios')->with('info', 'Selecciona el tipo de usuario');
        }

        //EDITAR USUARIO
        $user->name = $request->nombre;
        $user->codigo = $request->codigo;
        $user->admin_type = $request->tipo;
        $user->save();           

        /*$coordinador = Coordinador::where('user_id', $user->id)->get()->first(); 
        if($request->tipo == 2){              
            if(!isset($coordinador)){
                $coordinador = new Coordinador();
            }            
            $coordinador->user_id = $user->id;
            $coordinador->id_carrera = $request->carrera;
            $coordinador->save();
        }else{
            if(isset($coordinador)){
                $coordinador->delete();
            }
        }*/

        return redirect()->route('usuarios')->with('success', 'Información actualizada con éxito');

    }

    public function deleteUsuario(Request $request, User $usuario)
    {

        $value = Hash::check($request->password, auth()->user()->password);

        if ($value == false) {
            $request->validate([
                'password' => 'required|current_password',
            ]);
        }

        try{
            //Eliminar los documentos
            $documentos = Documento::where('user_id', $usuario->id)->get();
            if ($documentos->count() > 0) {
                foreach ($documentos as $documento) {
                    //Eliminamos el documento de la base de datos
                    $documento->delete();
                }
            }
            //Eliminar el usuario
            $usuario->delete();
        }catch(\Exception $e){
            return redirect()->route('usuarios')->with('info', 'Ocurrio un error al tratar de eliminar el usuario.');
        }

        return redirect()->route('usuarios')->with('success', 'Usuario eliminado correctamente.');
    }

    //Maestros
    public function updateMaestro(Request $request, Maestro $maestro)
    {
        //VALIDACION DE DATOS
        $request->validate([
            'nombre' => 'required|string|min:5|max:255',
            'email' => 'required|string|email|max:255',
            'codigo' => 'required|numeric',
            'grado' => 'required|string|min:3'
        ]);

        //ACTUALIZAR USUARIO
        $user = User::find($maestro->user_id);

        if($request->contra == "SI"){
            $request->validate([
                'password' => 'required|string|min:6',
                'password_confirmed' => 'required|string|min:6',
            ]);  
            if ($request->password != $request->password_confirmed) {
                return redirect()->back()->with('info', 'Las contraseñas no coinciden');
            }
            $user->password = Hash::make($request->password);
            $user->save();
        }        

        $user->forceFill([
            'name' => $request['nombre'],
            'codigo' => $request['codigo'],
        ])->save();


        //ACTUALIZAR MAESTRO
        $maestro = Maestro::find($maestro->id);
        $maestro->nombre = $request['nombre'];
        $maestro->codigo = $request['codigo'];
        $maestro->grado = $request['grado'];
        $maestro->genero = $request['genero'];
        $maestro->save();

        $maestros = Maestro::all();

        return redirect()->route('maestros')->with('success', 'Información actualizada con éxito');

    }

    public function storeMaestro(Request $request)
    {

        //VALIDACION DE DATOS
        $request->validate([
            'nombre' => 'required|string|min:5|max:255',
            'email' => 'required|string|email|max:255|unique:maestros',
            'password' => 'required|string|min:6',
            'codigo' => 'required|numeric|unique:maestros',
            'grado' => 'required|string|min:3'
        ]);
       
        //CREAR USUARIO
        $user = User::create([
            'name' => $request['nombre'],
            'codigo' => $request['codigo'],
            'password' => Hash::make($request['password']),
            'is_teacher' => '1',
        ]);

        //CREAR MAESTRO
        Maestro::create([
            'user_id' => $user->id,
            'email' => $request->email,
            'nombre' => $request['nombre'],
            'codigo' => $request['codigo'],
            'grado' => $request['grado'],
            'genero' => $request['genero']
        ]);

        return redirect()->route('maestros')->with('success', 'Maestro creado con éxito');

    }

    public function deleteMaestro(Request $request, Maestro $maestro)
    {

        $value = Hash::check($request->password, auth()->user()->password);

        if ($value == false) {
            $request->validate([
                'password' => 'required|current_password',
            ]);
        }

        try{
            $maestro = Maestro::find($maestro->id);

            //Eliminar los documentos
            $documentos = Documento::where('user_id', $maestro->user_id)->get();

            $nombre = (string)$maestro->user_id;
            $nombre_ruta =  $nombre . "_" . $maestro->nombre;

            $directory = 'maestros/' . $nombre_ruta;

            Storage::deleteDirectory($directory);

            if ($documentos) {
                foreach ($documentos as $documento) {
                    //Eliminamos el documento de la base de datos
                    $documento->delete();
                }
            }

            //Eliminar el tramite
            $maestro->delete();

            //Eliminar el usuario
            $user = User::find($maestro->user_id);
            $user->delete();
        }catch(\Exception $e){
            return redirect()->route('maestros')->with('info', 'No se pudo eliminar el maestro.');
        }

        return redirect()->route('maestros')->with('success', 'Maestro eliminado correctamente.');
    }
}
