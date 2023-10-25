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
        $sql="SELECT j.*/*, d.hora_ini as hora_ini_descanso, d.hora_fin as hora_fin_descanso, t.nombre as nombreDescanso */
        FROM JORNADAS as j /*left join descansos_jornada as d on d.id_jornada=j.id  left join tipos_descansos as t on t.id=d.id_tipo_descanso*/
        WHERE j.USER_ID=".$request->user()->id." and j.fecha=current_date() and j.hora_fin is null order by j.id desc limit 1";
        $jornadaEnCurso = $this->executeSelect($sql);

        $jornadaFinalizada=false;
        if(count($jornadaEnCurso)==0){
            $jornadaFinalizada=true;
            $sql="SELECT j.*/*, d.hora_ini as hora_ini_descanso, d.hora_fin as hora_fin_descanso ,t.nombre as nombreDescanso */
            FROM JORNADAS as j /*left join descansos_jornada as d on d.id_jornada=j.id  left join tipos_descansos as t on t.id=d.id_tipo_descanso*/
            WHERE j.USER_ID=".$request->user()->id." and j.fecha=current_date() and j.hora_fin is not null order by j.id asc";
            $jornadaEnCurso = $this->executeSelect($sql);
        }else{
            $sql="SELECT j.*/*, d.hora_ini as hora_ini_descanso, d.hora_fin as hora_fin_descanso ,t.nombre as nombreDescanso */
            FROM JORNADAS as j /*left join descansos_jornada as d on d.id_jornada=j.id  left join tipos_descansos as t on t.id=d.id_tipo_descanso*/
            WHERE j.USER_ID=".$request->user()->id." and j.fecha=current_date() and j.hora_fin is not null order by j.id asc";
            $jornadaEnCurso_append = $this->executeSelect($sql);
            $jornadaEnCurso= array_merge($jornadaEnCurso_append, $jornadaEnCurso);

        }
        $sql="SELECT * FROM tipos_descansos";
        $tiposDescanso = $this->executeSelect($sql);

        $sql="SELECT d.*,t.nombre as nombreDescanso  
        FROM descansos_jornada as d inner join tipos_descansos as t on t.id=d.id_tipo_descanso
        where d.fecha=current_date() and d.user_id=".$request->user()->id." order by d.id";
        $descansosJornadasHoy = $this->executeSelect($sql);

        $sql="SELECT d.* 
        FROM descansos_jornada as d
        where d.fecha=current_date() and d.user_id=".$request->user()->id." and d.hora_fin is null order by d.id";
        $descansosAbiertosActual = $this->executeSelect($sql);
        if(count($descansosAbiertosActual)>0){
            $descansoAbierto=true;
        }
        else{
            $descansoAbierto=false;
        }

        return view('jornadas.controlHorario',compact('jornadaEnCurso','jornadaFinalizada','tiposDescanso','descansosJornadasHoy','descansoAbierto'));
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

    public function insertDescansoJornada(Request $request){
        $user_id=$request->user()->id;
        $tipo=$request->tipo;
        $lat=$request->lat;
        $lng=$request->lng;

        //obtengo la jornada que esta iniciada para el usuario
        $sql="SELECT j.id
        FROM JORNADAS as j
        WHERE j.USER_ID=".$request->user()->id." and j.fecha=current_date() and j.hora_fin is null order by j.id desc limit 1";
        $jornadaEnCurso = $this->executeSelect($sql);

        $sql="INSERT INTO descansos_jornada(fecha, user_id,hora_ini,hora_fin,lat,lng,id_tipo_descanso, id_jornada)
        values(current_date(),".$user_id.",now(),NULL, '".$lat."','".$lng."',".$tipo.", ".$jornadaEnCurso[0]->id.")";
        $descansoInsertedId = $this->executeInsert($sql);

        if($descansoInsertedId===false){
            DB::rollBack();
            return ["code"=>500, "msg"=>"Se ha producido un error al iniciar el descanso.".$sql];
        }

        $sql="SELECT d.*,t.nombre as nombreDescanso  FROM descansos_jornada as d  inner join tipos_descansos as t on t.id=d.id_tipo_descanso
        WHERE d.ID=".$descansoInsertedId;
        $descansoInsertedSelect = $this->executeSelect($sql);

        return ["code"=>200, "msg"=>"Descanso iniciado correctamente.","data"=>$descansoInsertedSelect];
    }

    public function finalizarDescanso(Request $request){

        $user_id=$request->user()->id;
        //obtengo la jornada que esta iniciada para el usuario
        $sql="SELECT j.id
        FROM JORNADAS as j
        WHERE j.USER_ID=".$request->user()->id." and j.fecha=current_date() and j.hora_fin is null order by j.id desc limit 1";
        $jornadaEnCurso = $this->executeSelect($sql);

        $sql="UPDATE descansos_jornada SET HORA_FIN=NOW() WHERE USER_ID=".$user_id." and fecha=CURRENT_DATE() and hora_fin is null and id_jornada=".$jornadaEnCurso[0]->id;
        
        DB::beginTransaction();
        $descansoUpdated = $this->executeUpdate($sql);

        if($descansoUpdated===false){
            DB::rollBack();
            return ["code"=>500, "msg"=>"Se ha producido un error al finalizar el descanso."];
        } 

        $sql="SELECT * FROM descansos_jornada WHERE USER_ID=".$request->user()->id." and fecha=current_date() and hora_fin is not null and id_jornada=".$jornadaEnCurso[0]->id." order by id desc limit 1";
        $descansoFinalizado = $this->executeSelect($sql);

        DB::commit();
        return ["code"=>200, "msg"=>"descanso finalizado correctamente.","data"=>$descansoFinalizado];
    }
}