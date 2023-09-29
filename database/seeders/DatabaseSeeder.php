<?php

namespace Database\Seeders;

use App\Models\Alumno;
use App\Models\Tramite;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CarrerasSeeder::class);
        $this->call(PlanestudiosSeeder::class);
        $this->call(ArticulosSeeder::class);
        $this->call(OpcionesTitulacionSeeder::class);
        $this->call(UserSeeder::class);

        //$this->call(AlumnosSeeder::class);

        // Crear 10 registros de usuarios y asignarles 10 alumnos cada uno
        

        /*$users = User::factory()->count(10)->create();        
        foreach ($users as $user) {
            Alumno::factory()->count(1)->create(['user_id' => $user->id]);
            Tramite::factory()->count(1)->create(['alumno_id' => $user->alumno->id]);
            DB::table('alumno_docs')->insert([
                'alumno_id' => $user->alumno->id,  
                //'id_opcion_titulacion' =>$user->alumno->id_opcion_titulacion,                    
            ]);
        }*/
        
        //Tramite::factory()->count(10)->create();
        

        $this->call(MaestrosSeeder::class);
        
        // $this->call(AlumnosSeeder::class);
        // $this->call(TramitesSeeder::class);
                

    }
}
