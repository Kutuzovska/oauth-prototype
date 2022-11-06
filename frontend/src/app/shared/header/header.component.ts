import { Component, OnInit } from '@angular/core';
import { AuthService } from '../../core/services/auth.service';
import { NotificationService } from '../../core/services/notification.service';
import { Router } from '@angular/router';
import { LoaderService } from '../loader/loader.service';
import { sleep } from 'radash';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss'],
})
export class HeaderComponent implements OnInit {
  title = 'Hello!';

  email = '';

  isGuest = true;

  constructor(
    private authService: AuthService,
    private notificationService: NotificationService,
    private loaderService: LoaderService,
    private router: Router,
  ) {}

  ngOnInit(): void {
    this.authService.user$.subscribe((user) => {
      this.email = user.email;
      this.isGuest = user.isGuest;
    });
  }

  async logout() {
    this.loaderService.start();
    await this.authService.logout();
    this.notificationService.success('Good buy!');
    await this.router.navigateByUrl('');
    await sleep(300);
    this.loaderService.stop();
  }
}
