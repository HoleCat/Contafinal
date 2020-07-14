<?php

use Illuminate\Database\Seeder;
use App\Role as Rolex;

class Roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Rolex;
        $role->nombre = "admin";
        $role->save();
        
        $role = new Rolex;
        $role->nombre = "muestreo";
        $role->save();
        
        $role = new Rolex;
        $role->nombre = "activos";
        $role->save();

        $role = new Rolex;
        $role->nombre = "balance";
        $role->save();

        $role = new Rolex;
        $role->nombre = "validador";
        $role->save();

        $role = new Rolex;
        $role->nombre = "xml";
        $role->save();

        $role = new Rolex;
        $role->nombre = "reporte";
        $role->save();
    }
}
