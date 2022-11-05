import { Component } from '@angular/core';
import { LoaderService } from './loader.service';
import { animate, style, transition, trigger } from '@angular/animations';

@Component({
  selector: 'app-loader',
  templateUrl: './loader.component.html',
  styleUrls: ['./loader.component.scss'],
  animations: [
    trigger('animation', [
      transition(':enter', [
        style({ opacity: 0 }),
        animate('.25s', style({ opacity: 1 })),
      ]),
      transition(':leave', [
        style({ opacity: 1 }),
        animate('.25s', style({ opacity: 0 })),
      ]),
    ]),
  ],
})
export class LoaderComponent {
  constructor(private loaderService: LoaderService) {}

  get isActive(): boolean {
    return this.loaderService.isActive;
  }
}
