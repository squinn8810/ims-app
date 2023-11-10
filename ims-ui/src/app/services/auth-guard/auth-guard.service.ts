import { Injectable } from '@angular/core';
import { Router, ActivatedRouteSnapshot, RouterStateSnapshot } from '@angular/router';

@Injectable({
  providedIn: 'root'
})
export class AuthGuardService {

  constructor(
    private router: Router
  ) { }

  canActivate(
    next: ActivatedRouteSnapshot,
    state: RouterStateSnapshot
  ) {
    if (
      localStorage.getItem('auth-token')
    ) { return true; }
    localStorage.removeItem('auth-token');
    this.router.navigateByUrl('/login');
    return false;
  }
}
