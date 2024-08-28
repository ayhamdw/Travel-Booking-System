import {Component, OnInit} from '@angular/core';
import { NgForOf, NgIf } from '@angular/common';
import { CarsService } from '../../../services/cars.service';
import { FormsModule } from '@angular/forms';
import { Router } from '@angular/router';

@Component({
  selector: 'app-cars-list',
  standalone: true,
  imports: [NgForOf,
    FormsModule,
    NgIf],
  templateUrl: './cars-list.component.html',
  styleUrl: './cars-list.component.css'
})

export class CarsListComponent implements OnInit {

  cars: any[] = []; // Initialize as an empty array
  editIndex: number | null = null; // Track which row is being edited
  newCar: any = {};
  showAddCarForm: boolean = false;

  constructor(private carsService: CarsService, private router: Router) { }

  ngOnInit(): void {
    this.getCars();
  }

  getCars(): void {
    this.carsService.getCars().subscribe(
      data => {
        this.cars = data; // Assign API data to the component property
      },
      error => {
        console.error('Error fetching cars:', error);
      }
    );
  }

  editCar(index: number): void {
    this.editIndex = index; // Set the row to edit mode
  }

  saveCar(car: any): void {
    // Your logic to save the updated car, including only price_per_hour and colour
    this.carsService.updateCar(car.id, {
      price_per_hour: car.price_per_hour,
      colour: car.colour
    }).subscribe(response => {
      this.editIndex = -1; // Exit edit mode
      // Handle success, e.g., show a success message or update the car list
    });
  }

  cancelEdit(): void {
    this.editIndex = null; // Cancel edit mode
  }

  deleteCar(id: number): void {
    if (confirm('Are you sure you want to delete this car?')) {
      this.carsService.deleteCar(id).subscribe(
        () => {
          this.cars = this.cars.filter(car => car.id !== id);
          console.log('Car deleted successfully');
        },
        error => {
          console.error('Error deleting car:', error);
        }
      );
    }
  }

  addCar(): void {
    this.carsService.addCar(this.newCar).subscribe(
      response => {
        console.log('Car added successfully', response);
        this.getCars(); // Refresh the car list
        this.cancelForm(); // Close the form
      },
      error => {
        console.error('Error adding car:', error);
      }
    );
  }

  showForm(): void {
    this.showAddCarForm = true; // Show the form
  }

  cancelForm(): void {
    this.showAddCarForm = false; // Hide the form
  }
}


