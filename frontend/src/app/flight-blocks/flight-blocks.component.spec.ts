import { ComponentFixture, TestBed } from '@angular/core/testing';

import { FlightBlocksComponent } from './flight-blocks.component';

describe('FlightBlocksComponent', () => {
  let component: FlightBlocksComponent;
  let fixture: ComponentFixture<FlightBlocksComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [FlightBlocksComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(FlightBlocksComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
