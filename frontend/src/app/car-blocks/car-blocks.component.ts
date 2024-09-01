import {Component, Input} from '@angular/core';

@Component({
  selector: 'app-car-blocks',
  standalone: true,
  imports: [],
  templateUrl: './car-blocks.component.html',
  styleUrl: './car-blocks.component.css'
})
export class CarBlocksComponent {
  @Input() carData:any;
}
