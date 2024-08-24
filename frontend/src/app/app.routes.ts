import { Routes } from '@angular/router';
import {MainPageComponent} from "./main-page/main-page.component";
import { CarsPageComponent } from './cars-page/cars-page.component';
import { HotelsPageComponent } from './hotels-page/hotels-page.component';
import { FlightsPageComponent } from './flights-page/flights-page.component';
export const routes: Routes = [
  {path:'' , component: MainPageComponent},
  {path:'cars' , component:CarsPageComponent},
  {path:'hotels' , component:HotelsPageComponent},
  {path:'flights' , component:FlightsPageComponent},
];
