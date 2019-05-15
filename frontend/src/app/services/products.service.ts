import { Injectable } from '@angular/core';
import { BaseService } from './base.service';
import { Product } from '../models/product.model';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class ProductsService extends BaseService<Product> {

  constructor(public client: HttpClient) {
    super(client);
  }
}
