"use strict";(self.webpackChunkims_ui=self.webpackChunkims_ui||[]).push([[864],{6864:(w,_,s)=>{s.r(_),s.d(_,{ReportsComponent:()=>d});var t=s(9468),u=s(6814),c=s(95),v=s(2062),p=s(4472);function y(i,C){1&i&&(t.TgZ(0,"div",7),t._UZ(1,"div",8),t.qZA())}function n(i,C){if(1&i){const o=t.EpF();t.TgZ(0,"div",9)(1,"div",10)(2,"label",11),t._uU(3,"Filter:"),t.qZA(),t.TgZ(4,"select",12),t.NdJ("ngModelChange",function(a){t.CHM(o);const h=t.oxw();return t.KtG(h.selectedTimePeriod=a)})("change",function(){t.CHM(o);const a=t.oxw();return t.KtG(a.onDropdownChange())}),t.TgZ(5,"option",13),t._uU(6,"1 year"),t.qZA(),t.TgZ(7,"option",14),t._uU(8,"6 months"),t.qZA(),t.TgZ(9,"option",15),t._uU(10,"3 months"),t.qZA(),t.TgZ(11,"option",16),t._uU(12,"1 month"),t.qZA()()()()}if(2&i){const o=t.oxw();t.xp6(4),t.Q6J("ngModel",o.selectedTimePeriod)}}function r(i,C){1&i&&(t.TgZ(0,"div",17),t._UZ(1,"div",18),t.qZA())}let d=(()=>{class i{constructor(o){this.scannerService=o,this.chartReady=new t.vpe,this.loading=!0,this.selectedTimePeriod="",this.selectedItem=""}ngOnInit(){this.getFilteredDataView(this.selectedTimePeriod,this.selectedItem),setTimeout(()=>{this.loading=!1},1e4)}getFilteredDataView(o,e){this.scannerService.getFilteredDataView2(o,e).subscribe(a=>{this.data=a,this.loading=!1,this.drawComboChart()},a=>{console.error("Error fetching data:",a)})}onDropdownChange(){this.getFilteredDataView(this.selectedTimePeriod,this.selectedItem)}drawComboChart(){const o=this.data.lowSupplyData,e=this.data.restockData,a=this.data.evalData;google.charts.load("current",{packages:["corechart"]}),google.charts.setOnLoadCallback(function h(){var l=new google.visualization.DataTable;l.addColumn("string","Date"),l.addColumn("number","Low Supply Scans"),l.addColumn("number","Resupply Scans"),l.addColumn("number","Suggested Reorder Qty"),l.addColumn("number","Item Reorder Qty"),Object.keys(o).forEach(f=>{l.addRow([f,o[f],e[f],a[1],a[0]])}),new google.visualization.ComboChart(document.getElementById("combo_chart")).draw(l,{title:"Low Supply vs Resupply",vAxis:{title:"Transactions"},series:{0:{type:"bars"},1:{type:"bars"},2:{type:"line"},3:{type:"line"}}})})}drawLineChart(){const o=this.data.transactionTrends;google.charts.load("current",{packages:["corechart"]}),google.charts.setOnLoadCallback(()=>{const e=new google.visualization.DataTable;e.addColumn("string","Date"),e.addColumn("number","Transactions"),Object.keys(o).forEach(g=>{e.addRow([g,o[g]])}),new google.visualization.LineChart(document.getElementById("trend_div")).draw(e,{title:"Usage Trends",width:"200%",height:"200%",hAxis:{gridlines:{}},vAxis:{gridlines:{count:10},minValue:0},curveType:"function"})})}drawPieChart(){const o=this.data.transactionDistribution;google.charts.load("current",{packages:["corechart"]}),google.charts.setOnLoadCallback(()=>{const e=new google.visualization.DataTable;e.addColumn("string","Item"),e.addColumn("number","Reorders"),Object.keys(o).forEach(g=>{e.addRow([g,o[g]])}),new google.visualization.PieChart(document.getElementById("pie_div")).draw(e,{title:"Usage Distribution",width:"200%",height:"200%",sliceVisibilityThreshold:.05})})}static#t=this.\u0275fac=function(e){return new(e||i)(t.Y36(p.L))};static#e=this.\u0275cmp=t.Xpm({type:i,selectors:[["app-reports"]],outputs:{chartReady:"chartReady"},standalone:!0,features:[t.jDz],decls:9,vars:3,consts:[[1,"container","mt-5"],[1,"card","text-center","justify-content-center"],[1,"card-header"],[1,"card-title"],["class","card-body loading-animation",4,"ngIf"],["class","row my-3",4,"ngIf"],["class","card-body",4,"ngIf"],[1,"card-body","loading-animation"],[1,"spinner"],[1,"row","my-3"],[1,"col-12","text-center"],["for","timePeriod"],["id","timePeriod",1,"custom-select",3,"ngModel","ngModelChange","change"],["value","12_months"],["value","6_months"],["value","3_months"],["value","1_month"],[1,"card-body"],["id","combo_chart",1,"row","my-3",2,"height","400px","width","90%"]],template:function(e,a){1&e&&(t._UZ(0,"app-chart"),t.TgZ(1,"div",0)(2,"div",1)(3,"div",2)(4,"h5",3),t._uU(5,"Reordering Effectiveness"),t.qZA()(),t.YNc(6,y,2,0,"div",4),t.YNc(7,n,13,1,"div",5),t.YNc(8,r,2,0,"div",6),t.qZA()()),2&e&&(t.xp6(6),t.Q6J("ngIf",a.loading),t.xp6(1),t.Q6J("ngIf",!a.loading),t.xp6(1),t.Q6J("ngIf",!a.loading))},dependencies:[u.O5,c.u5,c.YN,c.Kr,c.EJ,c.JJ,c.On,v.x],styles:[".custom-select[_ngcontent-%COMP%]{text-align:center;max-width:200px;margin:0 auto}.loading-animation[_ngcontent-%COMP%]{display:flex;justify-content:center;align-items:center;height:200px}.spinner[_ngcontent-%COMP%]{border:4px solid rgba(0,0,0,.1);border-radius:50%;border-top:4px solid #3498db;width:40px;height:40px;animation:_ngcontent-%COMP%_spin 1s linear infinite}@keyframes _ngcontent-%COMP%_spin{0%{transform:rotate(0)}to{transform:rotate(360deg)}}"]})}return i})()},4472:(w,_,s)=>{s.d(_,{L:()=>v});var t=s(9862),u=s(4664),c=s(9468);let v=(()=>{class p{constructor(n){this.http=n,this.options={headers:new t.WM({Accept:"application/json","Content-Type":"application/json"})}}postScan(n){return this.http.get("/sanctum/csrf-cookie",this.options).pipe((0,u.w)(()=>this.http.post("/api/scan",n,this.options)))}getFilteredDataView1(n){let r=new t.LE;return""!==n.trim()&&(r=r.set("time_period",n)),this.http.get("api/reports",{params:r})}getFilteredDataView2(n,r){let d=new t.LE;return""!==n.trim()&&(d=d.set("time_period",n)),""!==r.trim()&&(d=d.set("itemLocID",r)),this.http.get("api/reports/insights",{params:d})}getScannedList(){return this.http.get("/api/scanned-list",this.options)}sendLowSupplyNotification(n){return this.http.get("/sanctum/csrf-cookie",this.options).pipe((0,u.w)(()=>this.http.post("/api/send-low-supply-notification",n,this.options)))}sendRestockNotification(n){return this.http.get("/sanctum/csrf-cookie",this.options).pipe((0,u.w)(()=>this.http.post("/api/send-restock-notification",n,this.options)))}static#t=this.\u0275fac=function(r){return new(r||p)(c.LFG(t.eN))};static#e=this.\u0275prov=c.Yz7({token:p,factory:p.\u0275fac,providedIn:"root"})}return p})()}}]);