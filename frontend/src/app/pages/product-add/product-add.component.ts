import { Component, OnInit } from '@angular/core';
import { ProductsService } from 'src/app/services/products.service';
import { Product } from 'src/app/models/product.model';
import { MatDialogRef } from '@angular/material/dialog';

@Component({
  selector: 'app-product-add',
  templateUrl: './product-add.component.html',
  styleUrls: ['./product-add.component.css']
})
export class ProductAddComponent implements OnInit {

  public product: Product = new Product();
  
  constructor(
    public productsService: ProductsService,
    ) { }

  ngOnInit() {
    
  }

  setRetailerId(id: number) {
    this.product.retailerId = id;
  }

  save() {
    this.productsService.create('/products', this.product).subscribe(success => {
      console.log("Product saved successfully");
    },
    error => {
      console.log(error);
    })
  }

}
