<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Utils;
use Illuminate\Support\Facades\DB;
use Session;

class UsuariosController extends Controller
{
    use Utils;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:ROLE_ADMIN|ROLE_SUPERADMIN|ROLE_RRHH']); //tiene que tener cualquiera de esos
        // $this->middleware(['role:ROLE_SUPERADMIN','role:ROLE_ADMIN']); //tiene que tenr los dos
    }
    //
    public function index()
    {
        $roles = [];
        return view('gestion.usuarios',compact('roles'));
    }

    public function listarusuarios(Request $request){

        try
        { 
            $sql="select * from users;";
            $users = $this->executeSelect($sql);
            $data = array(
                'data' => $users
            );
            echo json_encode($data);
        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al mostrar los usuarios"];//500;
        }
    }

    
}
