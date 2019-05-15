import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { RetailerViewComponent } from './pages/retailer-view/retailer-view.component';
import { ProductListComponent } from './pages/product-list/product-list.component';
import { ProductViewComponent } from './pages/product-view/product-view.component';
import { RetailerAddComponent } from './pages/retailer-add/retailer-add.component';
import { ProductAddComponent } from './pages/product-add/product-add.component';

const routes: Routes = [
  { path: 'retailers/add', component: RetailerAddComponent },
  { path: 'retailers/:id', component: RetailerViewComponent },
  { path: 'products/add', component: ProductAddComponent },
  { path: 'products/:id', component: ProductViewComponent },
  { path: 'products', component: ProductListComponent },
  { path: '**', redirectTo: '/products' }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
