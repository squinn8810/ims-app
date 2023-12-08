"use strict";(self.webpackChunkims_ui=self.webpackChunkims_ui||[]).push([[925],{925:(Z,c,n)=>{n.r(c),n.d(c,{ManageUsersComponent:()=>U});var u=n(7285),_=n(6814),e=n(9468),d=n(1076),p=n(6530);function g(s,l){if(1&s&&(e.TgZ(0,"div",7),e._uU(1),e.qZA()),2&s){const t=e.oxw();e.xp6(1),e.hij(" ",t.error.error.message," ")}}function m(s,l){if(1&s){const t=e.EpF();e.TgZ(0,"tr")(1,"th",8),e._uU(2),e.qZA(),e.TgZ(3,"td"),e._uU(4),e.qZA(),e.TgZ(5,"td"),e._uU(6),e.qZA(),e.TgZ(7,"td"),e._uU(8),e.qZA(),e.TgZ(9,"td",9)(10,"div",10)(11,"button",11),e.NdJ("click",function(){const i=e.CHM(t).$implicit,a=e.oxw();return e.KtG(a.deleteUser(i.employee_id))}),e._uU(12,"Delete"),e.qZA()(),e.TgZ(13,"div",12)(14,"button",13),e.NdJ("click",function(){const i=e.CHM(t).$implicit,a=e.oxw();return e.KtG(a.updateUser(i.employee_id))}),e._uU(15,"Edit"),e.qZA()()()()}if(2&s){const t=l.$implicit;e.xp6(2),e.AsE("",t.first_name," ",t.last_name,""),e.xp6(2),e.Oqu(t.email),e.xp6(2),e.Oqu(t.employee_id),e.xp6(2),e.Oqu(t.isAdmin)}}let U=(()=>{class s{constructor(t,r){this.router=t,this.userService=r}ngOnInit(){this.userService.getAllUsers().subscribe(t=>{this.users=t},t=>{this.error=t})}updateUser(t){this.router.navigate(["update-user/"+t])}deleteUser(t){this.userService.deleteUser(t).subscribe(r=>{this.ngOnInit()},r=>{this.error=r})}static#e=this.\u0275fac=function(r){return new(r||s)(e.Y36(d.F0),e.Y36(p.K))};static#t=this.\u0275cmp=e.Xpm({type:s,selectors:[["app-manage-users"]],standalone:!0,features:[e.jDz],decls:21,vars:2,consts:[[1,"container"],[1,"row"],[1,"row","d-flex","justify-content-center"],["class","col-8 mt-3 alert alert-danger","role","alert",4,"ngIf"],[1,"table","table-striped","table-bordered"],["scope","col"],[4,"ngFor","ngForOf"],["role","alert",1,"col-8","mt-3","alert","alert-danger"],["scope","row"],[1,"d-flex","justify-content-center"],[1,"col","d-flex","justify-content-start","px-0"],[1,"btn","btn-danger",3,"click"],[1,"col","d-flex","justify-content-end","px-0"],[1,"btn","btn-primary",3,"click"]],template:function(r,o){1&r&&(e.TgZ(0,"div",0)(1,"div",1)(2,"h5"),e._uU(3,"Update User"),e.qZA()(),e.TgZ(4,"div",2),e.YNc(5,g,2,1,"div",3),e.qZA(),e.TgZ(6,"div",2)(7,"table",4)(8,"thead")(9,"tr")(10,"th",5),e._uU(11,"Name"),e.qZA(),e.TgZ(12,"th",5),e._uU(13,"Email"),e.qZA(),e.TgZ(14,"th",5),e._uU(15,"EID"),e.qZA(),e.TgZ(16,"th",5),e._uU(17,"Admin User"),e.qZA(),e._UZ(18,"th",5),e.qZA()(),e.TgZ(19,"tbody"),e.YNc(20,m,16,5,"tr",6),e.qZA()()()()),2&r&&(e.xp6(5),e.Q6J("ngIf",o.error),e.xp6(15),e.Q6J("ngForOf",o.users))},dependencies:[u.IJ,_.O5,_.ax]})}return s})()}}]);