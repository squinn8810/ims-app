"use strict";(self.webpackChunkims_ui=self.webpackChunkims_ui||[]).push([[200],{200:(q,a,s)=>{s.r(a),s.d(a,{ResetRequestComponent:()=>R});var _=s(6814),r=s(95),d=s(2507),e=s(9468),c=s(594),g=s(7113);function f(n,m){if(1&n&&(e.TgZ(0,"div",16),e._uU(1),e.qZA()),2&n){const i=e.oxw();e.xp6(1),e.hij(" ",i.error.error.message," ")}}function p(n,m){1&n&&(e.TgZ(0,"div",17),e._uU(1," Email is required "),e.qZA())}function v(n,m){1&n&&(e.TgZ(0,"div",17),e._uU(1," Email should be in the form of 'xx@xx.xx' "),e.qZA())}let R=(()=>{class n{constructor(i,o,t){this.router=i,this.formBuilder=o,this.resetService=t}ngOnInit(){this.resetRequestForm=this.formBuilder.group({email:new r.NI("",[r.kI.email,r.kI.required])})}onSubmit({value:i,valid:o}){o&&this.resetService.sendResetRequest(i).subscribe(t=>{this.router.navigate(["login"])},t=>{this.error=t})}cancel(){this.router.navigate(["login"])}static#e=this.\u0275fac=function(o){return new(o||n)(e.Y36(c.F0),e.Y36(r.qu),e.Y36(g.A))};static#t=this.\u0275cmp=e.Xpm({type:n,selectors:[["app-reset-request"]],standalone:!0,features:[e.jDz],decls:23,vars:5,consts:[[1,"container"],[1,"row","d-flex","justify-content-center"],["class","col-8 mt-3 alert alert-danger","role","alert",4,"ngIf"],[1,"col-8","mt-3","card"],[1,"card-body"],[1,"card-title"],[1,"card-text"],["nonvalidate","",3,"formGroup","ngSubmit"],[1,"row","mb-3"],["for","email","required","",1,"form-label"],["type","email","formControlName","email",1,"form-control"],["class","error",4,"ngIf"],[1,"col-6","d-flex","align-items-center","justify-content-start","px-0"],[1,"btn","btn-danger",3,"click"],[1,"col-6","d-flex","justify-content-end","px-0"],["type","submit",1,"btn","btn-primary",3,"disabled"],["role","alert",1,"col-8","mt-3","alert","alert-danger"],[1,"error"]],template:function(o,t){if(1&o&&(e.TgZ(0,"div",0)(1,"div",1),e.YNc(2,f,2,1,"div",2),e.TgZ(3,"div",3)(4,"div",4)(5,"div",5)(6,"h5"),e._uU(7,"Login"),e.qZA()(),e.TgZ(8,"div",6)(9,"form",7),e.NdJ("ngSubmit",function(){return t.onSubmit(t.resetRequestForm)}),e.TgZ(10,"div",8)(11,"label",9),e._uU(12,"Email address"),e.qZA(),e._UZ(13,"input",10),e.YNc(14,p,2,0,"div",11),e.YNc(15,v,2,0,"div",11),e.qZA(),e.TgZ(16,"div",8)(17,"div",12)(18,"button",13),e.NdJ("click",function(){return t.cancel()}),e._uU(19,"Cancel"),e.qZA()(),e.TgZ(20,"div",14)(21,"button",15),e._uU(22,"Send Reset"),e.qZA()()()()()()()()()),2&o){let l,u;e.xp6(2),e.Q6J("ngIf",t.error),e.xp6(7),e.Q6J("formGroup",t.resetRequestForm),e.xp6(5),e.Q6J("ngIf",(null==(l=t.resetRequestForm.get("email"))?null:l.hasError("required"))&&(null==(l=t.resetRequestForm.get("email"))?null:l.touched)),e.xp6(1),e.Q6J("ngIf",(null==(u=t.resetRequestForm.get("email"))?null:u.hasError("email"))&&(null==(u=t.resetRequestForm.get("email"))?null:u.touched)),e.xp6(6),e.Q6J("disabled",t.resetRequestForm.invalid)}},dependencies:[r.UX,r._Y,r.Fj,r.JJ,r.JL,r.sg,r.u,d.IJ,_.O5]})}return n})()}}]);