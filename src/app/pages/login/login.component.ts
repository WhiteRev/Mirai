import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { MatButtonModule } from '@angular/material/button';
import { ApiService } from 'src/app/services/api.service';
import { Subscription } from 'rxjs';
import { timeout } from 'rxjs/operators';
import { Router } from '@angular/router';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

@Component({
  selector: 'ns-login',
  standalone: true,
  imports: [CommonModule, MatButtonModule, FormsModule, ReactiveFormsModule],
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent {

  user: string = 'CORRE';
  sub?: Subscription;
  loading = false;

  userForm = this.fb.group({
    ident: ['', Validators.required],
    pass: ['', Validators.required],  });


  constructor(
    private apiService: ApiService,
    private router: Router,
    private fb: FormBuilder,
  ) { 



  }

  register() {
    this.loading = true;

    this.sub = this.apiService.postRegister(
      this.userForm.value.ident,
      this.userForm.value.pass).subscribe({
        next: (response: any) => {

          if (response?.success) {
            // GOOD 
            this.router.navigate(['/home']);

          } else {

            // ERREUR


          }

          this.loading = false;


        }, error: (msg: any) => {
          this.loading = false;

          console.error(`Error: ${msg.status} ${msg.statusText}`);
          console.error('Erreur de connexion');
        }
      });



  }
  login() {
    this.loading = true;

    this.sub = this.apiService.postLogin(
      this.userForm.value.ident,
      this.userForm.value.pass).subscribe({
        next: (response: any) => {

          if (response?.success) {
            // GOOD 
            this.router.navigate(['/home']);

          } else {

            // ERREUR


          }

          this.loading = false;


        }, error: (msg: any) => {
          this.loading = false;

          console.error(`Error: ${msg.status} ${msg.statusText}`);
          console.error('Erreur de connexion');
        }
      });



  }

}
