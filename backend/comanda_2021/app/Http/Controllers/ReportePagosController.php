<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use DB;
use Illuminate\Support\Facades\Response as FacadeResponse;

class ReportePagosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function generarReportePagosEstandarSGrupo(Request $request) {

        $star = $request["start"];
        $end = $request["end"];
        $idUsuario = $request["id"];
      
        $getCuadro =  DB::connection('saf')->select("
        select case when a.periodo_mes < 10
        then '0' + a.periodo_mes 
        else 
        a.periodo_mes
        end as mes,					
       a.periodo_año as anio,					
       convert( varchar , a.fecha_transaccion, 103) as fecha_movimiento,					
       a.cuenta,					
       (select b.nombre from catalogo_completo b where a.cuenta = b.cuenta) as nombre_cuenta,					
       a.estructura1_id as centro_costo,					
       (select b.estructura11_nombre from estructura11 b where a.estructura1_id = b.estructura11_id) as nombre_ccosto,					
       a.estructura2_id as tipo_gasto,					
       (select b.estructura21_nombre from estructura21 b where a.estructura2_id = b.estructura21_id) as nombre_tipo_gasto,					
       a.programa_curso_id as tipo_tarifario,					
       (select b.suc_descripcion from tipo_suc b where a.programa_curso_id = b.suc_codigo) as nombre_tipo_tarifario,					
       a.estructura3_id as cla_gasto,					
       (select b.estructura31_nombre from estructura31 b where a.estructura3_id = b.estructura31_id) as nombre_cla_gasto,					
       a.concepto as descripcion,					
       a.valor,					
       a.tipo_movimiento_id,					
       c.partida_id,					
       c.partida_referencia,					
       c.estado_partida_id,
        (select count(*) from comanda_db.dbo.cuentas_especiales_saf b where a.cuenta = b.cuenta)
        as indicador_cuenta_especial							
        from   saf_2011..transaccion a, 					
            saf_2011..partida c,					
            saf_2011..estructura11 b,					
            comanda_db..users d					
        where  left(cuenta,1)             = '5'					
        and    a.partida_id               = c.partida_id					
        and    b.empresa_id               = 1				
        and    b.id_user_padre            = d.jefe_inmediato		
        and    d.id                       = ".$idUsuario."			
        and    b.estructura11_id_gerencia = d.estructura11_id					
        and    d.gerente_cc               = 'S'		
        and  a.estructura1_id  in (select estructura11_id 
        from estructura11 where estructura11_id_gerencia = d.estructura11_id)
        and a.fecha_transaccion between '".$star." 00:00:00' and '".$end." 00:00:00'
        order by a.fecha_transaccion desc");

        return response()->json($getCuadro);

    }


    public function generarReportePagosGerenteCGrupo(Request $request){
        $star = $request["start"];
        $end = $request["end"];
        $idUsuario = $request["id"];
      
        $getDatos =  DB::connection('saf')->select("
        select case when a.periodo_mes < 10
        then '0' + a.periodo_mes 
        else 
        a.periodo_mes
        end as mes,					
       a.periodo_año as anio,					
       convert( varchar , a.fecha_transaccion, 103) as fecha_movimiento,					
       a.cuenta,					
       (select b.nombre from catalogo_completo b where a.cuenta = b.cuenta) as nombre_cuenta,					
       a.estructura1_id as centro_costo,					
       (select b.estructura11_nombre from estructura11 b where a.estructura1_id = b.estructura11_id) as nombre_ccosto,					
       a.estructura2_id as tipo_gasto,					
       (select b.estructura21_nombre from estructura21 b where a.estructura2_id = b.estructura21_id) as nombre_tipo_gasto,					
       a.programa_curso_id as tipo_tarifario,					
       (select b.suc_descripcion from tipo_suc b where a.programa_curso_id = b.suc_codigo) as nombre_tipo_tarifario,					
       a.estructura3_id as cla_gasto,					
       (select b.estructura31_nombre from estructura31 b where a.estructura3_id = b.estructura31_id) as nombre_cla_gasto,					
       a.concepto as descripcion,					
       a.valor,					
       a.tipo_movimiento_id,					
       c.partida_id,					
       c.partida_referencia,					
       c.estado_partida_id,
        (select count(*) from comanda_db.dbo.cuentas_especiales_saf b where a.cuenta = b.cuenta)
        as indicador_cuenta_especial							
        from   saf_2011..transaccion a, 					
            saf_2011..partida c,					
            saf_2011..estructura11 b,					
            comanda_db..users d					
            where  left(cuenta,1)  = '5'                         
            and    b.empresa_id    = 1                           
            and    b.id_user_padre = ".$idUsuario."	                          
            and    d.id                 = ".$idUsuario."	                          
            and    b.grupo_cc      = d.grupo_cc                        
            and    d.gerente_cc    = 'S'  
            and    a.partida_id  = c.partida_id                                                
            and a.fecha_transaccion between '".$star." 00:00:00' and '".$end." 00:00:00'
            and    a.estructura1_id  = b.estructura11_id
            order by a.fecha_transaccion desc");

        return response()->json($getDatos);
    }


    public function generarReportePagosNoGerente(Request $request){
        $star = $request["start"];
        $end = $request["end"];
        $idUsuario = $request["id"];
      
        $getDatos =  DB::connection('saf')->select("
        select case when a.periodo_mes < 10
        then '0' + a.periodo_mes 
        else 
        a.periodo_mes
        end as mes,					
       a.periodo_año as anio,					
       convert( varchar , a.fecha_transaccion, 103) as fecha_movimiento,					
       a.cuenta,					
       (select b.nombre from catalogo_completo b where a.cuenta = b.cuenta) as nombre_cuenta,					
       a.estructura1_id as centro_costo,					
       (select b.estructura11_nombre from estructura11 b where a.estructura1_id = b.estructura11_id) as nombre_ccosto,					
       a.estructura2_id as tipo_gasto,					
       (select b.estructura21_nombre from estructura21 b where a.estructura2_id = b.estructura21_id) as nombre_tipo_gasto,					
       a.programa_curso_id as tipo_tarifario,					
       (select b.suc_descripcion from tipo_suc b where a.programa_curso_id = b.suc_codigo) as nombre_tipo_tarifario,					
       a.estructura3_id as cla_gasto,					
       (select b.estructura31_nombre from estructura31 b where a.estructura3_id = b.estructura31_id) as nombre_cla_gasto,					
       a.concepto as descripcion,					
       a.valor,					
       a.tipo_movimiento_id,					
       c.partida_id,					
       c.partida_referencia,					
       c.estado_partida_id,
        (select count(*) from comanda_db.dbo.cuentas_especiales_saf b where a.cuenta = b.cuenta)
        as indicador_cuenta_especial							
        from   saf_2011..transaccion a, 					
            saf_2011..partida c,					
            saf_2011..estructura11 b,					
            comanda_db..users d					
        where  left(cuenta,1)             = '5'		
            and    a.partida_id             = c.partida_id		
            and    b.empresa_id             = 1		
            and    b.id_user_responsable    = d.id
            and    d.id                     = ".$idUsuario."	
            and    b.estructura11_id        = d.estructura11_id		
            and    d.gerente_cc             = 'N'	
            and	   a.estructura1_id			= d.estructura11_id	                                       
            and a.fecha_transaccion between '".$star." 00:00:00' and '".$end." 00:00:00'
            order by a.fecha_transaccion desc");

        return response()->json($getDatos);
    }
}
