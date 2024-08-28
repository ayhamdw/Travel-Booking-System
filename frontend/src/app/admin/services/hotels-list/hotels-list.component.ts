import {Component, OnInit} from '@angular/core';
import {NgForOf, NgIf} from "@angular/common";
import {FormsModule} from "@angular/forms";
import {HotelsService} from "../../../services/hotels.service";

@Component({
  selector: 'app-hotels-list',
  standalone: true,
  imports: [
    NgForOf,
    FormsModule,
    NgIf
  ],
  templateUrl: './hotels-list.component.html',
  styleUrl: './hotels-list.component.css'
})

  export class HotelsListComponent implements OnInit {
  hotels: any[] = [];
  newHotel: any = {};

  showAddHotelForm = false;
  editIndex: number | null = null;

  constructor(private hotelService: HotelsService) { }

  ngOnInit(): void {
    this.loadHotels();
  }

  loadHotels(): void {
    this.hotelService.getHotels().subscribe(data => this.hotels = data);
  }

  showForm(): void {
    this.showAddHotelForm = true;
  }

  addHotel(): void {
    this.hotelService.addHotel(this.newHotel).subscribe(() => {
      this.loadHotels();
      this.cancelForm();
    });
  }

  editHotel(index: number): void {
    this.editIndex = index;
  }

  saveHotel(hotel: any): void {
    this.hotelService.updateHotel(hotel.id, hotel).subscribe(() => {
      this.loadHotels();
      this.cancelEdit();
    });
  }

  cancelForm(): void {
    this.showAddHotelForm = false;
    this.newHotel = {
      name: '',
      location: '',
      price_per_night: null,
      description: '',
      rating: null,
      number_of_rooms_available: null,
      thumbnail_url: ''
    };
  }

  cancelEdit(): void {
    this.editIndex = null;
  }

  deleteHotel(id: number): void {
    if (confirm('Are you sure you want to delete this hotel?')) {
      this.hotelService.deleteHotel(id).subscribe(
      ()=> {
          this.hotels = this.hotels.filter(hotel => hotel.id !== id);
          console.log('Hotel deleted successfully');
        },
        error => {
          console.error('Error deleting Hotel:', error);
        }
      );
    }

  }

}
