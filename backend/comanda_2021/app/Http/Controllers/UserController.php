<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use DB;
use Illuminate\Support\Facades\Response as FacadeResponse;

class UserController extends Controller
{
    public function sesionDesdeComanda(){
        
        $usuariosesion =  json_encode(DB::connection('comanda')->select("
        select u.*,
        case when u.grupo_cc is null
        then
        'No'
        else
        u.grupo_cc
        end as grupoAsig from users as u
        inner join crm_inicioSesion cs on cs.usuario = u.correo
        "));


        $arrayJson = [];
        foreach (json_decode($usuariosesion, true) as $value){
            $arrayJson = $value;
        }

        return $arrayJson;

    }
}



?>