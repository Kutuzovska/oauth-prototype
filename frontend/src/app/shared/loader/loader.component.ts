import { Component, OnInit } from '@angular/core';
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
export class LoaderComponent implements OnInit {
  isActive = false;

  constructor(private loaderService: LoaderService) {}

  ngOnInit() {
    return this.loaderService.isActive$.subscribe((value) => {
      this.isActive = value;
    });
  }
}
