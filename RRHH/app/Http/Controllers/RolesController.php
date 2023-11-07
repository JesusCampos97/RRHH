<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Utils;
use Illuminate\Support\Facades\DB;
use Session;

class RolesController extends Controller
{
    //
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
        session::put('active','Roles');
     
        return view('gestion.roles');
    }

    public function listarRoles(Request $request){

        $activo=$request->activo;
        try
        { 
            $sql="select * from roles where activo=".$activo.";";
            $roles = $this->executeSelect($sql);
            $data = array(
                'data' => $roles
            );
            echo json_encode($data);
        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al mostrar los roles"];//500;
        }
    }

    public function getDataRoles(Request $request){
        $id=$request->id;
        try
        { 
            $sql="SELECT r.id,name,description
            FROM `roles` as r 
            where r.id=".$id;
            $roles = $this->executeSelect($sql);
            return json_encode($roles);

        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al mostrar los roles"];//500;
        }
    }

    public function updateRoles(Request $request){
        $id=$request->id;
        $nombre = $request->nombre;
        $descripcion = $request->descripcion;

        try
        { 
            $sql="UPDATE roles SET name='".$nombre."',description= '".$descripcion."'
            WHERE id=".$id;
            $rolesUpdated = $this->executeUpdate($sql);
            if(!$rolesUpdated) {
                return ["code"=>500, "msg"=>"Se ha producido un error al actualizar el rol."];
            }

            return ["code"=>200, "msg"=>"Actualizado correctamente."];//500;

        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al actualizar el rol."];//500;
        }
        
    }

    public function insertRoles(Request $request){
        $id=$request->id;
        $nombre = $request->nombre;
        $descripcion = $request->descripcion;


        
        try
        { 
            //DB::beginTransaction();
            $sql="INSERT INTO roles(NAME,description) 
            VALUES('".$nombre."','".$descripcion."');";
            $rolInsertedId = $this->executeInsert($sql);

            if($rolInsertedId===false){
                //DB::rollBack();
                return ["code"=>500, "msg"=>"Se ha producido un error al insertar el rol."];
            } 

            /*$sql_role="INSERT INTO ROLE_USER(ROLE_ID, USER_ID) VALUES(".$role_id.",".$userInsertedId.")";
            $roleInserted = $this->executeInsert($sql_role);
            if($roleInserted===false){
                DB::rollBack();
                return ["code"=>500, "msg"=>"Se ha producido un error al insertar el rol del usuario."];
            }*/ 

            //DB::commit();
            return ["code"=>200, "msg"=>"Rol añadido correctamente."];//500;

        }catch(\Illuminate\Database\QueryException $ex){ 
            DB::rollBack();
            return ["code"=>500, "msg"=>"Se ha producido un error al insertar el rol.".$ex->getMessage()];//500;
        }
        
    }
    

    public function activadesactivaRoles(Request $request){
        //LOS USUARIOS NO LOS BORRAMOS DE LA BASE DE DATOS, LO PONEMOS COMO ACTIVO=0, POR QUE DEPENDEN MUCHAS TABLAS DE EL
        $id=$request->id;
        $activo=$request->activo;
        try
        { 
            $sql="UPDATE roles SET activo=".$activo." where id=".$id;
            $usersUpdated = $this->executeUpdate($sql);
            if(!$usersUpdated) return ["code"=>500, "msg"=>"Se ha producido un error al marcar como inactivo al rol."];

            if($activo==0){
                return ["code"=>200, "msg"=>"El rol se ha marcado como inactivo."];//500;
            }else{
                return ["code"=>200, "msg"=>"El rol se ha marcado como activo."];//500;
            }
        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al marcar como inactivo al rol."];//500;
        }

    }
}
