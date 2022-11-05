import { Injectable } from '@angular/core';

@Injectable()
export class AuthService {
  public get IsGuest(): boolean {
    return true;
  }
}
