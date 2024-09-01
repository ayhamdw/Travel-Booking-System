import {Component, Input} from '@angular/core';
import {DatePipe, NgIf} from "@angular/common";

@Component({
  selector: 'app-flight-blocks',
  standalone: true,
  imports: [
    DatePipe,
    NgIf
  ],
  templateUrl: './flight-blocks.component.html',
  styleUrl: './flight-blocks.component.css'
})
export class FlightBlocksComponent {
  @Input() flightData:any;
}
