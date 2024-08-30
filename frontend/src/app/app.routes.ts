import { Routes } from '@angular/router';
import {MainPageComponent} from "./main-page/main-page.component";
import { CarsPageComponent } from './cars-page/cars-page.component';
import { HotelsPageComponent } from './hotels-page/hotels-page.component';
import { FlightsPageComponent } from './flights-page/flights-page.component';

import { SignupComponent } from './signup/signup.component';
import { LoginComponent } from './login/login.component';
import { HomeComponent } from './home/home.component';

import {AdminDashboardComponent} from "./admin-dashboard/admin-dashboard.component";
import {BookingsComponent} from "./admin/bookings/bookings.component";
import {ReviewsComponent} from "./admin/reviews/reviews.component";
import {ServicesComponent} from "./admin/services/services.component";
import {FlightsListComponent} from "./admin/services/flights-list/flights-list.component";
import {HotelsListComponent} from "./admin/services/hotels-list/hotels-list.component";
import {CarsListComponent} from "./admin/services/cars-list/cars-list.component";


export const routes: Routes = [
  {path:'' , component: MainPageComponent},
  {path:'cars' , component:CarsPageComponent},
  {path:'hotels' , component:HotelsPageComponent},
  {path:'flights' , component:FlightsPageComponent},
  {path:'signup' , component:SignupComponent},
  {path:'login' , component:LoginComponent},
  {path:'home' , component:HomeComponent},

  {
    path: 'admin',
    component: AdminDashboardComponent,
    children: [
      { path: 'bookings', component: BookingsComponent },
      { path: 'reviews', component: ReviewsComponent },
      { path: 'services', component: ServicesComponent },
      { path: 'services/flights', component: FlightsListComponent },
      { path: 'services/hotels', component: HotelsListComponent },
      { path: 'services/cars', component: CarsListComponent }
    ],
  },

];
