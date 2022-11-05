import { Component } from '@angular/core';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss'],
})
export class LoginComponent {
  email = '';

  password = '';

  // login(event: Event, loginForm: NgForm) {
  //   event.preventDefault();
  //   console.log(this.email);
  //   console.log(this.password);
  //   console.log(loginForm);
  // }

  submit() {
    console.log('submit');
  }
}
