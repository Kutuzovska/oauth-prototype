import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { TranslateService } from './services/translate.service';
import { AuthService } from './services/auth.service';

@NgModule({
  declarations: [],
  providers: [TranslateService, AuthService],
  imports: [CommonModule],
})
export class CoreModule {}
