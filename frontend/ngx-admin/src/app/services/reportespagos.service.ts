import { ReportePagos } from './../models/reporte-pagos';
import { Observable } from 'rxjs';
import { HttpClient } from '@angular/common/http';
import { GlobalService } from './global.service';
import { Injectable } from '@angular/core';
import { map } from 'rxjs/operators';


  
@Injectable({
  providedIn: 'root'
})
export class ReportespagosService {

  constructor(private globalservice: GlobalService, private http:HttpClient) { }

  // generar reporte de pagos
  generarReportePagosEstandarSGrupo(datos: ReportePagos): Observable<any> {
    return this.http.post(this.globalservice.getBackendUrl() + 'generarReportePagosEstandarSGrupo', datos ).pipe(
      map(data => data as any)
    );
  }

  generarReportePagosGerenteCGrupo(datos: ReportePagos): Observable<any> {
    return this.http.post(this.globalservice.getBackendUrl() + 'generarReportePagosGerenteCGrupo', datos ).pipe(
      map(data => data as any)
    );
  }


  generarReportePagosNoGerente(datos: ReportePagos): Observable<any> {
    return this.http.post(this.globalservice.getBackendUrl() + 'generarReportePagosNoGerente', datos ).pipe(
      map(data => data as any)
    );
  }
}
