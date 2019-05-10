import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { RetailerListComponent } from './pages/retailer-list/retailer-list.component';
import { HttpClientModule, HttpClient } from '@angular/common/http';
import { RetailersService } from './services/retailers.service';
import { BaseService } from './services/base.service';
import { RetailerViewComponent } from './pages/retailer-view/retailer-view.component';
import { ProductsTableComponent } from './components/products-table/products-table.component';
import { ProductListComponent } from './pages/product-list/product-list.component';
import { ProductViewComponent } from './pages/product-view/product-view.component';
import { RetailerAddComponent } from './pages/retailer-add/retailer-add.component';

@NgModule({
  declarations: [
    AppComponent,
    RetailerListComponent,
    RetailerViewComponent,
    ProductsTableComponent,
    ProductListComponent,
    ProductViewComponent,
    RetailerAddComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule
  ],
  providers: [
    BaseService,
    RetailersService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
