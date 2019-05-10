import { Component, OnInit } from '@angular/core';
import { Retailer } from 'src/app/models/retailer.model';
import { RetailersService } from 'src/app/services/retailers.service';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-retailer-view',
  templateUrl: './retailer-view.component.html',
  styleUrls: ['./retailer-view.component.css']
})
export class RetailerViewComponent implements OnInit {

  public retailer: Retailer;

  constructor(
    public retailersService: RetailersService,
    public route: ActivatedRoute
    ) {
  }

  ngOnInit() {
    let retailerId = this.route.snapshot.params['id'];
    this.loadRetailer(retailerId);
  }

  loadRetailer(id: number) {
    this.retailersService.view('/retailers/'+id).subscribe(retailer => {
      this.retailer = retailer;
    },
    error => {
      console.log(error);
    })
  }
}
