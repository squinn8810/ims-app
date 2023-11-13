import { Component, OnInit } from '@angular/core';
import { LoginRequest } from 'src/app/models/login-request/login-request';
import { FormControl, Validators, FormGroup, ReactiveFormsModule, FormBuilder } from '@angular/forms';
import { Router } from '@angular/router';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { NgIf } from '@angular/common';
import { LoginResponse } from 'src/app/responses/login-response';
import { LoginService } from 'src/app/services/login/login.service';
import { GeneralError } from 'src/app/models/errors/general-error/general-error';


@Component({
  standalone: true,
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss', '../../../main.scss'],
  imports: [ReactiveFormsModule, NgbModule, NgIf]
})
export class LoginComponent implements OnInit {
  public loginForm: FormGroup;
  public loginResponse: LoginResponse;
  public error: GeneralError;

  constructor(
    private router: Router,
    private formBuilder: FormBuilder,
    private loginService: LoginService
  ) {}

  ngOnInit(): void {
    this.loginForm = this.formBuilder.group({
      email: new FormControl('', [Validators.email, Validators.required]),
      password: new FormControl('', [Validators.required]),
      remember: new FormControl(false)
    });
  }

  public onSubmit({value, valid}: {value: LoginRequest, valid: boolean}): void{
    if (valid) {
      this.loginService.login(value)
        .subscribe(
          (loginResponse: LoginResponse) => {
            localStorage.setItem('auth-token', btoa(loginResponse.authentication));
            this.router.navigate(['home']);
          },
          (errorResponse: GeneralError) => {
            this.error = errorResponse;
          }
        );
    }
  }
}