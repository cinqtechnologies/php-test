import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { RetailerListComponent } from './pages/retailer-list/retailer-list.component';
import { RetailerViewComponent } from './pages/retailer-view/retailer-view.component';

const routes: Routes = [
  { path: 'retailer/:id', component: RetailerViewComponent },
  { path: 'retailers', component: RetailerListComponent }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
