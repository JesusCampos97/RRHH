<?php 

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use File;

trait Utils{

    public function actualizarLog($user,$id_registro,$tabla,$operacion){
        $sql="INSERT INTO log_transactions(fecha,user_id,hora,id_registro_afectado,tabla_afectada,operacion) VALUES(CURRENT(),".$user."
        ,CURRENT_TIME(),".$id_registro.",'".$tabla."','".$operacion."')";
        try{
            DB::insert(DB::raw($sql));
        } catch (\Illuminate\Database\QueryException $exception) {
            Session::flash('error', Session::get('error').". Excepción en log.");
            return false;
        }
    }

    public function executeSelect($sql){

        try{
            $select=DB::select($sql);
        } catch (\Illuminate\Database\QueryException $exception) {
            Session::flash('error', Session::get('error').". Excepción en la selección de datos.");
            return false;
        }        

        return $select;
    }

    public function executeUpdate($sql){

        try{
            $update=DB::update($sql);
        } catch (\Illuminate\Database\QueryException $exception) {
            Session::flash('error', Session::get('error').". Excepción en la actualización de datos.");
            return false;
        }        

        return true;
    }

    public function executeInsert($sql){

        try{
            $insert=DB::insert($sql);
        } catch (\Illuminate\Database\QueryException $exception) {
            Session::flash('error', Session::get('error').". Excepción en la inserción de datos.");
            return false;
        }        

        return DB::getPdo()->lastInsertId();
    }

    public function executeDelete($sql){

        try{
            $insert=DB::delete($sql);
        } catch (\Illuminate\Database\QueryException $exception) {
            Session::flash('error', Session::get('error').". Excepción en el borrado de datos.");
            return false;
        }        

        return true;
    }

}