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
        session::put('active','usuarios');
        $sql="select * from roles;";
        $roles = $this->executeSelect($sql);
        $sql="select * from empresas;";
        $empresas = $this->executeSelect($sql);
        $sql="select * from tipo_puestos_trabajo;";
        $puestos_trabajo = $this->executeSelect($sql);
        return view('gestion.usuarios',compact('roles','empresas','puestos_trabajo'));
    }

    public function listarusuarios(Request $request){

        $activo=$request->activo;
        try
        { 
            $sql="select * from users where activo=".$activo.";";
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

    public function updateUsuario(Request $request){
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
            DB::beginTransaction();
            $sql="UPDATE USERS SET name='".$nombre."',apellidos='".$apellidos."',dni='".$dni."',ciudad='".$ciudad."',localidad='".$localidad."',
            codigo_postal='".$codigo_postal."',direccion='".$direccion."',sexo='".$sexo."',email='".$email."',telefono='".$telefono."',
            fechaNac='".$fechaNac."',id_empresa='".$id_empresa."',id_puesto_trabajo='".$id_puesto_trabajo."'
            WHERE ID=".$id;
            $usersUpdated = $this->executeUpdate($sql);
            if(!$usersUpdated) {
                DB::rollBack();
                return ["code"=>500, "msg"=>"Se ha producido un error al actualizar el usuario."];
            }

            $sql_role="update role_user set role_id='".$role_id."' where user_id='".$id."'";
            $roleUpdated = $this->executeUpdate($sql_role);
            if(!$roleUpdated) {
                DB::rollBack();
                return ["code"=>500, "msg"=>"Se ha producido un error al actualizar el rol del usuario."];
            }

            DB::commit();
            return ["code"=>200, "msg"=>"Actualizado correctamente."];//500;

        }catch(\Illuminate\Database\QueryException $ex){ 
            DB::rollBack();
            return ["code"=>500, "msg"=>"Se ha producido un error al actualizar el usuario."];//500;
        }
        
    }

    public function insertUsuario(Request $request){
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
            DB::beginTransaction();
            $sql="INSERT INTO USERS(NAME,APELLIDOS,DNI,CIUDAD,LOCALIDAD,CODIGO_POSTAL,DIRECCION,
            SEXO,EMAIL,TELEFONO,FECHANAC,ID_EMPRESA,ID_PUESTO_TRABAJO,PASSWORD,CAMBIARPASS,created_at,updated_at) 
            VALUES('".$nombre."','".$apellidos."','".$dni."','".$ciudad."','".$localidad."','".$codigo_postal."',
            '".$direccion."',".$sexo.",'".$email."','".$telefono."','".$fechaNac."','".$id_empresa."','".$id_puesto_trabajo."',
            '".bcrypt($dni)."',1,NOW(),NOW());";
            $userInsertedId = $this->executeInsert($sql);

            if($userInsertedId===false){
                DB::rollBack();
                return ["code"=>500, "msg"=>"Se ha producido un error al insertar el usuario."];
            } 

            $sql_role="INSERT INTO ROLE_USER(ROLE_ID, USER_ID) VALUES(".$role_id.",".$userInsertedId.")";
            $roleInserted = $this->executeInsert($sql_role);
            if($roleInserted===false){
                DB::rollBack();
                return ["code"=>500, "msg"=>"Se ha producido un error al insertar el rol del usuario."];
            } 

            DB::commit();
            return ["code"=>200, "msg"=>"Usuario añadido correctamente."];//500;

        }catch(\Illuminate\Database\QueryException $ex){ 
            DB::rollBack();
            return ["code"=>500, "msg"=>"Se ha producido un error al insertar el usuario.".$ex->getMessage()];//500;
        }
        
    }
    

    public function activadesactivaUsuario(Request $request){
        //LOS USUARIOS NO LOS BORRAMOS DE LA BASE DE DATOS, LO PONEMOS COMO ACTIVO=0, POR QUE DEPENDEN MUCHAS TABLAS DE EL
        $id=$request->id;
        $activo=$request->activo;
        try
        { 
            $sql="UPDATE USERS SET activo=".$activo." where id=".$id;
            $usersUpdated = $this->executeUpdate($sql);
            if(!$usersUpdated) return ["code"=>500, "msg"=>"Se ha producido un error al marcar como inactivo al usuario."];

            if($activo==0){
                return ["code"=>200, "msg"=>"El usuario se ha marcado como inactivo."];//500;
            }else{
                return ["code"=>200, "msg"=>"El usuario se ha marcado como activo."];//500;
            }
        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al marcar como inactivo al usuario."];//500;
        }

    }

}
