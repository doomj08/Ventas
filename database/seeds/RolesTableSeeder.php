<?php

use App\rol;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $rol=new Rol();
        $rol->cargo='Administrador';
        $rol->save();

        $rol=new Rol();
        $rol->cargo='Supervisor';
        $rol->save();

        $rol=new Rol();
        $rol->cargo='Vendedor';
        $rol->save();
    }
}
