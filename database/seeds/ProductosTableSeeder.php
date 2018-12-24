<?php

use Illuminate\Database\Seeder;

class ProductosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('productos')->delete();
        
        \DB::table('productos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'Arroz',
                'referencia' => 'EF456H0',
                'precio' => 1000.0,
                'costo' => 600.0,
                'unidades_actuales' => 20,
                'estado' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'Pasta',
                'referencia' => 'EF456H0',
                'precio' => 2000.0,
                'costo' => 1000.0,
                'unidades_actuales' => 20,
                'estado' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'nombre' => 'Cesta',
                'referencia' => 'HF456H0',
                'precio' => 3000.0,
                'costo' => 1500.0,
                'unidades_actuales' => 10,
                'estado' => 1,
            ),
        ));
        
        
    }
}