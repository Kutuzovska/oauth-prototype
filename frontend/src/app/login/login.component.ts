import { Component } from '@angular/core';
import { AuthService } from '../core/services/auth.service';
import { NgForm } from '@angular/forms';
import { NotificationService } from '../core/services/notification.service';
import { LoaderService } from '../shared/loader/loader.service';

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
  ) {}

  get user() {
    return this.authService.user;
  }

  async submit(form: NgForm) {
    if (form.invalid) return;

    try {
      this.loaderService.start();
      await this.authService.login();
      this.notificationService.success('Good!');
    } catch (e) {
      this.notificationService.error('Bad!');
    } finally {
      this.loaderService.stop();
    }
  }
}
