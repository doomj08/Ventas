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
        $user->nombre='Jorge Luis';
        $user->apellido='Tinjaca Burgos';
        $user->documento='1118541581';
        $user->rol_id='1';
        $user->email='jltinjaca@gmail.com';
        $user->password=bcrypt('secret');
        $user->save();

        $user=new User();
        $user->nombre='Jose';
        $user->apellido='Toscano';
        $user->documento='1118541582';
        $user->rol_id='1';
        $user->email='jltinjaca@hotmail.com';
        $user->password=bcrypt('secret');
        $user->save();
    }
}
