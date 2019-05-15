import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { ProductsService } from 'src/app/services/products.service';
import { Product } from 'src/app/models/product.model';
import { environment } from 'src/environments/environment';
import { MatDialog } from '@angular/material/dialog';
import { ProductDetailsEmailComponent } from 'src/app/components/product-details-email/product-details-email.component';

@Component({
  selector: 'app-product-view',
  templateUrl: './product-view.component.html',
  styleUrls: ['./product-view.component.css']
})
export class ProductViewComponent implements OnInit {

  public product: Product;
  public imagesEndpoint = environment.filesEndpoint;
  public emailSent = false;
  public emailAddress: string = "";
  public emailValido = true;
  
  constructor(
    public productsService: ProductsService,
    public route: ActivatedRoute,
    public modal: MatDialog,
    ) { }

  ngOnInit() {
    let productId = this.route.snapshot.params['id'];
    this.loadProduct(productId);
  }

  modalClosed = (confirmedSendout: boolean) => {
    this.emailSent = confirmedSendout;
  }

  sendEmail() {
    
    if(this.emailAddress.trim().length > 0)
    {
      this.emailValido = true;
      this.modal.open(ProductDetailsEmailComponent, { data: { product: this.product, email: this.emailAddress, onModalClosed: this.modalClosed }, width: '400px' })
        .afterClosed().subscribe(confirmation => {
          this.emailSent = true;
        })
    } else {
      this.emailValido = false;
    }
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
