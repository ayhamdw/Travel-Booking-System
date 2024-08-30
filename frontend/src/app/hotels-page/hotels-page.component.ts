import {Component, inject, OnInit} from '@angular/core';
import {HotelsService} from "../services/hotels.service";
import {NgForOf} from "@angular/common";
import {HotelBlocksComponent} from "../hotel-blocks/hotel-blocks.component";

@Component({
  selector: 'app-hotels-page',
  standalone: true,
  imports: [
    NgForOf,
    HotelBlocksComponent
  ],
  templateUrl: './hotels-page.component.html',
  styleUrl: './hotels-page.component.css'
})
export class HotelsPageComponent implements OnInit{

  hotels:any = [];
  hotelsData = inject(HotelsService);

  getHotelData () {
    this.hotelsData.getHotels().subscribe(data => {
      console.log(data);
      this.hotels = data;
    })
  }

  ngOnInit(): void {
    this.getHotelData()
  }
}
