<?php

namespace App\Http\Controllers\Tipos;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Traits\Utils;
use Illuminate\Support\Facades\DB;
use Session;

class TiposAusenciaController extends Controller
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
        session::put('active','TiposAusencias');
  
        return view('tipos.tiposausencia');
    }

    public function listarTiposAusencias(Request $request){

        //$activo=$request->activo;
        try
        { 
            $sql="select * from tipo_ausencias";
            $tipo_ausencias = $this->executeSelect($sql);
            $data = array(
                'data' => $tipo_ausencias
            );
            echo json_encode($data);
        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al mostrar los tipos de ausencias"];//500;
        }
    }

    public function getDataTiposAusencias(Request $request){
        $id=$request->id;
        try
        { 
            $sql="SELECT ta.id,nombre,color
            FROM `tipo_ausencias` as ta 
            where ta.id=".$id;
            $tipo_ausencias = $this->executeSelect($sql);
            return json_encode($tipo_ausencias);

        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al mostrar los tipos de ausencias"];//500;
        }
    }

    public function updateTiposAusencias(Request $request){
        $id=$request->id;
        $nombre = $request->nombre;
        $color = $request->color;

        try
        { 
            $sql="UPDATE tipo_ausencias SET nombre='".$nombre."',color= '".$color."'
            WHERE id=".$id;
            $tipo_ausenciasUpdated = $this->executeUpdate($sql);
            if(!$tipo_ausenciasUpdated) {
                return ["code"=>500, "msg"=>"Se ha producido un error al actualizar el tipo de ausencia."];
            }

            return ["code"=>200, "msg"=>"Actualizado correctamente."];//500;

        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al actualizar el tipo de ausencia."];//500;
        }
        
    }

    public function insertTiposAusencias(Request $request){
        $id=$request->id;
        $nombre = $request->nombre;
        $color = $request->color;

        try
        { 
            $sql="INSERT INTO tipo_ausencias(nombre,color) 
            VALUES('".$nombre."','".$color."');";
            $tipo_ausenciasInsertedId = $this->executeInsert($sql);

            if($tipo_ausenciasInsertedId===false){
                return ["code"=>500, "msg"=>"Se ha producido un error al insertar el tipo de ausencia."];
            } 

            return ["code"=>200, "msg"=>"Tipo de ausencia añadido correctamente."];//500;

        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al insertar el tipo de ausencia.".$ex->getMessage()];//500;
        }
        
    }
    

    public function deleteTiposAusencias(Request $request){

        $id=$request->id;
        //$nombre = $request->nombre;

        try
        { 
            $sql="delete from tipo_ausencias where id=".$id;
            $tipo_ausenciasDeleted = $this->executeDelete($sql);
            if(!$tipo_ausenciasDeleted) return ["code"=>500, "msg"=>"Se ha producido un error al eliminar el tipo de ausencia."];

            return ["code"=>200, "msg"=>"Tipo de ausencia eliminado correctamente."];//500;

           
        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al eliminar el tipo de ausencia."];//500;
        }

    }
}
