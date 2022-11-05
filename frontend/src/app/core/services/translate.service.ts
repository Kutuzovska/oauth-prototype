import { Injectable } from '@angular/core';
import { TranslocoService } from '@ngneat/transloco';

export enum Lang {
  EN = 'en',
  RU = 'ru',
}

@Injectable()
export class TranslateService {
  constructor(private translocoService: TranslocoService) {}

  init() {
    const lang = (localStorage.getItem('lang') ?? 'ru') as Lang;
    this.change(lang);
  }

  get active(): string {
    return this.translocoService.getActiveLang();
  }

  change(lang: Lang) {
    this.translocoService.setActiveLang(lang);
    localStorage.setItem('lang', lang);
  }
}
