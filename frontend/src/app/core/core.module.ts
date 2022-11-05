import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { TranslateService } from './services/translate.service';
import { AuthService } from './services/auth.service';
import { NotificationService } from './services/notification.service';

@NgModule({
  declarations: [],
  providers: [TranslateService, AuthService, NotificationService],
  imports: [CommonModule],
})
export class CoreModule {}
