<?php

namespace App\Http\Controllers;

use App\Models\Estadistica;
use App\Models\Tramite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\User;

class EstadisticaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $time = Carbon::now(); 
        $mes = $time->format('n');
        $año = $time->format('Y');
        //$total = Estadistica::where('mes','TODOS')->first();
        $total = Tramite::where('estado',14)->count();
        $tramites = Tramite::all();
        $division1 = 0;
        $division2 = 0;
        $division3 = 0;        
        $ultimo_mes1 = 0;  
        $ultimo_mes2 = 0;
        $ultimo_mes3 = 0;                     
        foreach($tramites as $tramite){           
            if($tramite->estado == 14){
                if($tramite->alumno->carrera->division_id == 1){
                    $division1 ++;
                    if(date("m", strtotime($tramite->alumno->fecha_titulacion)) == $mes && date("Y", strtotime($tramite->alumno->fecha_titulacion)) == $año){
                        $ultimo_mes1 ++;
                    }
                }else if($tramite->alumno->carrera->division_id == 2){
                    $division2 ++;
                    if(date("m", strtotime($tramite->alumno->fecha_titulacion)) == $mes && date("Y", strtotime($tramite->alumno->fecha_titulacion)) == $año){
                        $ultimo_mes2 ++;
                    }
                }else if($tramite->alumno->carrera->division_id == 3){
                    $division3 ++;  
                    $mes_titulacion = $tramite->alumno->fecha_titulacion;                                                    
                    if(date("m", strtotime($tramite->alumno->fecha_titulacion)) == $mes && date("Y", strtotime($tramite->alumno->fecha_titulacion)) == $año){
                        $ultimo_mes3 ++;
                    }
                }
            }
        }
        $estadistica1 = ($division1 * 100)/$total;
        $estadistica1 =  number_format($estadistica1, 2);
        $estadistica2 = ($division2 * 100)/$total;
        $estadistica2 =  number_format($estadistica2, 2);
        $estadistica3 = ($division3 * 100)/$total;
        $estadistica3 =  number_format($estadistica3, 2);
       
        $ultimo_mes_total = $ultimo_mes1 + $ultimo_mes2 + $ultimo_mes3;
        return view('admin.estadisticas',compact('user','total','division1','division2','division3','estadistica1','estadistica2','estadistica3',
        'ultimo_mes1','ultimo_mes2','ultimo_mes3','ultimo_mes_total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\Estadistica  $estadistica
     * @return \Illuminate\Http\Response
     */
    public function show(Estadistica $estadistica)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estadistica  $estadistica
     * @return \Illuminate\Http\Response
     */
    public function edit(Estadistica $estadistica)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estadistica  $estadistica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estadistica $estadistica)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estadistica  $estadistica
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estadistica $estadistica)
    {
        //
    }
}
