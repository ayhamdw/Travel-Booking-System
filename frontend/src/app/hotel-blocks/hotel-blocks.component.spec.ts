import { ComponentFixture, TestBed } from '@angular/core/testing';

import { HotelBlocksComponent } from './hotel-blocks.component';

describe('HotelBlocksComponent', () => {
  let component: HotelBlocksComponent;
  let fixture: ComponentFixture<HotelBlocksComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [HotelBlocksComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(HotelBlocksComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
