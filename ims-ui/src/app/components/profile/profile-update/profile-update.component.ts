import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { GeneralError } from 'src/app/models/errors/general-error/general-error';
import { UserService } from 'src/app/services/user/user.service';
import { FormControl, Validators, FormGroup, ReactiveFormsModule, FormBuilder } from '@angular/forms';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { ProfileUpdateRequest } from 'src/app/models/user/profile-update-request/profile-update-request';
import { NgIf } from '@angular/common';

@Component({
  standalone: true,
  selector: 'app-profile-update',
  templateUrl: './profile-update.component.html',
  styleUrls: ['./profile-update.component.scss'],
  imports: [ ReactiveFormsModule, NgbModule, NgIf]
})
export class ProfileUpdateComponent implements OnInit{
  public error: GeneralError;
  public profileForm: FormGroup;

  constructor(
    private route: ActivatedRoute,
    private router: Router,
    private userService: UserService,
    private formBuilder: FormBuilder,
  ) {}

  public ngOnInit(): void {
    this.profileForm = this.formBuilder.group({
      firstName: new FormControl('', [Validators.required, Validators.maxLength(32)]),
      lastName: new FormControl('', [Validators.required, Validators.maxLength(32)]),
      //id: new FormControl('', [Validators.required, Validators.pattern(new RegExp('[0-9]+')), Validators.maxLength(32)]),
      email: new FormControl('', [Validators.email, Validators.required, Validators.maxLength(32)]),
    });

    this.route.data.subscribe(
      ({currentUser}) => {
        this.profileForm.controls['firstName'].setValue(currentUser.first_name);
        this.profileForm.controls['lastName'].setValue(currentUser.last_name);
        //this.profileForm.controls['id'].setValue(currentUser.employee_id);
        this.profileForm.controls['email'].setValue(currentUser.email);
      });
  }

  public cancelUpdate(): void {
    this.router.navigate(['profile']);
  }

  public onSubmit({value, valid}: {value: ProfileUpdateRequest, valid: boolean}): void {
    if (valid) {
      this.userService.updateProfile(value)
        .subscribe(
          (response: any) => {
            this.router.navigate(['profile']);
          },
          (errorResponse: GeneralError) => {
            this.error = errorResponse;
          }
        );
    }
  }
}
