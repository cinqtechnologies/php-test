import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/environments/environment';
import { map } from 'rxjs/operators';
import { pipe, Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class BaseService<T> {

  public baseUrl: string; 

  constructor(
    public client: HttpClient, 
    ) { 
    this.baseUrl = environment.apiEndpoint;
    }

  index(uri: string, filters: string='') : Observable<T[]> {
    return this.client.get<T[]>(this.baseUrl+uri+filters).pipe(map((response: T[]) => response));
  }

  view(uri: string): Observable<T> {
    return this.client.get<T>(this.baseUrl+uri).pipe(map((response: T) => response));
  }

  create(uri: string, entity: T): Observable<T> {
    return this.client.post<T>(this.baseUrl+uri, entity).pipe(map((response: T) => response));
  }  
}
