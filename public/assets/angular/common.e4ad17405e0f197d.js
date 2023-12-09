"use strict";(self.webpackChunkims_ui=self.webpackChunkims_ui||[]).push([[592],{2062:(_,h,s)=>{s.r(h),s.d(h,{ChartComponent:()=>v});var t=s(9468),r=s(6814),c=s(4472);function l(n,p){1&n&&(t.TgZ(0,"div",2),t._UZ(1,"div",3),t.qZA())}function i(n,p){1&n&&(t.TgZ(0,"div"),t._UZ(1,"div",4),t.TgZ(2,"div",5)(3,"div",6),t._UZ(4,"div",7),t.qZA(),t.TgZ(5,"div",6),t._UZ(6,"div",8),t.qZA()()())}let v=(()=>{class n{constructor(o){this.scannerService=o,this.chartReady=new t.vpe,this.loading=!0}ngOnInit(){this.getDataView(),setTimeout(()=>{this.loading=!1},1e4)}getDataView(){this.scannerService.getDataView().subscribe(o=>{this.data=o,this.loading=!1,this.drawTableChart(),this.drawLineChart(),this.drawPieChart()},o=>{console.error("Error fetching data:",o)})}drawTableChart(){const o=this.data.recentTransactions;google.charts.load("current",{packages:["table"]}),google.charts.setOnLoadCallback(()=>{const a=new google.visualization.DataTable,d=Object.keys(o[0]);d.forEach(e=>{a.addColumn(typeof o[0][e],e)}),o.forEach(e=>{const u=d.map(f=>e[f]);a.addRow(u)}),new google.visualization.Table(document.getElementById("table_div")).draw(a,{title:"Recent Removals",showRowNumber:!0,width:"100%",height:"100%"})})}drawLineChart(){const o=this.data.transactionTrends;google.charts.load("current",{packages:["corechart"]}),google.charts.setOnLoadCallback(()=>{const a=new google.visualization.DataTable;a.addColumn("string","Date"),a.addColumn("number","Transactions"),Object.keys(o).forEach(e=>{a.addRow([e,o[e]])}),new google.visualization.LineChart(document.getElementById("trend_div")).draw(a,{title:"Usage Trends",width:900,height:600,hAxis:{gridlines:{}},vAxis:{gridlines:{count:10},minValue:0}})})}drawPieChart(){const o=this.data.transactionDistribution;google.charts.load("current",{packages:["corechart"]}),google.charts.setOnLoadCallback(()=>{const a=new google.visualization.DataTable;a.addColumn("string","Item"),a.addColumn("number","Reorders"),Object.keys(o).forEach(e=>{a.addRow([e,o[e]])}),new google.visualization.PieChart(document.getElementById("pie_div")).draw(a,{title:"Transaction Distributions",sliceVisibilityThreshold:.05})})}static#t=this.\u0275fac=function(a){return new(a||n)(t.Y36(c.L))};static#n=this.\u0275cmp=t.Xpm({type:n,selectors:[["app-chart"]],inputs:{recentTransactions:"recentTransactions",transactionDistribution:"transactionDistribution",transactionTrends:"transactionTrends"},outputs:{chartReady:"chartReady"},standalone:!0,features:[t.jDz],decls:3,vars:2,consts:[["class","loading-animation",4,"ngIf"],[4,"ngIf"],[1,"loading-animation"],[1,"spinner"],["id","table_div"],[1,"row"],[1,"col-md-6"],["id","trend_div"],["id","pie_div",2,"width","100%","height","500px"]],template:function(a,d){1&a&&(t.TgZ(0,"div"),t.YNc(1,l,2,0,"div",0),t.YNc(2,i,7,0,"div",1),t.qZA()),2&a&&(t.xp6(1),t.Q6J("ngIf",d.loading),t.xp6(1),t.Q6J("ngIf",!d.loading))},dependencies:[r.O5],styles:[".loading-animation[_ngcontent-%COMP%]{display:flex;justify-content:center;align-items:center;height:200px}.spinner[_ngcontent-%COMP%]{border:4px solid rgba(0,0,0,.1);border-radius:50%;border-top:4px solid #3498db;width:40px;height:40px;animation:_ngcontent-%COMP%_spin 1s linear infinite}@keyframes _ngcontent-%COMP%_spin{0%{transform:rotate(0)}to{transform:rotate(360deg)}}"]})}return n})()},9962:(_,h,s)=>{s.d(h,{r:()=>l});var t=s(9862),r=s(4664),c=s(9468);let l=(()=>{class i{constructor(n){this.http=n,this.options={headers:new t.WM({Accept:"application/json","Content-Type":"application/json"})}}login(n){return this.http.get("/sanctum/csrf-cookie",this.options).pipe((0,r.w)(()=>this.http.post("/api/login",n,this.options)))}logout(){return this.http.get("/sanctum/csrf-cookie",this.options).pipe((0,r.w)(()=>this.http.post("/api/logout",this.options)))}register(n){return this.http.get("/sanctum/csrf-cookie",this.options).pipe((0,r.w)(()=>this.http.post("/api/register",n,this.options)))}static#t=this.\u0275fac=function(p){return new(p||i)(c.LFG(t.eN))};static#n=this.\u0275prov=c.Yz7({token:i,factory:i.\u0275fac,providedIn:"root"})}return i})()},7113:(_,h,s)=>{s.d(h,{A:()=>l});var t=s(9862),r=s(4664),c=s(9468);let l=(()=>{class i{constructor(n){this.http=n,this.options={headers:new t.WM({Accept:"application/json","Content-Type":"application/json"})}}sendResetRequest(n){return this.http.get("/sanctum/csrf-cookie",this.options).pipe((0,r.w)(()=>this.http.post("/api/forgot-password",n,this.options)))}resetPassword(n){return this.http.get("/sanctum/csrf-cookie",this.options).pipe((0,r.w)(()=>this.http.post("/api/reset-password",n,this.options)))}static#t=this.\u0275fac=function(p){return new(p||i)(c.LFG(t.eN))};static#n=this.\u0275prov=c.Yz7({token:i,factory:i.\u0275fac,providedIn:"root"})}return i})()}}]);