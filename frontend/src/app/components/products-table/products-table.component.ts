import { Component, OnInit, Input } from '@angular/core';
import { ProductsService } from 'src/app/services/products.service';
import { Product } from 'src/app/models/product.model';
import { identifierModuleUrl } from '@angular/compiler';

@Component({
  selector: 'app-products-table',
  templateUrl: './products-table.component.html',
  styleUrls: ['./products-table.component.css']
})
export class ProductsTableComponent implements OnInit {

  @Input()
  public retailerId: number;
  public products: Product[];
  
  constructor(public productsService: ProductsService) { }
  
  ngOnInit() {
    this.fetchProducts();
  }

  fetchProducts() {
    
    let uri: string = this.retailerId ? '/products?retailerId='+this.retailerId : '/products';
    
    this.productsService.index(uri).subscribe(products => {
      this.products = products;
    },
    error => { console.log(error); })
  }

}
