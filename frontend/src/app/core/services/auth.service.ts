import { Injectable } from '@angular/core';
import User from '../models/user.model';
import { sleep } from 'radash';

@Injectable()
export class AuthService {
  private _user = new User();

  public get IsGuest(): boolean {
    return this.user.isGuest;
  }

  public get user(): User {
    return this._user;
  }

  public async login(): Promise<void> {
    await sleep(2000);
  }

  public logout(): void {}
}
