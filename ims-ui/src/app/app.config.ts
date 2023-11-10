import { ApplicationConfig, importProvidersFrom } from "@angular/core";
import { provideRouter } from "@angular/router";
import { routes } from "./app.routes";
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { BrowserModule } from "@angular/platform-browser";
import { provideHttpClient } from '@angular/common/http';
import { APP_BASE_HREF } from "@angular/common";

export const appConfig: ApplicationConfig = {
    providers: [provideRouter(routes), importProvidersFrom(BrowserAnimationsModule, BrowserModule), provideHttpClient(), {provide: APP_BASE_HREF, useValue: '/'}],
};