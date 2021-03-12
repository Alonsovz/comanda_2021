import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { ReporteGastosRoutingModule } from './reporte-gastos-routing.module';
import { ReporteGastosComponent } from './reporte-gastos.component';
import { ThemeModule } from '../../@theme/theme.module';
import { NbInputModule, NbCardModule, NbButtonModule, NbActionsModule, NbUserModule, NbCheckboxModule, NbRadioModule, NbDatepickerModule, NbSelectModule, NbIconModule, NbProgressBarModule } from '@nebular/theme';
import { FormsRoutingModule } from '../forms/forms-routing.module';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { Ng2SmartTableModule } from 'ng2-smart-table';

@NgModule({
  declarations: [ReporteGastosComponent],
  imports: [
    CommonModule,
    ReporteGastosRoutingModule,
    ThemeModule,
    NbInputModule,
    NbCardModule,
    NbButtonModule,
    NbActionsModule,
    NbUserModule,
    NbCheckboxModule,
    NbRadioModule,
    NbDatepickerModule,
    FormsRoutingModule,
    NbSelectModule,
    NbIconModule,
    FormsModule,
    ReactiveFormsModule,
    Ng2SmartTableModule,
    NbProgressBarModule

  ]
})
export class ReporteGastosModule { }
