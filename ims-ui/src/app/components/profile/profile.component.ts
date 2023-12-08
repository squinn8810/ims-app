import { NgIf } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { GeneralError } from 'src/app/models/errors/general-error/general-error';
import { User } from 'src/app/models/user/user';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { MdbModalRef, MdbModalService, MdbModalModule } from 'mdb-angular-ui-kit/modal';
import { ProfileDeleteComponent } from '../modals/profile-delete/profile-delete.component';


@Component({
  standalone: true,
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.scss'],
  imports: [ NgIf, NgbModule, MdbModalModule ]
})
export class ProfileComponent implements OnInit {
  public user: User;
  public error: GeneralError;
  public profileDeleteModalRef: MdbModalRef<ProfileDeleteComponent> | null = null;

  constructor(
    private route: ActivatedRoute,
    private router: Router,
    private modalService: MdbModalService,
  ) {}

  public  ngOnInit(): void {

    this.route.data.subscribe(
      ({currentUser}) => {
        this.user = currentUser;
      });
  }

  public editProfile(): void {
    this.router.navigate(['update-profile']);
  }

  public openAccountDeleteModal(): void {
    this.profileDeleteModalRef = this.modalService.open(ProfileDeleteComponent);
  }
}
