import { Component, OnInit, AfterViewInit, Renderer2, ElementRef, ViewChild } from '@angular/core';
import { RouterLink, RouterLinkActive, RouterOutlet } from "@angular/router";
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
  styleUrls: ['../../assets/css/style.css'] // Corrected to 'styleUrls' instead of 'styleUrl'
})
export class TopNavComponent implements OnInit, AfterViewInit {
  @ViewChild('upButton', { static: false }) upButton!: ElementRef; // Use '!' to indicate it's definitely assigned

  constructor(private renderer: Renderer2) {}

  ngOnInit() {
    // Initialize AOS
    // AOS.init();
  }

  ngAfterViewInit() {
    // if (this.upButton) {
    //   // === Up button scroll event === //
    //   this.renderer.listen('window', 'scroll', () => {
    //     if (window.scrollY >= 851.2) {
    //       this.renderer.addClass(this.upButton.nativeElement, 'show');
    //     } else {
    //       this.renderer.removeClass(this.upButton.nativeElement, 'show');
    //     }
    //   });
    //
    //   // === Up button click event === //
    //   this.renderer.listen(this.upButton.nativeElement, 'click', () => {
    //     window.scrollTo(0, 0);
    //   });
    // }
  }
}
