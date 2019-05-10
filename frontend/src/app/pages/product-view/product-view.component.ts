import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { ProductsService } from 'src/app/services/products.service';
import { Product } from 'src/app/models/product.model';

@Component({
  selector: 'app-product-view',
  templateUrl: './product-view.component.html',
  styleUrls: ['./product-view.component.css']
})
export class ProductViewComponent implements OnInit {

  public product: Product;
  
  constructor(
    public productsService: ProductsService,
    public route: ActivatedRoute
    ) { }

  ngOnInit() {
    let productId = this.route.snapshot.params['id'];
    this.loadProduct(productId);
  }
  
  loadProduct(id: number) {
    this.productsService.view('/products/'+id).subscribe(product => {
      this.product = product;
    },
    error => {
      console.log(error);
    })
  }

}
