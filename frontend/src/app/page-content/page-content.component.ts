import { Component } from '@angular/core';
import {RouterLink} from "@angular/router";

@Component({
  selector: 'app-page-content',
  standalone: true,
    imports: [
        RouterLink
    ],
  templateUrl: './page-content.component.html',
  styleUrl: '../../assets/css/style.css'
})
export class PageContentComponent {

}
