import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';
import { Usuario } from '../models/usuario';
import { GlobalService } from './global.service';

@Injectable({
  providedIn: 'root'
})
export class UsuarioService {

  constructor(private globalservice: GlobalService, private http:HttpClient) { }

   //metodo para obtener usuario logeado en comanda
   public getUsuarioComanda(): Observable<Usuario> {
    return this.http.get(this.globalservice.getBackendUrl() + 'sesionDesdeComanda').pipe(map(data => data as Usuario));
  }


}
