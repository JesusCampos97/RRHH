<?php

namespace App\Http\Controllers\Tipos;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Traits\Utils;
use Illuminate\Support\Facades\DB;
use Session;


class TiposEpisController extends Controller
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
        session::put('active','TiposEpis');
  
        return view('tipos.tiposepis');
    }

    public function listarTiposEpis(Request $request){

        //$activo=$request->activo;
        try
        { 
            $sql="select * from tipo_epis";
            $tipo_epis = $this->executeSelect($sql);
            $data = array(
                'data' => $tipo_epis
            );
            echo json_encode($data);
        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al mostrar los tipos de epis"];//500;
        }
    }

    public function getDataTiposEpis(Request $request){
        $id=$request->id;
        try
        { 
            $sql="SELECT te.id,nombre
            FROM `tipo_epis` as te 
            where te.id=".$id;
            $tipo_epis = $this->executeSelect($sql);
            return json_encode($tipo_epis);

        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al mostrar los tipos de epis"];//500;
        }
    }

    public function updateTiposEpis(Request $request){
        $id=$request->id;
        $nombre = $request->nombre;
        try
        { 
            $sql="UPDATE tipo_epis SET nombre='".$nombre."'
            WHERE ID=".$id;
            $tipo_episUpdated = $this->executeUpdate($sql);
            if(!$tipo_episUpdated) {
                return ["code"=>500, "msg"=>"Se ha producido un error al actualizar el tipo de epi."];
            }

            return ["code"=>200, "msg"=>"Actualizado correctamente."];//500;

        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al actualizar el tipo de epi."];//500;
        }
        
    }

    public function insertTiposEpis(Request $request){
        $id=$request->id;
        $nombre = $request->nombre;
           
        try
        { 
            $sql="INSERT INTO tipo_epis(nombre) 
            VALUES('".$nombre."');";
            $tipo_episInsertedId = $this->executeInsert($sql);

            if($tipo_episInsertedId===false){
                return ["code"=>500, "msg"=>"Se ha producido un error al insertar el tipo de epi."];
            } 

            return ["code"=>200, "msg"=>"Tipo de epi añadido correctamente."];//500;

        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al insertar el tipo de epi.".$ex->getMessage()];//500;
        }
        
    }
    

    public function deleteTiposEpis(Request $request){

        $id=$request->id;
        //$nombre = $request->nombre;

        try
        { 
            $sql="delete from tipo_epis where id=".$id;
            $tipo_episDeleted = $this->executeDelete($sql);
            if(!$tipo_episDeleted) return ["code"=>500, "msg"=>"Se ha producido un error al eliminar el tipo de tipo."];

            return ["code"=>200, "msg"=>"Tipo de epi eliminado correctamente."];//500;

           
        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al eliminar el tipo de epi."];//500;
        }

    }
}
