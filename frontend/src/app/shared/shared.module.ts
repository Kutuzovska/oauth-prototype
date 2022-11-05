import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { IconComponent } from './icon/icon.component';
import { LoaderComponent } from './loader/loader.component';
import { LoaderService } from './loader/loader.service';

@NgModule({
  declarations: [IconComponent, LoaderComponent],
  exports: [IconComponent, LoaderComponent],
  providers: [LoaderService],
  imports: [CommonModule],
})
export class SharedModule {}
