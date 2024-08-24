import {Component, OnInit, Renderer2} from '@angular/core';
import { RouterOutlet } from '@angular/router';
<<<<<<< HEAD
import {TopNavComponent} from "./top-nav/top-nav.component";
=======
declare var AOS: any;
>>>>>>> origin/main

@Component({
  selector: 'app-root',
  standalone: true,
<<<<<<< HEAD
  imports: [RouterOutlet, TopNavComponent],
  templateUrl: './app.component.html',
  styleUrl: './app.component.css'
})
export class AppComponent {
  title = 'Ayham';
=======
    imports: [RouterOutlet],
  templateUrl: './app.component.html',
  styleUrl: './app.component.css'
})
export class AppComponent implements OnInit {
  constructor(private renderer: Renderer2) {
  }

  ngOnInit() {
    // === AOS === //
    AOS.init();

    // === Up button === //
    this.renderer.listen('window', 'scroll', () => {
      const span = document.querySelector(".up");
      if (window.scrollY >= 851.2) {
        this.renderer.addClass(span, 'show');
      } else {
        this.renderer.removeClass(span, 'show');
      }
    });

    const span = document.querySelector(".up");
    if (span) {
      this.renderer.listen(span, 'click', () => {
        window.scrollTo(0, 0);
      });
    }
  }
>>>>>>> origin/main
}
