import { Component } from '@angular/core';
import { Lang, TranslateService } from './core/services/translate.service';
import { AuthService } from './core/services/auth.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss'],
})
export class AppComponent {
  title = 'Hello!';

  private readonly languages = {
    [Lang.EN]: 'English',
    [Lang.RU]: 'Русский',
  };

  constructor(
    private translateService: TranslateService,
    private authService: AuthService,
  ) {}

  get isGuest(): boolean {
    return this.authService.IsGuest;
  }

  get email(): string {
    return this.authService.user.email;
  }

  private get notActiveLanguage(): Lang {
    return this.translateService.active === Lang.RU ? Lang.EN : Lang.RU;
  }

  get notActiveLanguageLabel(): string {
    return this.languages[this.notActiveLanguage];
  }

  changeLanguage() {
    this.translateService.change(this.notActiveLanguage);
  }
}
