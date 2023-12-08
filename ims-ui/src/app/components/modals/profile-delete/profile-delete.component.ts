import { Component, OnInit } from '@angular/core';
import { FormControl, Validators, FormGroup, ReactiveFormsModule, FormBuilder } from '@angular/forms';
import { Router } from '@angular/router';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { NgIf } from '@angular/common';
import { GeneralError } from 'src/app/models/errors/general-error/general-error';
import { UserService } from 'src/app/services/user/user.service';
import { ProfileDeleteRequest } from 'src/app/models/user/profile-delete-request/profile-delete-request';
import { MdbModalRef } from 'mdb-angular-ui-kit/modal';

@Component({
  standalone: true,
  selector: 'app-profile-delete',
  imports: [ NgIf, NgbModule, ReactiveFormsModule ],
  templateUrl: './profile-delete.component.html',
  styleUrls: ['./profile-delete.component.scss']
})
export class ProfileDeleteComponent implements OnInit {
  public deleteAccountForm: FormGroup;
  public error: GeneralError;
  public affirmationText: string;

  constructor(
    public profileDeleteModalRef: MdbModalRef<ProfileDeleteComponent>,
    private router: Router,
    private formBuilder: FormBuilder,
    private userService: UserService
  ) {}

  ngOnInit(): void {
    this.affirmationText = this.generateAffirmation(6);
    this.deleteAccountForm = this.formBuilder.group({
      affirmationText: new FormControl('', [Validators.email, Validators.required]),
      password: new FormControl('', [Validators.required]),
    },
    {
      validator: this.affirmText('affirmationText')
    });
  }

  public onSubmit({value, valid}: {value: ProfileDeleteRequest, valid: boolean}): void{
    if (valid) {
      this.userService.deleteAccount(value)
        .subscribe(
          (response: any) => {
            this.closeModal();
            localStorage.clear();
            this.router.navigate(['login']);
          },
          (errorResponse: GeneralError) => {
            this.error = errorResponse;
          }
        );
    }
  }

  public closeModal(): void {
    this.profileDeleteModalRef.close();
  }

  private generateAffirmation(length: number): string {
    let result = '';
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    const charactersLength = characters.length;
    let counter = 0;
    while (counter < length) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
      counter += 1;
    }
    return result;
  }

  private affirmText(controlName: string) {
    return (formGroup: FormGroup) => {
      const control = formGroup.controls[controlName];
      if (control.value !== this.affirmationText) {
        control.setErrors({ affirmationText: true });
      } else {
        control.setErrors(null);
      }
    };
  }
}
