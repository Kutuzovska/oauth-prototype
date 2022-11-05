import { Component } from '@angular/core';
import { AuthService } from '../core/services/auth.service';
import { NgForm } from '@angular/forms';
import { NotificationService } from '../core/services/notification.service';
import { LoaderService } from '../shared/loader/loader.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss'],
})
export class LoginComponent {
  constructor(
    private authService: AuthService,
    private notificationService: NotificationService,
    private loaderService: LoaderService,
    private router: Router,
  ) {}

  user = {
    email: '',
    password: '',
  };

  async submit(form: NgForm) {
    if (form.invalid) return;

    try {
      this.loaderService.start();
      await this.authService.login(this.user.email, this.user.password);
      this.notificationService.success('Good!');
      await this.router.navigateByUrl('settings');
    } catch (e) {
      this.notificationService.error('Bad!');
    } finally {
      this.loaderService.stop();
    }
  }
}
