import {Component} from '@angular/core';
import {RouterLink, RouterOutlet} from '@angular/router';
import {TopNavComponent} from "./top-nav/top-nav.component";
import {MainPageComponent} from "./main-page/main-page.component";

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [RouterOutlet, TopNavComponent, MainPageComponent, RouterLink],
  templateUrl: './app.component.html',
  styleUrl: '../assets/css/style.css'
})

export class AppComponent {

}
