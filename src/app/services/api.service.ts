import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class ApiService {

  private PATH = 'http://localhost/smuc-back-office-api';

  constructor(private http: HttpClient) { 

  }

  public postLogin(email?:string | null, password?: string| null) {

    return this.http.post(this.PATH + '/user/', { email, password });
      
  }

}
