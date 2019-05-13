import { Component, OnInit } from '@angular/core';
import { Retailer } from 'src/app/models/retailer.model';
import { RetailersService } from 'src/app/services/retailers.service';
import { ActivatedRoute } from '@angular/router';
import { environment } from 'src/environments/environment';

@Component({
  selector: 'app-retailer-view',
  templateUrl: './retailer-view.component.html',
  styleUrls: ['./retailer-view.component.css']
})
export class RetailerViewComponent implements OnInit {

  public retailer: Retailer;
  public imagesEndpoint = environment.filesEndpoint;

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
      this.retailer.logo = this.imagesEndpoint+'/'+retailer.logo;
    },
    error => {
      console.log(error);
    })
  }
}
