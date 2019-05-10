import { Component, OnInit } from '@angular/core';
import { RetailersService } from 'src/app/services/retailers.service';
import { Retailer } from 'src/app/models/retailer.model';
import { Router } from '@angular/router';

@Component({
  selector: 'app-retailer-add',
  templateUrl: './retailer-add.component.html',
  styleUrls: ['./retailer-add.component.css']
})
export class RetailerAddComponent implements OnInit {

  public retailer: Retailer = new Retailer();
  public success;
  public error;
  
  constructor(
    public retailersService: RetailersService,
    public router: Router
    ) { }

  ngOnInit() {
  }

  navigateToIndex() {
    this.router.navigate(['/']);
  }
  
  save() {

    this.retailersService.create('/retailers', this.retailer).subscribe(success => {
      this.error = false;
      this.success = true;

      setTimeout(this.navigateToIndex.bind(this), 3000);

    },
    errors => {
      this.error = true;
    })
  }
}
