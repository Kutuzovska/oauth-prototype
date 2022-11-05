import { Component, OnInit } from '@angular/core';
import { Lang, TranslateService } from './core/services/translate.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss'],
})
export class AppComponent implements OnInit {
  private readonly languages = {
    [Lang.EN]: 'English',
    [Lang.RU]: 'Русский',
  };

  public notActiveLanguage: Lang = Lang.RU;

  public notActiveLanguageLabel = '';

  constructor(private translateService: TranslateService) {}

  ngOnInit(): void {
    this.translateService.active$.subscribe((value) => {
      this.notActiveLanguage = value === Lang.RU ? Lang.EN : Lang.RU;
      this.notActiveLanguageLabel = this.languages[this.notActiveLanguage];
    });
  }

  changeLanguage() {
    this.translateService.change(this.notActiveLanguage);
  }
}
