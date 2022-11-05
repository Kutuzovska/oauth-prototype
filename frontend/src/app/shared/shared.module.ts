import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { IconComponent } from './icon/icon.component';
import { LoaderComponent } from './loader/loader.component';
import { LoaderService } from './loader/loader.service';
import { HeaderComponent } from './header/header.component';
import { AppRoutingModule } from '../app-routing.module';
import { TranslocoRootModule } from '../transloco-root.module';

@NgModule({
  declarations: [IconComponent, LoaderComponent, HeaderComponent],
  exports: [IconComponent, LoaderComponent, HeaderComponent],
  providers: [LoaderService],
  imports: [CommonModule, AppRoutingModule, TranslocoRootModule],
})
export class SharedModule {}
