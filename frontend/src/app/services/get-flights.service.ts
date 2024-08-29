import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";

@Injectable({
  providedIn: 'root' // all components under root can access this service
})
export class GetFlightsService {

  constructor(private http: HttpClient) {

  }

  getFlights() {
    return this.http.get<any>('http://localhost:8000/api/flights/search/all');
  }

}
