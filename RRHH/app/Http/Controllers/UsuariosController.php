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
        $sql="select * from roles;";
        $roles = $this->executeSelect($sql);
        $sql="select * from empresas;";
        $empresas = $this->executeSelect($sql);
        $sql="select * from tipo_puestos_trabajo;";
        $puestos_trabajo = $this->executeSelect($sql);
        return view('gestion.usuarios',compact('roles','empresas','puestos_trabajo'));
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

    public function getDataUsuarios(Request $request){
        $id=$request->id;
        try
        { 
            $sql="SELECT u.id,name,apellidos,email,sexo,telefono,DNI,fechaNac,ciudad, ru.role_id, localidad,
            codigo_postal, direccion, id_empresa, id_puesto_trabajo
            FROM `users` as u inner join role_user as ru on ru.user_id=u.id
            where u.id=".$id;
            $users = $this->executeSelect($sql);
            return json_encode($users);

        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al mostrar los usuarios"];//500;
        }
    }

    public function updateUsuarios(Request $request){
        $id=$request->id;
        $nombre = $request->nombre;
        $apellidos = $request->apellidos;
        $dni = $request->dni;
        $ciudad = $request->ciudad;
        $localidad = $request->localidad;
        $codigo_postal = $request->codigo_postal;
        $direccion = $request->direccion;
        $sexo = $request->sexo;
        $email = $request->email;
        $telefono = $request->telefono;
        $fechaNac = $request->fechaNac;
        $role_id = $request->role_id;
        $id_empresa = $request->id_empresa;
        $id_puesto_trabajo = $request->id_puesto_trabajo;

        
        try
        { 
            $sql="UPDATE USERS SET name='".$nombre."',apellidos='".$apellidos."',dni='".$dni."',ciudad='".$ciudad."',localidad='".$localidad."',
            codigo_postal='".$codigo_postal."',direccion='".$direccion."',sexo='".$sexo."',email='".$email."',telefono='".$telefono."',
            fechaNac='".$fechaNac."',id_empresa='".$id_empresa."',id_puesto_trabajo='".$id_puesto_trabajo."',id_empresa='".$id_empresa."'
            WHERE ID=".$id;
            $usersUpdated = $this->executeUpdate($sql);

            $sql_role="update role_user set role_id='".$role_id."' where user_id='".$id."'";
            $roleUpdated = $this->executeUpdate($sql_role);

            return ["code"=>200, "msg"=>"Actualizado correctamente."];//500;

        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al mostrar los usuarios."];//500;
        }
        
    }

    
}
