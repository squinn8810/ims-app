import { ApplicationConfig, importProvidersFrom } from "@angular/core";
import { provideRouter } from "@angular/router";
import { routes } from "./app.routes";
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { BrowserModule } from "@angular/platform-browser";
import { HTTP_INTERCEPTORS, HttpClientModule } from '@angular/common/http';
import { APP_BASE_HREF } from "@angular/common";
import { ErrorCatchingInterceptor } from "./error-catching-interceptor";

export const appConfig: ApplicationConfig = {
    providers: [provideRouter(routes), 
        importProvidersFrom(BrowserAnimationsModule, BrowserModule, HttpClientModule), 
        {provide: APP_BASE_HREF, useValue: '/'},
        {provide: HTTP_INTERCEPTORS, useClass: ErrorCatchingInterceptor, multi: true},
    ],
}