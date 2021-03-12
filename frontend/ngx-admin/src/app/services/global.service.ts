import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class GlobalService {

  url = 'http://localhost:8000/'

  constructor() { }

  getBackendUrl() {
    return this.url;
  }
}
