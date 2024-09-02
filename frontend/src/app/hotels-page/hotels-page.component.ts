import {Component, inject, OnInit} from '@angular/core';
import {HotelsService} from "../services/hotels.service";
import {NgForOf} from "@angular/common";
import {HotelBlocksComponent} from "../hotel-blocks/hotel-blocks.component";
import {FormsModule} from "@angular/forms";

@Component({
  selector: 'app-hotels-page',
  standalone: true,
  imports: [
    NgForOf,
    HotelBlocksComponent,
    FormsModule
  ],
  templateUrl: './hotels-page.component.html',
  styleUrl: './hotels-page.component.css'
})
export class HotelsPageComponent implements OnInit{

  hotels:any [] = [];
  filteredHotels:any [] = [];
  numberRoom:String = ""
  address:String = ""
  rating:String = ""
  hotelsData = inject(HotelsService);


  ngOnInit(): void {
    this.getHotelData()
  }
  getHotelData () {
    this.hotelsData.getHotels().subscribe(data => {
      console.log(data);
      this.hotels = data;
      this.filteredHotels = this.hotels
    })
  }
  getFilteredHotels() {
    this.filteredHotels = this.hotels.filter(hotel => {
      return (
        (!this.numberRoom || hotel?.number_of_rooms_available.toString().toLowerCase().includes(this.numberRoom.toString().toLowerCase())) &&
        (!this.address || hotel?.address.toLowerCase().includes(this.address.toLowerCase())) &&
        (!this.rating || hotel?.rating.toString().includes(this.rating.toString()))
      );
    });
  }
}
