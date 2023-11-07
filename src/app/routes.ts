import { Route } from '@angular/router';
import { LoginComponent } from './pages/login/login.component';
import { HomeComponent } from './pages/home/home.component';

export const routes: Route[] = [

  { path: 'login', component: LoginComponent},
  { path: 'home', component: HomeComponent},
  { path: '',
    redirectTo: 'login',
    pathMatch: 'full'
  }
];

