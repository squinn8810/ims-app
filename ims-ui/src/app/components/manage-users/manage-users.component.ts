import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { NgIf, NgFor } from '@angular/common';
import { GeneralError } from 'src/app/models/errors/general-error/general-error';
import { UserService } from 'src/app/services/user/user.service';
import { User } from 'src/app/models/user/user';

@Component({
  standalone: true,
  selector: 'app-manage-users',
  templateUrl: './manage-users.component.html',
  styleUrls: ['./manage-users.component.scss'],
  imports: [NgbModule, NgIf, NgFor]
})
export class ManageUsersComponent {
  public users: User[];
  public error: GeneralError;

  constructor(
    private router: Router,
    private userService: UserService
  ) {}

  ngOnInit(): void {
    this.userService.getAllUsers()
      .subscribe(
        (users: User[]) => {
          this.users = users;
        },
        (errorResponse: GeneralError) => {
          this.error = errorResponse;
        }
      );
  }

  public updateUser(userId: number): void {
    this.router.navigate(['update-user/' + userId]);
  }

  public deleteUser(userId: number): void {
    this.userService.deleteUser(userId)
      .subscribe(
        (response: any) => {
          this.ngOnInit();
        },
        (errorResponse: GeneralError) => {
          this.error = errorResponse;
        }
      );
  }

}
