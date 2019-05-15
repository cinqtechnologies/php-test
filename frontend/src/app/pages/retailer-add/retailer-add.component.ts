import { Component, OnInit } from '@angular/core';
import { RetailersService } from 'src/app/services/retailers.service';
import { Retailer } from 'src/app/models/retailer.model';
import { Router } from '@angular/router';
import { MatDialog } from '@angular/material/dialog';
import { FeedbackModalComponent } from 'src/app/components/feedback-modal/feedback-modal.component';

@Component({
  selector: 'app-retailer-add',
  templateUrl: './retailer-add.component.html',
  styleUrls: ['./retailer-add.component.css']
})
export class RetailerAddComponent implements OnInit {

  public retailer: Retailer = new Retailer();
  public validationErrors = {name: null, retailer: null, description: null, website: null};
  
  constructor(
    public retailersService: RetailersService,
    public router: Router,
    public modal: MatDialog
    ) { }

  ngOnInit() {
  }

  setImage(event) {
    let reader = new FileReader();
    if (event.target.files && event.target.files.length > 0) {
      let file = event.target.files[0];
      reader.readAsDataURL(file);
      reader.onload = () => {
        this.retailer.logo = {
          filetype: file.type,
          value: reader.result.toString().split(',')[1]
        }
      };
    }
  }

  navigateToIndex() {
    this.router.navigate(['/']);
  }
  
  save() {

    this.retailersService.create('/retailers', this.retailer).subscribe(success => {
      this.modal.open(FeedbackModalComponent, { data: { status: 'success', message: 'Retailer saved successfully!' } })
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
