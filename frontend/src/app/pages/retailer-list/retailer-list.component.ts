import { Component, OnInit } from '@angular/core';
import { RetailersService } from 'src/app/services/retailers.service';
import { Retailer } from 'src/app/models/retailer.model';

@Component({
  selector: 'app-retailer-list',
  templateUrl: './retailer-list.component.html',
  styleUrls: ['./retailer-list.component.css']
})
export class RetailerListComponent implements OnInit {

  public retailers: Retailer[];
  
  constructor(public retailersService: RetailersService) {
    
  }

  ngOnInit() {
    this.fetchRetailers();
  }

  fetchRetailers() {
    this.retailersService.index('/retailers').subscribe(retailers => {
      this.retailers = retailers;
    },
    error => {
      console.log(error);
    })
  }

}
