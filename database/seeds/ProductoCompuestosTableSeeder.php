<?php

use Illuminate\Database\Seeder;

class ProductoCompuestosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('producto_compuestos')->delete();
        
        \DB::table('producto_compuestos')->insert(array (
            0 => 
            array (
                'producto_padre_id' => 3,
                'producto_hijo_id' => 1,
            ),
            1 => 
            array (
                'producto_padre_id' => 3,
                'producto_hijo_id' => 2,
            ),
        ));
        
        
    }
}