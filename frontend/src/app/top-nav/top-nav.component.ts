import { Component } from '@angular/core';
import {RouterLink, RouterOutlet} from "@angular/router";

@Component({
  selector: 'app-top-nav',
  standalone: true,
  imports: [
    RouterLink,
    RouterOutlet
  ],
  templateUrl: './top-nav.component.html',
  styleUrl: '../../assets/css/style.css'
})
export class TopNavComponent {

}
