import { Component, OnInit } from '@angular/core';
import { RetailersService } from 'src/app/services/retailers.service';
import { Retailer } from 'src/app/models/retailer.model';

@Component({
  selector: 'app-retailers-dropdown',
  templateUrl: './retailers-dropdown.component.html',
  styleUrls: ['./retailers-dropdown.component.css']
})
export class RetailersDropdownComponent implements OnInit {

  public retailers: Retailer[];
  
  constructor(public retailersService: RetailersService) { }

  ngOnInit() {
    this.fetchRetailers();
  }

  fetchRetailers() {
    this.retailersService.index('/retailers').subscribe(retailers => {
      this.retailers = retailers;
    },
    error => {
      console.log("Error while fetching the retailers to the dropdown");
    })
  }

}
