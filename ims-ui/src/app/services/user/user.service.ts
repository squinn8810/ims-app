import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { ProfileDeleteRequest } from 'src/app/models/user/profile-delete-request/profile-delete-request';
import { ProfileUpdateRequest } from 'src/app/models/user/profile-update-request/profile-update-request';
import { UpdateUser } from 'src/app/models/user/update-user';
import { User } from 'src/app/models/user/user';


@Injectable({
  providedIn: 'root'
})
export class UserService {
  public options: any;

  constructor(
    private http: HttpClient
  ) {
    this.options = {
      headers: new HttpHeaders({
        Accept: 'application/json',
        'Content-Type': 'application/json',
      })
    };
  }

  public getLoggedInUser(): Observable<any> {
    return this.http.get('/api/profile', this.options);
  }

  public getAllUsers(): Observable<any> {
    return this.http.get('/api/users', this.options);
  }

  public getUser(userId: number): Observable<any> {
    return this.http.get('/api/users/user/' + userId, this.options);
  }

  public updateUser(updateUserRequest: UpdateUser, userId: number): Observable<any> {
    return this.http.patch('/api/users/user/' + userId, updateUserRequest, this.options);
  }

  public updateProfile(ProfileUpdateRequest: ProfileUpdateRequest): Observable<any> {
    return this.http.patch('/api/profile', ProfileUpdateRequest, this.options);
  }

  public deleteUser(userId: number): Observable<any> {
    return this.http.delete('/api/users/user/' + userId, this.options);
  }

  public deleteAccount(profileDeleteRequest: ProfileDeleteRequest): Observable<any> {
    this.options.body = profileDeleteRequest;
    return this.http.delete('/api/profile', this.options);
  }
}
