import { Injectable } from '@angular/core';
import { BaseService } from './base.service';
import { Retailer } from '../models/retailer.model';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class RetailersService extends BaseService<Retailer> {
  constructor(public client: HttpClient) {
    super(client);
  }
}
