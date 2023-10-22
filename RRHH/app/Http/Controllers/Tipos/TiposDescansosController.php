<?php

namespace App\Http\Controllers\Tipos;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Traits\Utils;
use Illuminate\Support\Facades\DB;
use Session;


class TiposDescansosController extends Controller
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
        session::put('active','TiposDescansos');
  
        return view('tipos.tiposdescansos');
    }

    public function listarTiposDescansos(Request $request){

        //$activo=$request->activo;
        try
        { 
            $sql="select * from tipos_descansos";
            $tipos_descansos = $this->executeSelect($sql);
            $data = array(
                'data' => $tipos_descansos
            );
            echo json_encode($data);
        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al mostrar los tipos de descansos"];//500;
        }
    }

    public function getDataTiposDescansos(Request $request){
        $id=$request->id;
        try
        { 
            $sql="SELECT td.id,nombre,color_tipo_descanso
            FROM `tipos_descansos` as td 
            where td.id=".$id;
            $tipos_incidentes = $this->executeSelect($sql);
            return json_encode($tipos_incidentes);

        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al mostrar los tipos de descansos"];//500;
        }
    }

    public function updateTiposDescansos(Request $request){
        $id=$request->id;
        $nombre = $request->nombre;
        $color = $request->color;

        try
        { 
            $sql="UPDATE tipos_descansos SET nombre='".$nombre."',color_tipo_descanso= '".$color."'
            WHERE id=".$id;
            $tipos_descansosUpdated = $this->executeUpdate($sql);
            if(!$tipos_descansosUpdated) {
                return ["code"=>500, "msg"=>"Se ha producido un error al actualizar el tipo de descanso."];
            }

            return ["code"=>200, "msg"=>"Actualizado correctamente."];//500;

        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al actualizar el tipo de descanso."];//500;
        }
        
    }

    public function insertTiposDescansos(Request $request){
        $id=$request->id;
        $nombre = $request->nombre;
        $color = $request->color;

        try
        { 
            $sql="INSERT INTO tipos_descansos(nombre,color_tipo_descanso) 
            VALUES('".$nombre."','".$color."');";
            $tipos_descansosInsertedId = $this->executeInsert($sql);

            if($tipos_descansosInsertedId===false){
                return ["code"=>500, "msg"=>"Se ha producido un error al insertar el tipo de descanso."];
            } 

            return ["code"=>200, "msg"=>"Tipo de descanso añadido correctamente."];//500;

        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al insertar el tipo de descanso.".$ex->getMessage()];//500;
        }
        
    }
    

    public function deleteTiposDescansos(Request $request){

        $id=$request->id;
        //$nombre = $request->nombre;

        try
        { 
            $sql="delete from tipos_descansos where id=".$id;
            $tipos_descansosDeleted = $this->executeDelete($sql);
            if(!$tipos_descansosDeleted) return ["code"=>500, "msg"=>"Se ha producido un error al eliminar el tipo de descanso."];

            return ["code"=>200, "msg"=>"Tipo de descanso eliminado correctamente."];//500;

           
        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al eliminar el tipo de descanso."];//500;
        }

    }
}
