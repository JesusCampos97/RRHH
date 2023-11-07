<?php

namespace App\Http\Controllers\Tipos;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Traits\Utils;
use Illuminate\Support\Facades\DB;
use Session;

class TiposDocumentosController extends Controller
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
        session::put('active','TiposDocumentos');
  
        return view('tipos.tiposdocumento');
    }
    public function listarTiposDocumentos(Request $request){

        $activo=$request->activo;
        try
        { 
            $sql="select *,case when usa_firma_electronica='1' then 'Sí' else 'No' end as usa_firma_electronica_case
             from tipo_documentos           
             where activo='".$activo."';";
            $tipo_documentos = $this->executeSelect($sql);
            $data = array(
                'data' => $tipo_documentos
            );

            echo json_encode($data);
        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al mostrar los tipos de documentos"];//500;
        }
    }

    public function getDataTiposDocumentos(Request $request){
        $id=$request->id;
        try
        { 
            $sql="SELECT td.id,nombre,usa_firma_electronica	
            FROM `tipo_documentos` as td 
            where td.id=".$id;
            $tipo_documentos = $this->executeSelect($sql);
            return json_encode($tipo_documentos);

        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al mostrar los tipos de documentos"];//500;
        }
    }
    public function updateTiposDocumentos(Request $request){
        $id=$request->id;
        $nombre = $request->nombre;
        $usa_firma_electronica = $request->usa_firma_electronica;

        try
        { 
            $sql="UPDATE tipo_documentos SET nombre='".$nombre."',usa_firma_electronica= '".$usa_firma_electronica."'
            WHERE id=".$id;
            $tipo_documentosUpdated = $this->executeUpdate($sql);
            if(!$tipo_documentosUpdated) {
                return ["code"=>500, "msg"=>"Se ha producido un error al actualizar el tipo de documentos."];
            }

            return ["code"=>200, "msg"=>"Actualizado correctamente."];//500;

        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al actualizar el tipo de documentos."];//500;
        }
        
    }

    public function insertTiposDocumentos(Request $request){
        $id=$request->id;
        $nombre = $request->nombre;
        $usa_firma_electronica = $request->usa_firma_electronica;

        try
        { 
            $sql="INSERT INTO tipo_documentos(nombre,usa_firma_electronica) 
            VALUES('".$nombre."','".$usa_firma_electronica."');";
            $tipo_documentosInsertedId = $this->executeInsert($sql);

            if($tipo_documentosInsertedId===false){
                return ["code"=>500, "msg"=>"Se ha producido un error al insertar el tipo de documentos.". $sql];
            } 

            return ["code"=>200, "msg"=>"Tipo de documentos añadido correctamente."];//500;

        }catch(\Illuminate\Database\QueryException $ex){ 
            return ["code"=>500, "msg"=>"Se ha producido un error al insertar el tipo de documentos.".$ex->getMessage()];//500;
        }
        
    }

    public function activadesactivaTiposDocumentos(Request $request){

           $id=$request->id;
           $activo=$request->activo;
           try
           { 
               $sql="UPDATE tipo_documentos SET activo=".$activo." where id=".$id;
               $tipo_documentosUpdated = $this->executeUpdate($sql);
               if(!$tipo_documentosUpdated) return ["code"=>500, "msg"=>"Se ha producido un error al marcar como inactivo al tipo de documentos."];
   
               if($activo==0){
                   return ["code"=>200, "msg"=>"El tipo de documentos se ha marcado como inactivo."];//500;
               }else{
                   return ["code"=>200, "msg"=>"El tipo de documentos se ha marcado como activo."];//500;
               }
           }catch(\Illuminate\Database\QueryException $ex){ 
               return ["code"=>500, "msg"=>"Se ha producido un error al marcar como inactivo al tipo de documentos."];//500;
           }
  
      }

}
