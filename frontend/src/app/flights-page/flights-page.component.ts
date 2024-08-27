import {Component, inject, OnInit} from '@angular/core';
import {TopNavComponent} from "../top-nav/top-nav.component";
import {RouterOutlet} from "@angular/router";
import {GetFlightsService} from "../services/get-flights.service";
import {NgForOf} from "@angular/common";
import {FlightBlocksComponent} from "../flight-blocks/flight-blocks.component";

@Component({
  selector: 'app-flights-page',
  standalone: true,
  imports: [
    TopNavComponent,
    RouterOutlet,
    NgForOf,
    FlightBlocksComponent
  ],
  templateUrl: './flights-page.component.html',
  styleUrl: './flights-page.component.css'
})
export class FlightsPageComponent implements OnInit{

  flights:any = [];
  flightService = inject(GetFlightsService);
  getFlights()  {
    this.flightService.getFlights().subscribe(flights => {
      console.log(flights);
      this.flights = flights; // to pass the flights to the frontend (html page)
    });
  }

  ngOnInit(): void {
    this.getFlights();
  }
}
