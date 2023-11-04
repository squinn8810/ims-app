import { Component } from '@angular/core';
import { LoginRequest } from 'src/app/models/login-request';
import { FormsModule } from '@angular/forms';
import { MatInputModule } from '@angular/material/input';
import { MatFormFieldModule } from '@angular/material/form-field';


@Component({
  standalone: true,
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss'],
  imports: [FormsModule, MatFormFieldModule, MatInputModule]
})
export class LoginComponent {
  public loginRequest: LoginRequest = new LoginRequest('','');
  public submitted: boolean = false;

  onSubmit() {
    ; 
  console.log(this.loginRequest)}
}
