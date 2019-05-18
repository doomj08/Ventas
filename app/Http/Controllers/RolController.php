<?php

namespace App\Http\Controllers;

use App\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    //
    public function getRoles(){
        $roles=Rol::get();
        return response()->json($roles);
    }
}
