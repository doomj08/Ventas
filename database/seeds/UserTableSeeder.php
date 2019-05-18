<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user=new User();
        $user->nombre='Juan Pablo';
        $user->apellido='Pinzón Rivera';
        $user->documento='1013643876';
        $user->rol_id='1';
        $user->email='pablo_904@hotmail.es';
        $user->password=bcrypt('secret');
        $user->save();
    }
}
