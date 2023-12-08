import { Component } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { FormControl, Validators, FormGroup, ReactiveFormsModule, FormBuilder } from '@angular/forms';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { NgIf } from '@angular/common';
import { UpdateUser } from 'src/app/models/user/update-user';
import { GeneralError } from 'src/app/models/errors/general-error/general-error';
import { UserService } from 'src/app/services/user/user.service';
import { User } from 'src/app/models/user/user';


@Component({
  standalone: true,
  selector: 'app-update-user',
  templateUrl: './update-user.component.html',
  styleUrls: ['./update-user.component.scss'],
  imports: [ReactiveFormsModule, NgbModule, NgIf]
})
export class UpdateUserComponent {
  public updateUserForm: FormGroup;
  public error: GeneralError;
  public user: User;
  public userId: number;

  constructor(
    private router: Router,
    private route: ActivatedRoute,
    private formBuilder: FormBuilder,
    private userService: UserService
  ) {}

  ngOnInit(): void {
    this.updateUserForm = this.formBuilder.group({
      firstName: new FormControl('', [Validators.required, Validators.maxLength(32)]),
      lastName: new FormControl('', [Validators.required, Validators.maxLength(32)]),
      email: new FormControl('', [Validators.email, Validators.required, Validators.maxLength(32)]),
      is_admin: new FormControl(false)
    });
    this.userId = this.route.snapshot.params['userId'];
    this.userService.getUser(this.userId)
      .subscribe(
        (user: User) => {
          this.user = user;
          this.updateUserForm.controls['firstName'].setValue(user.first_name);
          this.updateUserForm.controls['lastName'].setValue(user.last_name);
          this.updateUserForm.controls['email'].setValue(user.email);
          this.updateUserForm.controls['is_admin'].setValue(user.isAdmin);
        },
        (errorResponse: GeneralError) => {
          this.error = errorResponse;
        }
      );
  }

  public onSubmit({value, valid}: {value: UpdateUser, valid: boolean}): void{
    if (valid) {
      this.userService.updateUser(value, this.userId)
        .subscribe(
          (response: any) => {
            this.router.navigate(['manage-users']);
          },
          (errorResponse: GeneralError) => {
            this.error = errorResponse;
          }
        );
    }
  }

  public cancelUpdate(): void {
    this.router.navigate(['manage-users']);
  }
}
