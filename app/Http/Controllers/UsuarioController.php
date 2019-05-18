<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioCreateRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    //

    public function  formulario(){
        return view('auth.register');
    }

    public function crearUsuario(Request $request)
    {
        $usuario=new User();
        $usuario->nombre=$request['nombre'];
        $usuario->apellido=$request['apellido'];
        $usuario->documento=$request['documento'];
        $usuario->email=$request['email'];
        $usuario->rol_id=$request['rol'];
        $usuario->password=Hash::make($request['password']);
        $usuario->save();

        return view('errors.200');
    }
}
