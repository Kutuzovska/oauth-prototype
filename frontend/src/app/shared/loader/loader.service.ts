import { Injectable } from '@angular/core';

@Injectable()
export class LoaderService {
  private _isActive = false;

  public start(): void {
    this._isActive = true;
  }

  public stop(): void {
    this._isActive = false;
  }

  get isActive(): boolean {
    return this._isActive;
  }
}
