"use strict";(self.webpackChunkims_ui=self.webpackChunkims_ui||[]).push([[952],{8952:(T,p,s)=>{s.r(p),s.d(p,{UpdateUserComponent:()=>I});var t=s(95),c=s(7285),f=s(6814),e=s(9468),_=s(1076),U=s(6530);function g(a,l){if(1&a&&(e.TgZ(0,"div",22),e._uU(1),e.qZA()),2&a){const i=e.oxw();e.xp6(1),e.hij(" ",i.error.error.message," ")}}function h(a,l){1&a&&(e.TgZ(0,"div",23),e._uU(1," First Name is required "),e.qZA())}function v(a,l){1&a&&(e.TgZ(0,"div",23),e._uU(1," Last Name is required "),e.qZA())}function Z(a,l){1&a&&(e.TgZ(0,"div",23),e._uU(1," Email is required "),e.qZA())}function N(a,l){1&a&&(e.TgZ(0,"div",23),e._uU(1," Email should be in the form of 'xx@xx.xx' "),e.qZA())}let I=(()=>{class a{constructor(i,n,r,o){this.router=i,this.route=n,this.formBuilder=r,this.userService=o}ngOnInit(){this.updateUserForm=this.formBuilder.group({firstName:new t.NI("",[t.kI.required,t.kI.maxLength(32)]),lastName:new t.NI("",[t.kI.required,t.kI.maxLength(32)]),email:new t.NI("",[t.kI.email,t.kI.required,t.kI.maxLength(32)]),is_admin:new t.NI(!1)}),this.userId=this.route.snapshot.params.userId,this.userService.getUser(this.userId).subscribe(i=>{this.user=i,this.updateUserForm.controls.firstName.setValue(i.first_name),this.updateUserForm.controls.lastName.setValue(i.last_name),this.updateUserForm.controls.email.setValue(i.email),this.updateUserForm.controls.is_admin.setValue(i.isAdmin)},i=>{this.error=i})}onSubmit({value:i,valid:n}){n&&this.userService.updateUser(i,this.userId).subscribe(r=>{this.router.navigate(["manage-users"])},r=>{this.error=r})}cancelUpdate(){this.router.navigate(["manage-users"])}static#e=this.\u0275fac=function(n){return new(n||a)(e.Y36(_.F0),e.Y36(_.gz),e.Y36(t.qu),e.Y36(U.K))};static#t=this.\u0275cmp=e.Xpm({type:a,selectors:[["app-update-user"]],standalone:!0,features:[e.jDz],decls:36,vars:7,consts:[[1,"container"],[1,"row","text-center"],[1,"mt-3"],[1,"row","d-flex","justify-content-center"],["class","col-8 mt-3 alert alert-danger","role","alert",4,"ngIf"],[1,"col-8","mt-3"],["nonvalidate","",3,"formGroup","ngSubmit"],[1,"row","mb-3"],["for","firstName","required","",1,"form-label"],["type","text","formControlName","firstName",1,"form-control"],["class","error",4,"ngIf"],["for","lastName","required","",1,"form-label"],["type","text","formControlName","lastName",1,"form-control"],["for","email","required","",1,"form-label"],["type","email","formControlName","email",1,"form-control"],[1,"col-3","form-check"],["type","checkbox","formControlName","is_admin",1,"form-check-input"],["for","is_admin",1,"form-check-label"],[1,"col-6","d-flex","justify-content-start","px-0"],[1,"btn","btn-danger",3,"click"],[1,"col-6","d-flex","justify-content-end","px-0"],["type","submit",1,"btn","btn-primary",3,"disabled"],["role","alert",1,"col-8","mt-3","alert","alert-danger"],[1,"error"]],template:function(n,r){if(1&n&&(e.TgZ(0,"div",0)(1,"div",1)(2,"h3",2),e._uU(3,"Update User"),e.qZA()(),e.TgZ(4,"div",3),e.YNc(5,g,2,1,"div",4),e.qZA(),e.TgZ(6,"div",5)(7,"form",6),e.NdJ("ngSubmit",function(){return r.onSubmit(r.updateUserForm)}),e.TgZ(8,"div",7)(9,"label",8),e._uU(10,"First Name"),e.qZA(),e._UZ(11,"input",9),e.YNc(12,h,2,0,"div",10),e.qZA(),e.TgZ(13,"div",7)(14,"label",11),e._uU(15,"Last Name"),e.qZA(),e._UZ(16,"input",12),e.YNc(17,v,2,0,"div",10),e.qZA(),e.TgZ(18,"div",7)(19,"label",13),e._uU(20,"Email address"),e.qZA(),e._UZ(21,"input",14),e.YNc(22,Z,2,0,"div",10),e.YNc(23,N,2,0,"div",10),e.qZA(),e.TgZ(24,"div",7)(25,"div",15),e._UZ(26,"input",16),e.TgZ(27,"label",17),e._uU(28,"Admin"),e.qZA()()(),e.TgZ(29,"div",7)(30,"div",18)(31,"button",19),e.NdJ("click",function(){return r.cancelUpdate()}),e._uU(32,"Cancel"),e.qZA()(),e.TgZ(33,"div",20)(34,"button",21),e._uU(35,"Update"),e.qZA()()()()()()),2&n){let o,u,m,d;e.xp6(5),e.Q6J("ngIf",r.error),e.xp6(2),e.Q6J("formGroup",r.updateUserForm),e.xp6(5),e.Q6J("ngIf",(null==(o=r.updateUserForm.get("firstName"))?null:o.hasError("required"))&&(null==(o=r.updateUserForm.get("firstName"))?null:o.touched)),e.xp6(5),e.Q6J("ngIf",(null==(u=r.updateUserForm.get("lastName"))?null:u.hasError("required"))&&(null==(u=r.updateUserForm.get("lastName"))?null:u.touched)),e.xp6(5),e.Q6J("ngIf",(null==(m=r.updateUserForm.get("email"))?null:m.hasError("required"))&&(null==(m=r.updateUserForm.get("email"))?null:m.touched)),e.xp6(1),e.Q6J("ngIf",(null==(d=r.updateUserForm.get("email"))?null:d.hasError("email"))&&(null==(d=r.updateUserForm.get("email"))?null:d.touched)),e.xp6(11),e.Q6J("disabled",r.updateUserForm.invalid)}},dependencies:[t.UX,t._Y,t.Fj,t.Wl,t.JJ,t.JL,t.sg,t.u,c.IJ,f.O5]})}return a})()}}]);