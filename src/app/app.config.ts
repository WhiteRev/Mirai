import { ApplicationConfig } from '@angular/core';
import { importProvidersFrom } from '@angular/core';

import { RouterModule } from '@angular/router';
import {routes} from './routes';
import { provideAnimations } from '@angular/platform-browser/animations';
import { HttpClientModule } from '@angular/common/http';

import { FormsModule, ReactiveFormsModule } from '@angular/forms';

export const appConfig: ApplicationConfig = {

  providers: [
    importProvidersFrom(FormsModule,ReactiveFormsModule,HttpClientModule), 
    importProvidersFrom(RouterModule.forRoot(routes)), 
    provideAnimations()]
};