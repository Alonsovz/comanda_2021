<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware'=>['cors']], function(){
     
    Route::post('generarReportePagosEstandarSGrupo','ReportePagosController@generarReportePagosEstandarSGrupo');
  
   
    Route::post('generarReportePagosGerenteCGrupo','ReportePagosController@generarReportePagosGerenteCGrupo');

    Route::post('generarReportePagosNoGerente','ReportePagosController@generarReportePagosNoGerente');

    Route::get('sesionDesdeComanda','UserController@sesionDesdeComanda');
    
});




