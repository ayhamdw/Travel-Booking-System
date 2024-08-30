import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class FlightsService {
  private apiUrl = 'http://localhost:8000/api/flights';

  constructor(private http: HttpClient) { }


  getFlights(): Observable<any> {
    return this.http.get<any>(this.apiUrl);
  }
  updateFlight(id: number, flightData: any): Observable<any> {
    return this.http.put<any>(`${this.apiUrl}/${id}`, flightData);
  }
  deleteFlight(id: number): Observable<any> {
    return this.http.delete<any>(`${this.apiUrl}/${id}`);
  }
  addFlight(flightData: any): Observable<any> {
    return this.http.post<any>('http://localhost:8000/api/addflight', flightData);
  }
}
