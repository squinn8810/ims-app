"use strict";(self.webpackChunkims_ui=self.webpackChunkims_ui||[]).push([[472],{4472:(h,a,i)=>{i.d(a,{L:()=>r});var o=i(9862),e=i(4664),p=i(9468);let r=(()=>{class s{constructor(t){this.http=t,this.options={headers:new o.WM({Accept:"application/json","Content-Type":"application/json"})}}postScan(t){return this.http.get("/sanctum/csrf-cookie",this.options).pipe((0,e.w)(()=>this.http.post("/api/scan",t,this.options)))}getDataView(){return this.http.get("api/reports",this.options)}getReportView(t,n){const c={params:(new o.LE).set("itemLocID",t).set("time_period",n)};return this.http.get("api/reports",c)}getScannedList(){return this.http.get("/api/scanned-list",this.options)}sendNotification(t){return this.http.get("/sanctum/csrf-cookie",this.options).pipe((0,e.w)(()=>this.http.post("/api/send-restock-notification",t,this.options)))}static#t=this.\u0275fac=function(n){return new(n||s)(p.LFG(o.eN))};static#s=this.\u0275prov=p.Yz7({token:s,factory:s.\u0275fac,providedIn:"root"})}return s})()}}]);