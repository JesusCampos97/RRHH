<?php

namespace App\Http\Controllers\Tipos;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Traits\Utils;
use Illuminate\Support\Facades\DB;
use Session;


class TiposEventosController extends Controller
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
        session::put('active','TiposEventos');
  
        return view('tipos.tiposeventos');
    }

    public function listarTiposEventos(Request $request){

        $activo=$request->activo;
        try
        { 
            $sql="select * from tipo_eventos where activo='".$activo."';";
            $tipo_eventos = $this->executeSelect($sql);
            $data = array(
                'data' => $tipo_eventos
            );
            echo json_encode($data);
        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al mostrar los tipos de eventos"];//500;
        }
    }

    public function getDataTiposEventos(Request $request){
        $id=$request->id;
        try
        { 
            $sql="SELECT te.id,nombre,color_evento
            FROM `tipo_eventos` as te
            where te.id=".$id;
            $tipo_eventos = $this->executeSelect($sql);
            return json_encode($tipo_eventos);

        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al mostrar los tipos de eventos"];//500;
        }
    }

    public function updateTiposEventos(Request $request){
        $id=$request->id;
        $nombre = $request->nombre;
        $color = $request->color;

        try
        { 
            $sql="UPDATE tipo_eventos SET nombre='".$nombre."',color_evento= '".$color."'
            WHERE id=".$id;
            $tipo_eventosUpdated = $this->executeUpdate($sql);
            if(!$tipo_eventosUpdated) {
                return ["code"=>500, "msg"=>"Se ha producido un error al actualizar el tipo de evento."];
            }

            return ["code"=>200, "msg"=>"Actualizado correctamente."];//500;

        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al actualizar el tipo de evento."];//500;
        }
        
    }

    public function insertTiposEventos(Request $request){
        $id=$request->id;
        $nombre = $request->nombre;
        $color = $request->color;

        try
        { 
            $sql="INSERT INTO tipo_eventos(nombre,color_evento) 
            VALUES('".$nombre."','".$color."');";
            $tipo_eventosInsertedId = $this->executeInsert($sql);

            if($tipo_eventosInsertedId===false){
                return ["code"=>500, "msg"=>"Se ha producido un error al insertar el tipo de evento."];
            } 

            return ["code"=>200, "msg"=>"Tipo de evento añadido correctamente."];//500;

        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al insertar el tipo de evento.".$ex->getMessage()];//500;
        }
        
    }
    

    public function activadesactivaTiposEventos(Request $request){

       /* $id=$request->id;
        //$nombre = $request->nombre;

        try
        { 
            $sql="delete from tipo_eventos where id=".$id;
            $tipo_eventosDeleted = $this->executeDelete($sql);
            if(!$tipo_eventosDeleted) return ["code"=>500, "msg"=>"Se ha producido un error al eliminar el tipo de evento."];

            return ["code"=>200, "msg"=>"Tipo de evento eliminado correctamente."];//500;

           
        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al eliminar el tipo de evento."];//500;
        }*/
        $id=$request->id;
         $activo=$request->activo;
         try
         { 
             $sql="UPDATE tipo_eventos SET activo=".$activo." where id=".$id;
             $tipo_eventosUpdated = $this->executeUpdate($sql);
             if(!$tipo_eventosUpdated) return ["code"=>500, "msg"=>"Se ha producido un error al marcar como inactivo al tipo de evento."];
 
             if($activo==0){
                 return ["code"=>200, "msg"=>"El tipo de evento se ha marcado como inactivo."];//500;
             }else{
                 return ["code"=>200, "msg"=>"El tipo de evento se ha marcado como activo."];//500;
             }
         }catch(\Illuminate\Database\QueryException $ex){ 
             return ["code"=>500, "msg"=>"Se ha producido un error al marcar como inactivo al tipo de evento."];//500;
         }


    }
}
