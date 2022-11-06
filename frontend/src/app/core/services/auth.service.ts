import { Injectable } from '@angular/core';
import User from '../models/user.model';
import { sleep } from 'radash';
import { BehaviorSubject } from 'rxjs';

@Injectable()
export class AuthService {
  public user: User = new User();

  public user$ = new BehaviorSubject<User>(this.user);

  public init() {
    this.user.confirm();
  }

  public async login(email: string, password: string): Promise<void> {
    await sleep(1000);

    this.user.email = email;
    this.user.password = password;
    this.user.confirm();

    this.user$.next(this.user);
    await sleep(1000);
  }

  public async logout(): Promise<void> {
    this.user.clean();
    this.user$.next(this.user);
  }
}
