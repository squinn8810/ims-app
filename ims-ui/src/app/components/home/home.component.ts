import { Component, OnInit, } from '@angular/core'
import { Router } from '@angular/router';
import { LoginService } from 'src/app/services/login/login.service';
import { ChartComponent } from '../charts/charts.component';
import { TransactionComponent } from '../transactions/transactions.component';

@Component({
  standalone: true,
  selector: 'app-home',
  templateUrl: './home.component.html', 
  styleUrls: ['./home.component.scss'],
  imports: [TransactionComponent],
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

  }

  logout(): void {
    this.loginService.logout()
      .subscribe(() => {
        localStorage.removeItem('access_token');
        this.router.navigate(['/login']);
      });
  }




}
