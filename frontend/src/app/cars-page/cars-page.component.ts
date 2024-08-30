import {Component, inject, OnInit} from '@angular/core';
import {CarsService} from "../services/cars.service";

@Component({
  selector: 'app-cars-page',
  standalone: true,
  imports: [],
  templateUrl: './cars-page.component.html',
  styleUrl: './cars-page.component.css'
})

export class CarsPageComponent implements OnInit {
  cars: any = [];
  // Correct way to inject a service using the constructor
  carsService = inject(CarsService);

  getCarData() {
    this.carsService.getCars().subscribe(data => {
      this.cars = data; // You might want to save data to a local property
      console.log(data);
    });
  }

  ngOnInit(): void {
    this.getCarData();
  }
}
