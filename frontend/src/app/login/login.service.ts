import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable, catchError, throwError } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class LoginService {
  private apiUrl = 'http://127.0.0.1/project/backend/public/login';

  constructor(private http: HttpClient) {}

  login(data: any): Observable<any> {
    // Retrieve the CSRF token from the meta tag
    // const csrfToken = (document.querySelector('meta[name="csrf-token"]') as HTMLMetaElement)?.getAttribute('content');

    // Set headers including the CSRF token
    const headers = new HttpHeaders({
      'Content-Type': 'application/json',
      // 'X-CSRF-TOKEN': csrfToken || ''
    });

    return this.http.post<any>(this.apiUrl, data, { headers }).pipe(
      catchError(error => {
        return throwError(() => error);
      })
    );
  }
}
