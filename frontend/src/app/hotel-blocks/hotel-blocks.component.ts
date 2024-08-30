import {Component, Input} from '@angular/core';

@Component({
  selector: 'app-hotel-blocks',
  standalone: true,
  imports: [],
  templateUrl: './hotel-blocks.component.html',
  styleUrl: './hotel-blocks.component.css'
})
export class HotelBlocksComponent {
  @Input() hotelData:any;
}
