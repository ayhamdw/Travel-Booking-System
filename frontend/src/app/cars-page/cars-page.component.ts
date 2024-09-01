import { Component, inject, OnInit } from '@angular/core';
import { CarsService } from '../services/cars.service';
import { CarBlocksComponent } from '../car-blocks/car-blocks.component';
import { FormsModule } from '@angular/forms';
import { NgForOf } from "@angular/common";

@Component({
  selector: 'app-cars-page',
  standalone: true,
  imports: [
    FormsModule,
    CarBlocksComponent,
    NgForOf,
  ],
  templateUrl: './cars-page.component.html',
  styleUrls: ['./cars-page.component.css']
})
export class CarsPageComponent implements OnInit {
  cars: any[] = [];
  filteredCar: any[] = [];
  brandSearch: string = '';
  carsService = inject(CarsService);

  constructor() {}

  ngOnInit(): void {
    this.getCarData();
  }

  getCarData() {
    this.carsService.getCars().subscribe(data => {
      this.cars = data;
      this.filteredCar = this.cars;
      console.log(data);
    });
  }

  filterResults(text: string) {
    if (!text) {
      this.filteredCar = this.cars;
      return;
    }

    this.filteredCar = this.cars.filter(car =>
      car?.man_date.toLowerCase().includes(text.toLowerCase())
    );
  }

}
