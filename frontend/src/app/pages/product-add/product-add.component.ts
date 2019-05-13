import { Component, OnInit } from '@angular/core';
import { ProductsService } from 'src/app/services/products.service';
import { Product } from 'src/app/models/product.model';
import { MatDialog } from '@angular/material/dialog';
import { FeedbackModalComponent } from 'src/app/components/feedback-modal/feedback-modal.component';
import { Router } from '@angular/router';

@Component({
  selector: 'app-product-add',
  templateUrl: './product-add.component.html',
  styleUrls: ['./product-add.component.css']
})
export class ProductAddComponent implements OnInit {

  public product: Product = new Product();
  public validationErrors: any = {};
  
  constructor(
    public productsService: ProductsService,
    public modal: MatDialog,
    public router: Router
    ) { }

  ngOnInit() {
  }

  setRetailerId(id: number) {
    this.product.retailerId = id;
  }

  navigateToIndex() {
    this.router.navigate(['/']);
  }

  setImage(event) {
    let reader = new FileReader();
    if (event.target.files && event.target.files.length > 0) {
      let file = event.target.files[0];
      reader.readAsDataURL(file);
      reader.onload = () => {
        this.product.image = {
          filetype: file.type,
          value: reader.result.toString().split(',')[1]
        }
      };
    }
  }

  save() {

    this.productsService.create('/products', this.product).subscribe(success => {
      this.modal.open(FeedbackModalComponent, { data: { status: 'success', message: 'Product saved successfully!' } })
      .afterClosed().subscribe(redirect => {
        setTimeout(this.navigateToIndex.bind(this), 100);
      })
    },
    error => {
      console.log(error);
      this.validationErrors = error.error;
    })
  }
}
