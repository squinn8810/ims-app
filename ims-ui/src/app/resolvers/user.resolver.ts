import { inject } from '@angular/core';
import { ResolveFn } from '@angular/router';
import { User } from '../models/user/user';
import { UserService } from '../services/user/user.service';
import { take, map } from 'rxjs';

export const userResolver: ResolveFn<User> = (route, state) => {
    return inject(UserService).getLoggedInUser()
  .pipe(take(1), map((currentUser: User) => {
    return currentUser;
  }));
};
