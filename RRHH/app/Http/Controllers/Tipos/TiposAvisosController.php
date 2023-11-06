<?php

namespace App\Http\Controllers\Tipos;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Traits\Utils;
use Illuminate\Support\Facades\DB;
use Session;

class TiposAvisosController extends Controller
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
        session::put('active','TiposAvisos');
  
        return view('tipos.tiposavisos');
    }

    public function listarTiposAvisos(Request $request){

        $activo=$request->activo;
        try
        { 
            $sql="select * from tipo_avisos where activo='".$activo."';";
            $tipo_avisos = $this->executeSelect($sql);
            $data = array(
                'data' => $tipo_avisos
            );
            echo json_encode($data);
        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al mostrar los tipos de avisos"];//500;
        }
    }

    public function getDataTiposAvisos(Request $request){
        $id=$request->id;
        try
        { 
            $sql="SELECT ta.id,nombre,urgente,usa_whatsapp_avisos
            FROM `tipo_avisos` as ta 
            where ta.id=".$id;
            $tipo_avisos = $this->executeSelect($sql);
            return json_encode($tipo_avisos);

        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al mostrar los tipos de avisos"];//500;
        }
    }

    public function updateTiposAvisos(Request $request){
        $id=$request->id;
        $nombre = $request->nombre;
        $urgente = $request->urgente;
        $usa_whatsapp_avisos = $request->usa_whatsapp_avisos;

        try
        { 
            $sql="UPDATE tipo_avisos SET nombre='".$nombre."',urgente= '".$urgente."', usa_whatsapp_avisos= '".$usa_whatsapp_avisos."'
            WHERE id=".$id;
            $tipo_ausenciasUpdated = $this->executeUpdate($sql);
            if(!$tipo_ausenciasUpdated) {
                return ["code"=>500, "msg"=>"Se ha producido un error al actualizar el tipo de aviso."];
            }

            return ["code"=>200, "msg"=>"Actualizado correctamente."];//500;

        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al actualizar el tipo de aviso."];//500;
        }
        
    }

    public function insertTiposAvisos(Request $request){
        $id=$request->id;
        $nombre = $request->nombre;
        $urgente = $request->urgente;
        $usa_whatsapp_avisos = $request->usa_whatsapp_avisos;

        try
        { 
            $sql="INSERT INTO tipo_avisos(nombre,urgente,usa_whatsapp_avisos) 
            VALUES('".$nombre."','".$urgente."','".$usa_whatsapp_avisos."');";
            $tipo_avisosInsertedId = $this->executeInsert($sql);

            if($tipo_avisosInsertedId===false){
                return ["code"=>500, "msg"=>"Se ha producido un error al insertar el tipo de aviso.". $sql];
            } 

            return ["code"=>200, "msg"=>"Tipo de aviso añadido correctamente."];//500;

        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al insertar el tipo de aviso.".$ex->getMessage()];//500;
        }
        
    }
    

    public function activadesactivaTiposAvisos(Request $request){

      /*  $id=$request->id;
        //$nombre = $request->nombre;

        try
        { 
            $sql="delete from tipo_avisos where id=".$id;
            $tipo_avisosDeleted = $this->executeDelete($sql);
            if(!$tipo_avisosDeleted) return ["code"=>500, "msg"=>"Se ha producido un error al eliminar el tipo de aviso."];

            return ["code"=>200, "msg"=>"Tipo de aviso eliminado correctamente."];//500;

           
        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al eliminar el tipo de aviso."];//500;
        }*/

         $id=$request->id;
         $activo=$request->activo;
         try
         { 
             $sql="UPDATE tipo_avisos SET activo=".$activo." where id=".$id;
             $tipo_avisosUpdated = $this->executeUpdate($sql);
             if(!$tipo_avisosUpdated) return ["code"=>500, "msg"=>"Se ha producido un error al marcar como inactivo al tipo de aviso."];
 
             if($activo==0){
                 return ["code"=>200, "msg"=>"El tipo de aviso se ha marcado como inactivo."];//500;
             }else{
                 return ["code"=>200, "msg"=>"El tipo de aviso se ha marcado como activo."];//500;
             }
         }catch(\Illuminate\Database\QueryException $ex){ 
             return ["code"=>500, "msg"=>"Se ha producido un error al marcar como inactivo al tipo de aviso."];//500;
         }

    }
}
