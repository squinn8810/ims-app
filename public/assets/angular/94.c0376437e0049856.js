"use strict";(self.webpackChunkims_ui=self.webpackChunkims_ui||[]).push([[94],{6094:(d,a,o)=>{o.r(a),o.d(a,{NotificationComponent:()=>u});var r=o(6814),n=o(9468),_=o(4472);function f(i,s){1&i&&(n.TgZ(0,"p"),n._uU(1," No Scans To Show. "),n.qZA())}function l(i,s){if(1&i&&(n.TgZ(0,"ul",3)(1,"li"),n._uU(2),n.qZA()()),2&i){const t=s.$implicit;n.xp6(2),n.AsE("Location ID [",t.itemLocID,"], EID [",t.employeeID,"]")}}function p(i,s){if(1&i){const t=n.EpF();n.TgZ(0,"div")(1,"div",2)(2,"h5",3),n._uU(3,"Scanned Items"),n.qZA()(),n.TgZ(4,"div",2),n.YNc(5,l,3,2,"ul",4),n.TgZ(6,"button",5),n.NdJ("click",function(){n.CHM(t);const e=n.oxw();return n.KtG(e.sendNotification())}),n._uU(7,"Send Notification"),n.qZA()()()}if(2&i){const t=n.oxw();n.xp6(5),n.Q6J("ngForOf",t.transactions)}}let u=(()=>{class i{constructor(t){this.scannerService=t}ngOnInit(){this.getScannedList()}getScannedList(){this.scannerService.getScannedList().subscribe(t=>{this.transactions=t},t=>{this.error=t})}sendNotification(){this.scannerService.sendNotification()}static#n=this.\u0275fac=function(c){return new(c||i)(n.Y36(_.L))};static#t=this.\u0275cmp=n.Xpm({type:i,selectors:[["app-notification"]],standalone:!0,features:[n.jDz],decls:4,vars:2,consts:[[1,"container"],[4,"ngIf"],[1,"row"],[1,"col-12"],["class","col-12",4,"ngFor","ngForOf"],[1,"btn","btn-primary","col-4",3,"click"]],template:function(c,e){1&c&&(n.TgZ(0,"div",0)(1,"div"),n.YNc(2,f,2,0,"p",1),n.qZA(),n.YNc(3,p,8,1,"div",1),n.qZA()),2&c&&(n.xp6(2),n.Q6J("ngIf",!e.transactions),n.xp6(1),n.Q6J("ngIf",e.transactions))},dependencies:[r.O5,r.ax]})}return i})()}}]);