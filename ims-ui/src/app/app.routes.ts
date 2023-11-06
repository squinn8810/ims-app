import { Component } from '@angular/core';
import { Routes } from '@angular/router'
import { AuthGuardService } from './services/auth-guard/auth-guard.service';
import { GuestGuardService } from './services/guest-guard/guest-guard.service';

export const routes: Routes = [
  {
    path: '',
    loadComponent: () =>
      import('./components/home/home.component').then(
        (Component) => Component.HomeComponent,
      ),
      canActivate: [AuthGuardService]
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
    path: 'layout',
    loadComponent: () =>
      import('./components/layout/layout.component').then(
        (component) => component.LayoutComponent
      ),
  }
];
