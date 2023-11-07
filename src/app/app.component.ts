import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { provideRouter, RouterOutlet } from '@angular/router';
import { bootstrapApplication } from '@angular/platform-browser';
import { routes } from './routes';
import { HomeComponent } from './pages/home/home.component';
@Component({
  selector: 'ns-root',
  standalone: true,
  imports: [CommonModule, RouterOutlet,  HomeComponent],
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
}
