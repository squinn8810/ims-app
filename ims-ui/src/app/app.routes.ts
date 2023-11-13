import { Component } from '@angular/core';
import { Routes } from '@angular/router'
import { AuthGuardService } from './services/auth-guard/auth-guard.service';
import { GuestGuardService } from './services/guest-guard/guest-guard.service';

export const routes: Routes = [
  {
    path: 'register-user',
    loadComponent: () =>
      import('./components/registration/registration.component').then(
        (component) => component.RegistrationComponent
      ),
      canActivate: [GuestGuardService]
  },
  {
    path: 'login',
    loadComponent: () =>
      import('./components/login/login.component').then(
        (component) => component.LoginComponent
      ),
      canActivate: [GuestGuardService]
  },
  {
    path: 'forgot-password',
    loadComponent: () =>
      import('./components/reset-request/reset-request.component').then(
        (component) => component.ResetRequestComponent
      ),
      canActivate: [GuestGuardService]
  },
  {
    path: 'reset-password/:token',
    loadComponent: () =>
      import('./components/password-reset/password-reset.component').then(
        (component) => component.PasswordResetComponent
      ),
      canActivate: [GuestGuardService]
  },
  {
    path: 'home',
    loadComponent: () =>
      import('./components/home/home.component').then(
        (component) => component.HomeComponent
      ),
      canActivate: [AuthGuardService]
  },
  {
    path: 'scanner',
    loadComponent: () =>
      import('./components/scanner/scanner.component').then(
        (component) => component.ScannerComponent
      ),
      canActivate: [AuthGuardService]
  },
  {
    path: 'profile',
    loadComponent: () =>
      import('./components/profile/profile.component').then(
        (component) => component.ProfileComponent
      ),
      canActivate: [AuthGuardService]
  },
  {
    path: '**',
    loadComponent: () =>
      import('./components/error/error.component').then(
        (component) => component.ErrorComponent
      )
  },
];
