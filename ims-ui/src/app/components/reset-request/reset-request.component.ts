import { NgIf } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { GeneralError } from 'src/app/models/errors/general-error/general-error';
import { ResetRequest } from 'src/app/models/reset-request/reset-request';
import { ResetRequestResponse } from 'src/app/responses/reset-request-response/reset-request-response';
import { PasswordResetService } from 'src/app/services/password-reset/password-reset.service';

@Component({
  standalone: true,
  selector: 'app-reset-request',
  templateUrl: './reset-request.component.html',
  styleUrls: ['./reset-request.component.scss'],
  imports: [ReactiveFormsModule, NgbModule, NgIf]
})
export class ResetRequestComponent implements OnInit {
  public resetRequestForm: FormGroup;
  public error: GeneralError;
  

  constructor(
    private router: Router,
    private formBuilder: FormBuilder,
    private resetService: PasswordResetService
  ) {}

  ngOnInit(): void {
    this.resetRequestForm = this.formBuilder.group({
      email: new FormControl('', [Validators.email, Validators.required])
    });
  }

  public onSubmit({value, valid}: {value: ResetRequest, valid: boolean}): void{
    if (valid) {
      this.resetService.sendResetRequest(value)
        .subscribe(
          (loginResponse: ResetRequestResponse) => {
            this.router.navigate(['login']);
          },
          (errorResponse: GeneralError) => {
            this.error = errorResponse;
          }
        );
    }
  }

  public cancel(): void {
    this.router.navigate(['login']);
  }
}
