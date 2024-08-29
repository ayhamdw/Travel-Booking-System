import { Routes } from '@angular/router';
import {MainPageComponent} from "./main-page/main-page.component";
import { CarsPageComponent } from './cars-page/cars-page.component';
import { HotelsPageComponent } from './hotels-page/hotels-page.component';
import { FlightsPageComponent } from './flights-page/flights-page.component';
import { SignupComponent } from './signup/signup.component';
import { LoginComponent } from './login/login.component';
import { HomeComponent } from './home/home.component';
export const routes: Routes = [
  {path:'' , component: MainPageComponent},
  {path:'cars' , component:CarsPageComponent},
  {path:'hotels' , component:HotelsPageComponent},
  {path:'flights' , component:FlightsPageComponent},
  {path:'signup' , component:SignupComponent},
  {path:'login' , component:LoginComponent},
  {path:'home' , component:HomeComponent},
];
