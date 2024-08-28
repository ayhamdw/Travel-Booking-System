import { Injectable } from '@angular/core';
import {Observable} from "rxjs";
import {HttpClient} from "@angular/common/http";

@Injectable({
  providedIn: 'root'
})
export class CarsService {
  private apiUrl = 'http://127.0.0.1:8000/api/cars';

  constructor(private http: HttpClient) { }

  getCars(): Observable<any> {
    return this.http.get<any>(this.apiUrl);
  }

  updateCar(id: number, carData: any): Observable<any> {
    return this.http.put<any>(`${this.apiUrl}/${id}`, carData);
  }

  deleteCar(id: number): Observable<any> {
    return this.http.delete<any>(`${this.apiUrl}/${id}`);
  }
  addCar(carData: any): Observable<any> {
    return this.http.post<any>('http://127.0.0.1:8000/api/addcar', carData);
  }
}
