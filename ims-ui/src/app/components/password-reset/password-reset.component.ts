import { NgIf } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { GeneralError } from 'src/app/models/errors/general-error/general-error';
import { PasswordReset } from 'src/app/models/password-reset/password-reset';
import { PasswordResetResponse } from 'src/app/responses/password-reset-response/password-reset-response';
import { PasswordResetService } from 'src/app/services/password-reset/password-reset.service';

@Component({
  standalone: true,
  selector: 'app-password-reset',
  templateUrl: './password-reset.component.html',
  styleUrls: ['./password-reset.component.scss'],
  imports: [ReactiveFormsModule, NgbModule, NgIf]
})
export class PasswordResetComponent implements OnInit {
  public error: GeneralError;
  public resetForm: FormGroup;

  constructor(
    private route: ActivatedRoute,
    private router: Router,
    private resetService: PasswordResetService,
    private formBuilder: FormBuilder
  ) {}

  public ngOnInit(): void {
    console.log('token: ' + this.route.snapshot.paramMap.get('token'));
    this.resetForm = this.formBuilder.group({
      token: new FormControl(this.route.snapshot.paramMap.get('token'), [Validators.required]),
      email: new FormControl('', [Validators.email, Validators.required, Validators.maxLength(255)]),
      password: new FormControl('', [Validators.required]),
      password_confirmation: new FormControl('', [])
    },
    {
      validator: this.confirmPasswordValidator('password', 'password_confirmation')
    });
  }

  public onSubmit({value, valid}: {value: PasswordReset, valid: boolean}): void{
    if (valid) {
      this.resetService.resetPassword(value)
        .subscribe(
          (resetResponse: PasswordResetResponse) => {
            this.router.navigate(['login']);
          },
          (errorResponse: GeneralError) => {
            this.error = errorResponse;
          }
        );
    }
  }

  public cancel() {
    this.router.navigate(['login']);
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
}
