import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { RetailerListComponent } from './pages/retailer-list/retailer-list.component';
import { HttpClientModule, HttpClient } from '@angular/common/http';
import { RetailersService } from './services/retailers.service';
import { BaseService } from './services/base.service';

@NgModule({
  declarations: [
    AppComponent,
    RetailerListComponent
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
