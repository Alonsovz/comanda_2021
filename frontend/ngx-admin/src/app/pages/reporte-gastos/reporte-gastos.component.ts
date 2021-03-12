import { ReportespagosService } from './../../services/reportespagos.service';
import { ReportePagos } from './../../models/reporte-pagos';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { Component, OnInit } from '@angular/core';
import * as moment from 'moment';
import { SmartTableData } from '../../@core/data/smart-table';
import { LocalDataSource } from 'ng2-smart-table';
import { Usuario } from '../../models/usuario';

@Component({
  selector: 'ngx-reporte-gastos',
  templateUrl: './reporte-gastos.component.html',
  styleUrls: ['./reporte-gastos.component.scss']
})
export class ReporteGastosComponent implements OnInit {

  frm_rangepickerGerenteConGrupo: FormGroup;
  frm_rangepickerGerenteSinGrupo : FormGroup;
  frm_rangepickerNoGerentes : FormGroup;

  usuario : Usuario = new Usuario();

  listaSQL : [];
  verTabla = false;
  progressBar = false;

  constructor(private reporteservice: ReportespagosService, private service: SmartTableData ) {
    this.frm_rangepickerGerenteSinGrupo = new FormGroup({
      'rango1': new FormControl('', Validators.required)
    });

    this.frm_rangepickerGerenteConGrupo = new FormGroup({
      'rango2': new FormControl('', Validators.required)
    });

    this.frm_rangepickerNoGerentes = new FormGroup({
      'rango3': new FormControl('', Validators.required)
    });
  }

  ngOnInit(): void {

    if(localStorage.getItem('usuario') !== null){
    
      this.usuario = JSON.parse(localStorage.getItem("usuario"));
  }
  }

  generarReportePagosEstandarSGrupo() {
    this.progressBar = true;
    this.verTabla = false;

    const m1 = moment(this.frm_rangepickerGerenteSinGrupo.controls['rango1'].value.start).format('YYYYMMDD');
    const m2 = moment(this.frm_rangepickerGerenteSinGrupo.controls['rango1'].value.end).format('YYYYMMDD');
    const r: ReportePagos = new ReportePagos();
    r.end = m2;
    r.start = m1;
    
    const us: Usuario = new Usuario();
    us.id = this.usuario.id;

    const datos = Object.assign(r,us);

    //llamada a service para generar reporte de pagos
    this.reporteservice.generarReportePagosEstandarSGrupo(datos).subscribe(
      response => {
        this.listaSQL = response;
      
      },
      err => {},
      () => {
        this.progressBar = false;
        this.verTabla = true;
       
      }
    );
  }


  generarReportePagosGerenteConGrupo(){
    this.progressBar = true;
    this.verTabla = false;

    const m11 = moment(this.frm_rangepickerGerenteConGrupo.controls['rango2'].value.start).format('YYYYMMDD');
    const m21 = moment(this.frm_rangepickerGerenteConGrupo.controls['rango2'].value.end).format('YYYYMMDD');

    const r1: ReportePagos = new ReportePagos();
    r1.end = m21;
    r1.start = m11;
    
    const us1: Usuario = new Usuario();
    us1.id = this.usuario.id;

    const datos1 = Object.assign(r1,us1);

    //llamada a service para generar reporte de pagos
    this.reporteservice.generarReportePagosGerenteCGrupo(datos1).subscribe(
      response => {
        this.listaSQL = response;
      
      },
      err => {},
      () => {
        this.progressBar = false;
        this.verTabla = true;
       
      }
    );
  }

  generarReportePagosNoGerente(){
    this.progressBar = true;
    this.verTabla = false;

    const inicio = moment(this.frm_rangepickerNoGerentes.controls['rango3'].value.start).format('YYYYMMDD');
    const final = moment(this.frm_rangepickerNoGerentes.controls['rango3'].value.end).format('YYYYMMDD');

    const objReporte: ReportePagos = new ReportePagos();
    objReporte.end = inicio;
    objReporte.start = final;
    
    const objUsuario: Usuario = new Usuario();
    objUsuario.id = this.usuario.id;

    const datosEnvio = Object.assign(objReporte,objUsuario);

    //llamada a service para generar reporte de pagos
    this.reporteservice.generarReportePagosNoGerente(datosEnvio).subscribe(
      response => {
        this.listaSQL = response;
      
      },
      err => {},
      () => {
        this.progressBar = false;
        this.verTabla = true;
       
      }
    );
  }

}
