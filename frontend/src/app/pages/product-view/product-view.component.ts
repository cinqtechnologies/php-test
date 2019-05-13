import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { ProductsService } from 'src/app/services/products.service';
import { Product } from 'src/app/models/product.model';
import { environment } from 'src/environments/environment';

@Component({
  selector: 'app-product-view',
  templateUrl: './product-view.component.html',
  styleUrls: ['./product-view.component.css']
})
export class ProductViewComponent implements OnInit {

  public product: Product;
  public imagesEndpoint = environment.filesEndpoint;
  
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
      this.product.image = this.imagesEndpoint+'/'+product.image;
    },
    error => {
      console.log(error);
    })
  }

}
