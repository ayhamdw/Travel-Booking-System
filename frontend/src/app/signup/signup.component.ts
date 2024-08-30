import { CommonModule } from '@angular/common';
import { Component, OnInit, ChangeDetectorRef } from '@angular/core';
import { FormBuilder, FormGroup, Validators, ReactiveFormsModule } from '@angular/forms';
import { SignupService } from './signup.service';
import { HttpClientModule } from '@angular/common/http';
import { Router } from '@angular/router';  // Import Router

@Component({
  standalone: true,
  selector: 'app-signup',
  templateUrl: './signup.component.html',
  styleUrls: ['./signup.component.css'],
  imports: [ReactiveFormsModule, CommonModule, HttpClientModule],
})
export class SignupComponent implements OnInit {

  signupForm!: FormGroup;
  isSubmitted = false;
  serverErrors: any = {};

  constructor(
    private formBuilder: FormBuilder, 
    private signupService: SignupService, 
    private cdr: ChangeDetectorRef,
    private router: Router  // Inject Router
  ) {}

  ngOnInit(): void {
    this.signupForm = this.formBuilder.group({
      username: ['', Validators.required],
      email: ['', [Validators.required, Validators.email]],
      first_name: ['', Validators.required],
      last_name: ['', Validators.required],
      password: ['', [Validators.required, Validators.minLength(8)]],
      confirmPassword: ['', Validators.required],
      terms: [false, Validators.requiredTrue]
    }, { 
      validators: this.passwordMatchValidator
    });

    this.signupForm.get('username')?.valueChanges.subscribe(() => this.clearServerError('username'));
    this.signupForm.get('email')?.valueChanges.subscribe(() => this.clearServerError('email'));
  }

  passwordMatchValidator(group: FormGroup): { [key: string]: boolean } | null {
    const password = group.get('password')?.value;
    const confirmPassword = group.get('confirmPassword')?.value;

    return password === confirmPassword ? null : { passwordMismatch: true };
  }

  clearServerError(field: string): void {
    if (this.serverErrors[field]) {
      delete this.serverErrors[field];
    }
  }

  onSubmit(): void {
    this.isSubmitted = true;

    if (this.signupForm.valid) {
      const formData = {
        ...this.signupForm.value,
        role: 0  // Add role field with value 0
      };

      this.signupService.signup(formData).subscribe(
        response => {
          console.log('Signup successful!', response);
          // Redirect to home page on success
          this.router.navigate(['/home']);  // Navigate to the home page (root)
        },
        error => {
          if (error.status === 422 && error.error.errors) {
            this.serverErrors = error.error.errors;
            console.log(this.serverErrors);
            // Trigger change detection
            this.cdr.detectChanges();
          } else {
            console.error('Signup failed', error);
          }
        }
      );
    } else {
      console.log('Form is invalid');
    }
  }
}
