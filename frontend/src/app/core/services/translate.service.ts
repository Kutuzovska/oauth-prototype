import { Injectable } from '@angular/core';
import { TranslocoService } from '@ngneat/transloco';
import { BehaviorSubject } from 'rxjs';

export enum Lang {
  EN = 'en',
  RU = 'ru',
}

@Injectable()
export class TranslateService {
  public active$ = new BehaviorSubject(Lang.RU);

  constructor(private translocoService: TranslocoService) {}

  init() {
    const lang = (localStorage.getItem('lang') ?? 'ru') as Lang;
    this.change(lang);
  }

  change(lang: Lang) {
    this.translocoService.setActiveLang(lang);
    localStorage.setItem('lang', lang);
    this.active$.next(lang);
  }
}
