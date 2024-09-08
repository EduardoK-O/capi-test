import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ServicioDirectorioService {

  apiURL = 'http://localhost:8000/api/contactos'
  constructor(private http: HttpClient) { }

  obtenerTodos(): Observable<any> {
    return this.http.get(`${this.apiURL}`);
  }
  obtenerUno($id: any): Observable<any> {
    return this.http.get(`${this.apiURL}/${$id}`);
  }

  guardar($data: any): Observable<any> {
    let data = Object.assign({}, $data);
    return this.http.post(`${this.apiURL}`, data);
  }

  editar( $id: any, $data: any): Observable<any> {
    let data = Object.assign({}, $data);
    return this.http.put(`${this.apiURL}/${$id}`, data);
  }

  eliminar($id: any): Observable<any> {
    return this.http.delete(`${this.apiURL}/${$id}`);
  }
}
