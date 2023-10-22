<?php

namespace App\Http\Controllers\Tipos;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Traits\Utils;
use Illuminate\Support\Facades\DB;
use Session;

class TiposIncidentesController extends Controller
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
        session::put('active','TiposIncidentes');
  
        return view('tipos.tiposincidentes');
    }

    public function listarTiposIncidentes(Request $request){

        //$activo=$request->activo;
        try
        { 
            $sql="select * from tipo_incidentes";
            $tipos_incidentes = $this->executeSelect($sql);
            $data = array(
                'data' => $tipos_incidentes
            );
            echo json_encode($data);
        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al mostrar los tipos de incidentes"];//500;
        }
    }

    public function getDataTiposIncidentes(Request $request){
        $id=$request->id;
        try
        { 
            $sql="SELECT ti.id,nombre
            FROM `tipo_incidentes` as ti 
            where ti.id=".$id;
            $tipos_incidentes = $this->executeSelect($sql);
            return json_encode($tipos_incidentes);

        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al mostrar los tipos de incidentes"];//500;
        }
    }

    public function updateTiposIncidentes(Request $request){
        $id=$request->id;
        $nombre = $request->nombre;
        try
        { 
            $sql="UPDATE tipo_incidentes SET nombre='".$nombre."'
            WHERE ID=".$id;
            $tipos_incidentesUpdated = $this->executeUpdate($sql);
            if(!$tipos_incidentesUpdated) {
                return ["code"=>500, "msg"=>"Se ha producido un error al actualizar el tipo de incidente."];
            }

            return ["code"=>200, "msg"=>"Actualizado correctamente."];//500;

        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al actualizar el usuario."];//500;
        }
        
    }

    public function insertTiposIncidentes(Request $request){
        $id=$request->id;
        $nombre = $request->nombre;
           
        try
        { 
            $sql="INSERT INTO tipo_incidentes(nombre) 
            VALUES('".$nombre."');";
            $tipos_incidentesInsertedId = $this->executeInsert($sql);

            if($tipos_incidentesInsertedId===false){
                return ["code"=>500, "msg"=>"Se ha producido un error al insertar el tipo de incidente."];
            } 

            return ["code"=>200, "msg"=>"Tipo de incidente añadido correctamente."];//500;

        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al insertar el tipo de incidente.".$ex->getMessage()];//500;
        }
        
    }
    

    public function deleteTiposIncidentes(Request $request){

        $id=$request->id;
        //$nombre = $request->nombre;

        try
        { 
            $sql="delete from tipo_incidentes where id=".$id;
            $tipos_incidentesDeleted = $this->executeDelete($sql);
            if(!$tipos_incidentesDeleted) return ["code"=>500, "msg"=>"Se ha producido un error al eliminar el tipo de incidente."];

            return ["code"=>200, "msg"=>"Tipo de incidente eliminado correctamente."];//500;

           
        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al eliminar el tipo de incidente."];//500;
        }

    }

}
