import { Routes } from '@angular/router'
import { AuthGuardService } from './services/auth-guard/auth-guard.service';
import { GuestGuardService } from './services/guest-guard/guest-guard.service';

export const routes: Routes = [
  {
    path: '',
    loadComponent:() => 
      import('./components/layout/home-layout/home-layout.component').then(
        (component) => component.HomeLayoutComponent
    ),
    canActivate: [AuthGuardService],
    children: [
      {
        path: 'home',
        loadComponent: () =>
          import('./components/home/home.component').then(
            (component) => component.HomeComponent
          ),
      },
      {
        path: 'scanner',
        loadComponent: () =>
          import('./components/scanner/scanner.component').then(
            (component) => component.ScannerComponent
          ),
      },
      {
        path: 'restock',
        loadComponent: () =>
          import('./components/notification/notification.component').then(
            (component) => component.NotificationComponent
          ),
      },
      {
        path: 'inventory',
        loadComponent: () =>
          import('./components/inventory/inventory.component').then(
            (component) => component.InventoryComponent
          ),
      },
      {
        path: 'profile',
        loadComponent: () =>
          import('./components/profile/profile.component').then(
            (component) => component.ProfileComponent
          ),
      },    
    ]
  },
  {
    path: '',
    loadComponent: () =>
      import('./components/layout/login-layout/login-layout.component').then(
        (component) => component.LoginLayoutComponent
      ),
      canActivate: [GuestGuardService],
      children: [
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
        },
        {
          path: 'forgot-password',
          loadComponent: () =>
            import('./components/reset-request/reset-request.component').then(
              (component) => component.ResetRequestComponent
            ),
        },
        {
          path: 'reset-password/:token',
          loadComponent: () =>
            import('./components/password-reset/password-reset.component').then(
              (component) => component.PasswordResetComponent
            ),
        },
      ]
  },
  {
    path: '**',
    loadComponent: () =>
      import('./components/error/error.component').then(
        (component) => component.ErrorComponent
      )
  },
];
