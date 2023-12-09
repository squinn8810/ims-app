import { Component, OnInit, } from '@angular/core'
import { Router } from '@angular/router';
import { LoginService } from 'src/app/services/login/login.service';
import { ChartComponent } from '../charts/charts.component';

@Component({
  standalone: true,
  selector: 'app-home',
  templateUrl: './home.component.html', 
  styleUrls: ['./home.component.scss'],
  imports: [ChartComponent],
})
export class HomeComponent implements OnInit {
  data: any;


  public accessToken: any;
  public accessTokenDetails: any;

  constructor(
    private loginService: LoginService,
    private router: Router,
  ) { }

  public ngOnInit(): void {
    // Call getUserInfo
  }

  logout(): void {
    this.loginService.logout()
      .subscribe(() => {
        localStorage.removeItem('access_token');
        this.router.navigate(['/login']);
      });
  }




}
