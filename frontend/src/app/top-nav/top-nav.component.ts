import {Component, OnInit, Renderer2} from '@angular/core';
import {RouterLink, RouterLinkActive, RouterOutlet} from "@angular/router";
declare var AOS: any;


@Component({
  selector: 'app-top-nav',
  standalone: true,
  imports: [
    RouterLink,
    RouterOutlet,
    RouterLinkActive
  ],
  templateUrl: './top-nav.component.html',
  styleUrl: '../../assets/css/style.css'
})
export class TopNavComponent {
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

}
