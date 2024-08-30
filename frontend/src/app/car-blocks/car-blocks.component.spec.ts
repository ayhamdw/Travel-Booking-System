import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CarBlocksComponent } from './car-blocks.component';

describe('CarBlocksComponent', () => {
  let component: CarBlocksComponent;
  let fixture: ComponentFixture<CarBlocksComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [CarBlocksComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(CarBlocksComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
