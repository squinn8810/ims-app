import { NgIf } from '@angular/common';
import { HttpClient, HttpClientXsrfModule, HttpHeaders } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { AbstractControl, FormBuilder, FormControl, FormGroup, ReactiveFormsModule, ValidationErrors, ValidatorFn, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { GeneralError } from 'src/app/models/errors/general-error/general-error';
import { RegistrationRequest } from 'src/app/models/registration-request/registration-request';
import { LoginResponse } from 'src/app/responses/login-response';
import { LoginService } from 'src/app/services/login/login.service';

@Component({
  standalone: true,
  selector: 'app-registration',
  templateUrl: './registration.component.html',
  styleUrls: ['./registration.component.scss', '../../../main.scss'],
  imports: [ReactiveFormsModule, HttpClientXsrfModule, NgbModule, NgIf]
})
export class RegistrationComponent implements OnInit {
  public registrationForm: FormGroup;
  public error: GeneralError;

  constructor(
    private router: Router,
    private loginService: LoginService,
    private formBuilder: FormBuilder
  ) {}

  public ngOnInit(): void {
    this.registrationForm = this.formBuilder.group({
      firstName: new FormControl('', [Validators.required, Validators.maxLength(32)]),
      lastName: new FormControl('', [Validators.required, Validators.maxLength(32)]),
      id: new FormControl('', [Validators.required, Validators.maxLength(32)]),
      email: new FormControl('', [Validators.email, Validators.required, Validators.maxLength(255)]),
      password: new FormControl('', [Validators.required]),
      password_confirmation: new FormControl('', [])
    },
    
    {
      validator: this.confirmPasswordValidator('password', 'password_confirmation')
    });
  }

  public onSubmit({value, valid}: {value: RegistrationRequest, valid: boolean}): void {
    if (valid) {
      this.loginService.register(value)
        .subscribe(
          (loginResponse: LoginResponse) => {
            localStorage.setItem('auth-token', btoa(loginResponse.authentication));
            this.router.navigate(['home']);
          },
          (errorResponse: GeneralError) => {
            console.log(errorResponse);
            this.error = errorResponse;
            console.log(this.error);
          }
        );
    }
  }

  confirmPasswordValidator(controlName: string, confirmControlName: string) {
    return (formGroup: FormGroup) => {
      const control = formGroup.controls[controlName];
      const matchingControl = formGroup.controls[confirmControlName];
      if (
        matchingControl.errors &&
        !matchingControl.errors?.['confirmPassword']
      ) {
        return;
      }
      if (control.value !== matchingControl.value) {
        matchingControl.setErrors({ confirmPassword: true });
      } else {
        matchingControl.setErrors(null);
      }
    };
  }

  public cancel(): void {
    this.router.navigate(['login']);
  }

}