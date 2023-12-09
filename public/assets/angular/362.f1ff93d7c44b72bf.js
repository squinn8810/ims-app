"use strict";(self.webpackChunkims_ui=self.webpackChunkims_ui||[]).push([[362],{7362:(T,_,l)=>{l.r(_),l.d(_,{PasswordResetComponent:()=>E});var p=l(6814),o=l(95),f=l(7285),e=l(9468),c=l(1076),g=l(7113);function v(t,d){if(1&t&&(e.TgZ(0,"div",21),e._uU(1),e.qZA()),2&t){const i=e.oxw();e.xp6(1),e.hij(" ",i.error.error.message," ")}}function w(t,d){1&t&&(e.TgZ(0,"div",22),e._uU(1," Email is required "),e.qZA())}function h(t,d){1&t&&(e.TgZ(0,"div",22),e._uU(1," Email should be in the form of 'xx@xx.xx' "),e.qZA())}function P(t,d){1&t&&(e.TgZ(0,"div",22),e._uU(1," Password is required "),e.qZA())}function Z(t,d){1&t&&(e.TgZ(0,"div",22),e._uU(1," Passwords do not match "),e.qZA())}let E=(()=>{class t{constructor(i,s,r,n){this.route=i,this.router=s,this.resetService=r,this.formBuilder=n}ngOnInit(){console.log("token: "+this.route.snapshot.paramMap.get("token")),this.resetForm=this.formBuilder.group({token:new o.NI(this.route.snapshot.paramMap.get("token"),[o.kI.required]),email:new o.NI("",[o.kI.email,o.kI.required,o.kI.maxLength(255)]),password:new o.NI("",[o.kI.required]),password_confirmation:new o.NI("",[])},{validator:this.confirmPasswordValidator("password","password_confirmation")})}onSubmit({value:i,valid:s}){s&&this.resetService.resetPassword(i).subscribe(r=>{this.router.navigate(["login"])},r=>{this.error=r})}cancel(){this.router.navigate(["login"])}confirmPasswordValidator(i,s){return r=>{const n=r.controls[i],a=r.controls[s];a.errors&&!a.errors?.confirmPassword||a.setErrors(n.value!==a.value?{confirmPassword:!0}:null)}}static#e=this.\u0275fac=function(s){return new(s||t)(e.Y36(c.gz),e.Y36(c.F0),e.Y36(g.A),e.Y36(o.qu))};static#r=this.\u0275cmp=e.Xpm({type:t,selectors:[["app-password-reset"]],standalone:!0,features:[e.jDz],decls:34,vars:7,consts:[[1,"container"],[1,"row","d-flex","justify-content-center"],["class","col-8 mt-3 alert alert-danger","role","alert",4,"ngIf"],[1,"col-8","mt-3","card"],[1,"card-body"],[1,"card-title"],[1,"card-text"],["nonvalidate","",3,"formGroup","ngSubmit"],["type","hidden","formControlName","token"],[1,"row","mb-3"],["for","email","required","",1,"form-label"],["type","email","formControlName","email",1,"form-control"],["class","error",4,"ngIf"],["for","password","required","",1,"form-label"],["type","password","formControlName","password",1,"form-control"],["for","password_confirmation","required","",1,"form-label"],["type","password","formControlName","password_confirmation",1,"form-control"],[1,"col-6","d-flex","justify-content-start","form-check"],[1,"btn","btn-danger",3,"click"],[1,"col-6","d-flex","justify-content-end","px-0"],["type","submit",1,"btn","btn-primary",3,"disabled"],["role","alert",1,"col-8","mt-3","alert","alert-danger"],[1,"error"]],template:function(s,r){if(1&s&&(e.TgZ(0,"div",0)(1,"div",1),e.YNc(2,v,2,1,"div",2),e.TgZ(3,"div",3)(4,"div",4)(5,"div",5)(6,"h5"),e._uU(7,"Reset Password"),e.qZA()(),e.TgZ(8,"div",6)(9,"form",7),e.NdJ("ngSubmit",function(){return r.onSubmit(r.resetForm)}),e._UZ(10,"input",8),e.TgZ(11,"div",9)(12,"label",10),e._uU(13,"Email address"),e.qZA(),e._UZ(14,"input",11),e.YNc(15,w,2,0,"div",12),e.YNc(16,h,2,0,"div",12),e.qZA(),e.TgZ(17,"div",9)(18,"label",13),e._uU(19,"Password"),e.qZA(),e._UZ(20,"input",14),e.YNc(21,P,2,0,"div",12),e.qZA(),e.TgZ(22,"div",9)(23,"label",15),e._uU(24,"Confirm Password"),e.qZA(),e._UZ(25,"input",16),e.YNc(26,Z,2,0,"div",12),e.qZA(),e.TgZ(27,"div",9)(28,"div",17)(29,"button",18),e.NdJ("click",function(){return r.cancel()}),e._uU(30,"Cancel"),e.qZA()(),e.TgZ(31,"div",19)(32,"button",20),e._uU(33,"Reset Password"),e.qZA()()()()()()()()()),2&s){let n,a,m,u;e.xp6(2),e.Q6J("ngIf",r.error),e.xp6(7),e.Q6J("formGroup",r.resetForm),e.xp6(6),e.Q6J("ngIf",(null==(n=r.resetForm.get("email"))?null:n.hasError("required"))&&(null==(n=r.resetForm.get("email"))?null:n.touched)),e.xp6(1),e.Q6J("ngIf",(null==(a=r.resetForm.get("email"))?null:a.hasError("email"))&&(null==(a=r.resetForm.get("email"))?null:a.touched)),e.xp6(5),e.Q6J("ngIf",(null==(m=r.resetForm.get("password"))?null:m.hasError("required"))&&(null==(m=r.resetForm.get("password"))?null:m.touched)),e.xp6(5),e.Q6J("ngIf",(null==(u=r.resetForm.get("password_confirmation"))?null:u.hasError("required"))&&(null==(u=r.resetForm.get("password_confirmation"))?null:u.touched)),e.xp6(6),e.Q6J("disabled",r.resetForm.invalid)}},dependencies:[o.UX,o._Y,o.Fj,o.JJ,o.JL,o.sg,o.u,f.IJ,p.O5]})}return t})()}}]);