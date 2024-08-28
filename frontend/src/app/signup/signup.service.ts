import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, catchError, throwError } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class SignupService {
  private apiUrl = 'http://127.0.0.1/project/backend/public/api/users/register';  // Replace with your API endpoint

  constructor(private http: HttpClient) {}

  signup(data: any): Observable<any> {
    return this.http.post<any>(this.apiUrl, data).pipe(
      catchError(error => {
        // Handle error and rethrow it
        return throwError(() => error);
      })
    );
  }
}