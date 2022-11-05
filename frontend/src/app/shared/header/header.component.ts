import { Component, OnInit } from '@angular/core';
import { AuthService } from '../../core/services/auth.service';
import { NotificationService } from '../../core/services/notification.service';
import { Router } from '@angular/router';

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
    private router: Router,
  ) {}

  ngOnInit(): void {
    this.authService.user$.subscribe((user) => {
      this.email = user.email;
      this.isGuest = user.isGuest;
    });
  }

  async logout() {
    await this.authService.logout();
    this.notificationService.success('Good buy!');
    await this.router.navigateByUrl('');
  }
}
