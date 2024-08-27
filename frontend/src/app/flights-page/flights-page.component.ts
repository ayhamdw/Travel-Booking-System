import { Component } from '@angular/core';
import {TopNavComponent} from "../top-nav/top-nav.component";
import {RouterOutlet} from "@angular/router";

@Component({
  selector: 'app-flights-page',
  standalone: true,
  imports: [
    TopNavComponent,
    RouterOutlet
  ],
  templateUrl: './flights-page.component.html',
  styleUrl: './flights-page.component.css'
})
export class FlightsPageComponent {

}
