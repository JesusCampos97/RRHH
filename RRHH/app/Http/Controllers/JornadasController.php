<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Utils;
use Illuminate\Support\Facades\DB;
use Session;

class JornadasController extends Controller
{
    use Utils;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:ROLE_ADMIN|ROLE_SUPERADMIN|ROLE_RRHH']); //tiene que tener cualquiera de esos
        // $this->middleware(['role:ROLE_SUPERADMIN','role:ROLE_ADMIN']); //tiene que tenr los dos
    }
    //
    public function index(Request $request)
    {
        session::put('active','jornadas');
        $sql="SELECT * FROM JORNADAS WHERE USER_ID=".$request->user()->id." and fecha=current_date() and hora_fin is null order by id desc limit 1";
        $jornadaEnCurso = $this->executeSelect($sql);

        $jornadaFinalizada=false;
        if(count($jornadaEnCurso)==0){
            $jornadaFinalizada=true;
            $sql="SELECT * FROM JORNADAS WHERE USER_ID=".$request->user()->id." and fecha=current_date() and hora_fin is not null order by id asc";
            $jornadaEnCurso = $this->executeSelect($sql);
        }else{
            $sql="SELECT * FROM JORNADAS WHERE USER_ID=".$request->user()->id." and fecha=current_date() and hora_fin is not null order by id asc";
            $jornadaEnCurso_append = $this->executeSelect($sql);
            $jornadaEnCurso= array_merge($jornadaEnCurso_append, $jornadaEnCurso);

        }

        return view('jornadas.controlHorario',compact('jornadaEnCurso','jornadaFinalizada'));
    }

    public function iniciarJornada(Request $request){

        $user_id=$request->user()->id;
        $lat=$request->lat;
        $lng=$request->lng;

        $sql="INSERT INTO JORNADAS(FECHA,HORA_INI,HORA_FIN,TOTAL_HORAS,LAT,LNG,USER_ID) VALUES(CURRENT_DATE(),NOW(),NULL,NULL,'".$lat."','".$lng."',".$user_id.");";

        DB::beginTransaction();
        $jornadaInsertedId = $this->executeInsert($sql);

        if($jornadaInsertedId===false){
            DB::rollBack();
            return ["code"=>500, "msg"=>"Se ha producido un error al iniciar la jornada."];
        } 

        $sql="SELECT * FROM JORNADAS WHERE ID=".$jornadaInsertedId;
        $jornadaInsertedSelect = $this->executeSelect($sql);

        DB::commit();
        return ["code"=>200, "msg"=>"Jornada iniciada correctamente.","data"=>$jornadaInsertedSelect];
    }

    public function finalizarJornada(Request $request){

        $user_id=$request->user()->id;

        $sql="UPDATE JORNADAS SET HORA_FIN=NOW() WHERE USER_ID=".$user_id." and fecha=CURRENT_DATE() and hora_fin is null";
        
        DB::beginTransaction();
        $jornadaUpdated = $this->executeUpdate($sql);

        if($jornadaUpdated===false){
            DB::rollBack();
            return ["code"=>500, "msg"=>"Se ha producido un error al finalizar la jornada."];
        } 

        $sql="SELECT * FROM JORNADAS WHERE USER_ID=".$request->user()->id." and fecha=current_date() and hora_fin is not null order by id desc limit 1";
        $jornadaFinalizada = $this->executeSelect($sql);

        DB::commit();
        return ["code"=>200, "msg"=>"Jornada finalizada correctamente.","data"=>$jornadaFinalizada];
    }
}