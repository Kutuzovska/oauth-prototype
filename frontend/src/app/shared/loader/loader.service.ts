import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';

@Injectable()
export class LoaderService {
  public isActive$ = new BehaviorSubject(false);

  public start(): void {
    this.isActive$.next(true);
  }

  public stop(): void {
    this.isActive$.next(false);
  }
}
