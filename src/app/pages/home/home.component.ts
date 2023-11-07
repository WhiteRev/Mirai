import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';


export interface RaceModel {
  name: string;
}

@Component({
  selector: 'ns-home',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss']
})

export class HomeComponent {

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
