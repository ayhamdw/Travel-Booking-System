import { Component } from '@angular/core';
import {TopNavComponent} from "../top-nav/top-nav.component";
import {FooterComponent} from "../footer/footer.component";
import {ContactComponent} from "../contact/contact.component";
import {PageContentComponent} from "../page-content/page-content.component";

@Component({
  selector: 'app-main-page',
  standalone: true,
  imports: [
    TopNavComponent,
    FooterComponent,
    ContactComponent,
    PageContentComponent
  ],
  templateUrl: './main-page.component.html',
  styleUrl: './main-page.component.css'
})
export class MainPageComponent {

}
