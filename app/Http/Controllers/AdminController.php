<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Alumno;
use App\Models\Maestro;
use App\Models\Tramite;
use App\Models\Documento;
use App\Models\Carrera;
use App\Models\PlanEstudios;
use App\Models\Articulo;
use App\Models\OpcionTitulacion;

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
         //Validacion de campos
         $request->validate([  
            'nombre' => 'required|string',
            'codigo' =>'required|digits:9|numeric',                                  
            'carrera' => 'required|string',
            'promedio' =>'required|numeric',   
            /*'situacion' => 'required|string',*/
            'ciclo_ingreso' => 'required|string',
            'ciclo_egreso' => 'required|string',          
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
        
        // COMPROBACIONES MODALIDAD DESEMPEÑO ACADEMICO
        //Excelencia
        if($request->opciones_titulacion == 1 && $request->promedio < 95){
            return redirect()->back()->with('info', 'Para elegir esta modalidad necesitas un promedio global mínimo de 95 (noventa y cinco)');
        }
        //Promedio
        if($request->opciones_titulacion == 2 && $request->promedio < 90){
            return redirect()->back()->with('info', 'Para elegir esta modalidad necesitas un promedio global mínimo de 90 (noventa)');
        }   
        
        $user = $alumno->user;
        try{
            $user->name = $request->nombre;
            $user->codigo = $request->codigo;
            $user->save();
        }catch(Exception $e){
            return redirect()->back()->with('info', 'Ya existe un alumno con ese código');
        }

        if($request->ganador_proyecto == "SI"){
            $alumno->ganador_proyecto_modular = 1;
        }else{
            $alumno->ganador_proyecto_modular = 0;
        }
       
        $alumno->id_carrera = $request->carrera; 
        $alumno->promedio = $request->promedio;
        $alumno->ciclo_ingreso = $request->ciclo_ingreso;
        $alumno->ciclo_egreso = $request->ciclo_egreso;
        $alumno->id_articulo = $request->articulo;
        $alumno->id_plan_estudios = $request->plan_estudios; 
        $alumno->id_opcion_titulacion = $request->opciones_titulacion;
        $alumno->titulo_del_trabajo = $request->nombre_del_trabajo;

        $alumno->save();

        return redirect()->back()->with('success','Información Escolar actualizada');
    }

    public function editDatosLaborales(Alumno $alumno){
        $user = Auth::user();
        return view('admin/datos-laborales-form', compact('user','alumno'));
    }
}
