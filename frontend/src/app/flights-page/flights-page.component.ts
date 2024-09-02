import {Component, inject, OnInit} from '@angular/core';
import {TopNavComponent} from "../top-nav/top-nav.component";
import {RouterOutlet} from "@angular/router";
import {GetFlightsService} from "../services/get-flights.service";
import {NgForOf} from "@angular/common";
import {FlightBlocksComponent} from "../flight-blocks/flight-blocks.component";
import {FormsModule} from "@angular/forms";

@Component({
  selector: 'app-flights-page',
  standalone: true,
  imports: [
    FormsModule,
    TopNavComponent,
    RouterOutlet,
    NgForOf,
    FlightBlocksComponent
  ],
  templateUrl: './flights-page.component.html',
  styleUrl: './flights-page.component.css'
})
export class FlightsPageComponent implements OnInit {

  flights:any []= [];
  filteredFlights:any[] = [];
  flightService = inject(GetFlightsService);
  departure:String = ""
  dest:String = ""
  departureDate:String = ""

  ngOnInit(): void {
    this.getFlights();
  }

  getFlights()  {
    this.flightService.getFlights().subscribe(flights => {
      console.log(flights);
      this.flights = flights; // to pass the flights to the frontend (html page)
      this.filteredFlights = flights
    });
  }
  getFilteredFlights() {
    this.filteredFlights = this.flights.filter(flight => {
      return (
        (!this.departure || flight?.departure.toLowerCase().includes(this.departure.toLowerCase())) &&
        (!this.dest || flight?.dest.toLowerCase().includes(this.dest.toLowerCase())) &&
        (!this.departureDate || flight?.departure_date.toLowerCase().includes(this.departureDate.toLowerCase()))
      );
    });
  }
}
