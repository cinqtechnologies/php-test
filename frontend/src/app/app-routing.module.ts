import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { RetailerViewComponent } from './pages/retailer-view/retailer-view.component';
import { ProductListComponent } from './pages/product-list/product-list.component';
import { ProductViewComponent } from './pages/product-view/product-view.component';
import { RetailerAddComponent } from './pages/retailer-add/retailer-add.component';

const routes: Routes = [
  { path: 'retailers/add', component: RetailerAddComponent },
  { path: 'retailers/:id', component: RetailerViewComponent },
  { path: 'products/:id', component: ProductViewComponent },
  { path: 'products', component: ProductListComponent },
  { path: '**', redirectTo: '/products' }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
