import {Component, inject, OnInit} from '@angular/core';
import {NgForOf, NgIf} from "@angular/common";
import {FlightsService} from "../../../services/flights.service";
import { FormsModule } from "@angular/forms";
import {Router} from "@angular/router";


@Component({
  selector: 'app-flights-list',
  standalone: true,
  imports: [
    NgForOf,
    FormsModule,
    NgIf
  ],
  templateUrl: './flights-list.component.html',
  styleUrl: './flights-list.component.css'
})

export class FlightsListComponent implements OnInit {
  flights: any[] = []; // Initialize as an empty array
  //flightsService = inject(FlightsService);
  editIndex: number | null = null; // Track which row is being edited
  newFlight: any = {};
  showAddFlightForm: boolean = false;
 // constructor(private flightsService: FlightsService) { }
  constructor(private flightsService: FlightsService, private router: Router) { }

  ngOnInit(): void {
    this.getFlights();
  }

  getFlights(): void {
    this.flightsService.getFlights().subscribe(
      data => {
        this.flights = data; // Assign API data to the component property
      },
      error => {
        console.error('Error fetching flights:', error);
      }
    );
  }
  editFlight(index: number): void {
    this.editIndex = index; // Set the row to edit mode
  }

  saveFlight(flight: any): void {
    // Your logic to save the updated flight, including only price and seats_left
    this.flightsService.updateFlight(flight.id, {
      price: flight.price,
      seats_left: flight.seats_left
    }).subscribe(response => {
      this.editIndex = -1; // Exit edit mode
      // Handle success, e.g., show a success message or update the flight list
    });
  }
  cancelEdit(): void {
    this.editIndex = null; // Cancel edit mode
  }

  deleteFlight(id: number): void {
    if (confirm('Are you sure you want to delete this flight?')) {
      this.flightsService.deleteFlight(id).subscribe(
        () => {
          this.flights = this.flights.filter(flight => flight.id !== id);
          console.log('Flight deleted successfully');
        },
        error => {
          console.error('Error deleting flight:', error);
        }
      );
    }
  }

  addFlight(): void {
    this.flightsService.addFlight(this.newFlight).subscribe(
      response => {
        console.log('Flight added successfully', response);
        this.getFlights(); // Refresh the flight list
        this.cancelForm(); // Close the form
      },
      error => {
        console.error('Error adding flight:', error);
      }
    );
  }
  showForm(): void {
    this.showAddFlightForm = true; // Show the form
  }
  cancelForm(): void {
    this.showAddFlightForm = false; // Hide the form
  }
}
