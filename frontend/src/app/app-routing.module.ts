import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { RetailerListComponent } from './pages/retailer-list/retailer-list.component';
import { RetailerViewComponent } from './pages/retailer-view/retailer-view.component';
import { ProductListComponent } from './pages/product-list/product-list.component';

const routes: Routes = [
  { path: 'retailer/:id', component: RetailerViewComponent },
  { path: 'retailers', component: RetailerListComponent },
  { path: 'products', component: ProductListComponent }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
