import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';

export interface RaceModel {
  name: string;
}
@Component({
  selector: 'ns-hero-detail',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './hero-detail.component.html',
  styleUrls: ['./hero-detail.component.scss']
})
export class HeroDetailComponent {
  user = { name: 'Cédric' };
  races: Array<RaceModel> = [];
  tour = 0;
  refreshRaces(): void {
  this.tour= this.tour + 1;
  if (this.tour == this.races.length +1) {
    this.tour = 0
  }
  this.races = [{ name: 'London' }, { name: 'Lyon' }, { name: 'Paris' }, { name: 'Marseille' }, { name: 'Berlin' }];
  }
}
