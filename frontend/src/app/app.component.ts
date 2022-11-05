import { Component, ElementRef, HostListener, ViewChild } from '@angular/core';
import { Lang, TranslateService } from './core/services/translate.service';
import { AuthService } from './core/services/auth.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss'],
})
export class AppComponent {
  title = 'Hello!';

  email = 'email@example.com';

  isActiveLanguageChanger = false;

  languages = [
    {
      label: 'English',
      value: Lang.EN,
    },
    {
      label: 'Русский',
      value: Lang.RU,
    },
  ];

  constructor(
    private translateService: TranslateService,
    private authService: AuthService,
  ) {}

  get isGuest(): boolean {
    return this.authService.IsGuest;
  }

  get notActiveLanguageLabel(): string {
    const language = this.languages.find(
      (item) => item.value !== this.translateService.active,
    );
    if (language) return language.label;
    return '';
  }

  get activeLanguage() {
    return (
      this.languages.find(
        (item) => item.value === this.translateService.active,
      ) ?? null
    );
  }

  changeLanguage(lang: Lang) {
    this.translateService.change(lang);
    this.isActiveLanguageChanger = false;
  }

  @ViewChild('language') language: ElementRef | undefined;

  @HostListener('document:mousedown', ['$event'])
  onGlobalClick(event: Event): void {
    const target = event.target as HTMLElement;
    if (this.language && !this.language.nativeElement.contains(target)) {
      this.isActiveLanguageChanger = false;
    }
  }
}
