import { Injectable } from '@angular/core';
import User from '../models/user.model';
import { sleep } from 'radash';
import { BehaviorSubject } from 'rxjs';

@Injectable()
export class AuthService {
  private _user: User = new User();

  public isGuest = true;

  public user$ = new BehaviorSubject<User>(this._user);

  public async login(email: string, password: string): Promise<void> {
    await sleep(1000);

    this._user.email = email;
    this._user.password = password;
    this._user.confirm();

    this.isGuest = false;
    this.user$.next(this._user);
    await sleep(1000);
  }

  public async logout(): Promise<void> {
    this._user.clean();
    this.isGuest = true;
    this.user$.next(this._user);
  }
}
