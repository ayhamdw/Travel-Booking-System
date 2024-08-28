import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs";

@Injectable({
  providedIn: 'root'
})
export class HotelsService {

  private apiUrl = 'http://127.0.0.1:8000/api/hotels';

  constructor(private http: HttpClient) { }

  getHotels(): Observable<any[]> {
    return this.http.get<any[]>(this.apiUrl);
  }


  addHotel(hotel: any): Observable<any> {
    return this.http.post<any>('http://127.0.0.1:8000/api/addhotel', hotel);
  }

  updateHotel(id: number, hotel: any): Observable<any> {
    return this.http.put<any>(`${this.apiUrl}/${id}`, hotel);
  }

  deleteHotel(id: number): Observable<any> {
    return this.http.delete<any>(`${this.apiUrl}/${id}`);
  }
}
