"use strict";(self.webpackChunkims_ui=self.webpackChunkims_ui||[]).push([[401],{5401:(O,Z,s)=>{s.r(Z),s.d(Z,{RegistrationComponent:()=>J});var N=s(6814),o=s(95),T=s(2507),t=s(9468),q=s(1076),I=s(9962);function x(e,n){if(1&e&&(t.TgZ(0,"div",28),t._uU(1),t.qZA()),2&e){const a=t.oxw();t.xp6(1),t.hij(" ",a.error.error.message," ")}}function C(e,n){1&e&&(t.TgZ(0,"div",29),t._uU(1," First Name is required "),t.qZA())}function b(e,n){1&e&&(t.TgZ(0,"div",30),t._uU(1," Max length of 32 exceeded "),t.qZA())}function E(e,n){1&e&&(t.TgZ(0,"div",29),t._uU(1," Last Name is required "),t.qZA())}function U(e,n){1&e&&(t.TgZ(0,"div",30),t._uU(1," Max length of 32 exceeded "),t.qZA())}function A(e,n){1&e&&(t.TgZ(0,"div",29),t._uU(1," Employee ID is required "),t.qZA())}function w(e,n){1&e&&(t.TgZ(0,"div",30),t._uU(1," Max length of 32 exceeded "),t.qZA())}function F(e,n){1&e&&(t.TgZ(0,"div",30),t._uU(1," Email is required "),t.qZA())}function P(e,n){1&e&&(t.TgZ(0,"div",30),t._uU(1," Email should be in the form of 'xx@xx.xx' "),t.qZA())}function R(e,n){1&e&&(t.TgZ(0,"div",30),t._uU(1," Max length of 255 "),t.qZA())}function y(e,n){1&e&&(t.TgZ(0,"div",30),t._uU(1," Password is required "),t.qZA())}function M(e,n){1&e&&(t.TgZ(0,"div",30),t._uU(1," Passwords do not match "),t.qZA())}let J=(()=>{class e{constructor(a,i,r){this.router=a,this.loginService=i,this.formBuilder=r}ngOnInit(){this.registrationForm=this.formBuilder.group({firstName:new o.NI("",[o.kI.required,o.kI.maxLength(32)]),lastName:new o.NI("",[o.kI.required,o.kI.maxLength(32)]),id:new o.NI("",[o.kI.required,o.kI.maxLength(32)]),email:new o.NI("",[o.kI.email,o.kI.required,o.kI.maxLength(255)]),password:new o.NI("",[o.kI.required]),password_confirmation:new o.NI("",[])},{validator:this.confirmPasswordValidator("password","password_confirmation")})}onSubmit({value:a,valid:i}){i&&this.loginService.register(a).subscribe(r=>{localStorage.setItem("auth-token",btoa(r.authentication)),this.router.navigate(["home"])},r=>{console.log(r),this.error=r,console.log(this.error)})}confirmPasswordValidator(a,i){return r=>{const m=r.controls[a],l=r.controls[i];l.errors&&!l.errors?.confirmPassword||l.setErrors(m.value!==l.value?{confirmPassword:!0}:null)}}cancel(){this.router.navigate(["login"])}static#t=this.\u0275fac=function(i){return new(i||e)(t.Y36(q.F0),t.Y36(I.r),t.Y36(o.qu))};static#r=this.\u0275cmp=t.Xpm({type:e,selectors:[["app-registration"]],standalone:!0,features:[t.jDz],decls:52,vars:14,consts:[[1,"container"],[1,"row","d-flex","justify-content-center"],["class","col-8 mt-3 alert alert-danger","role","alert",4,"ngIf"],[1,"col-8","mt-3","card"],[1,"card-body"],[1,"card-title"],[1,"card-text"],["novalidate","",3,"formGroup","ngSubmit"],[1,"row","mb-3"],["for","firstName","required","",1,"form-label"],["type","text","formControlName","firstName",1,"form-control"],["class","invalid-feedback",4,"ngIf"],["class","error",4,"ngIf"],["for","lastName","required","",1,"form-label"],["type","text","formControlName","lastName",1,"form-control"],["for","id","required","",1,"form-label"],["type","text","formControlName","id",1,"form-control"],["for","email","required","",1,"form-label"],["type","email","formControlName","email",1,"form-control"],["for","password","required","",1,"form-label"],["type","password","formControlName","password",1,"form-control"],["for","password_confirmation","required","",1,"form-label"],["type","password","formControlName","password_confirmation",1,"form-control"],[1,"row"],[1,"col","d-flex","justify-content-start","px-0"],[1,"btn","btn-danger",3,"click"],[1,"col","d-flex","justify-content-end","px-0"],["type","submit",1,"btn","btn-primary",3,"disabled"],["role","alert",1,"col-8","mt-3","alert","alert-danger"],[1,"invalid-feedback"],[1,"error"]],template:function(i,r){if(1&i&&(t.TgZ(0,"div",0)(1,"div",1),t.YNc(2,x,2,1,"div",2),t.TgZ(3,"div",3)(4,"div",4)(5,"div",5)(6,"h5"),t._uU(7,"Register New User"),t.qZA()(),t.TgZ(8,"div",6)(9,"form",7),t.NdJ("ngSubmit",function(){return r.onSubmit(r.registrationForm)}),t.TgZ(10,"div",8)(11,"label",9),t._uU(12,"First Name"),t.qZA(),t._UZ(13,"input",10),t.YNc(14,C,2,0,"div",11),t.YNc(15,b,2,0,"div",12),t.qZA(),t.TgZ(16,"div",8)(17,"label",13),t._uU(18,"Last Name"),t.qZA(),t._UZ(19,"input",14),t.YNc(20,E,2,0,"div",11),t.YNc(21,U,2,0,"div",12),t.qZA(),t.TgZ(22,"div",8)(23,"label",15),t._uU(24,"Employee ID"),t.qZA(),t._UZ(25,"input",16),t.YNc(26,A,2,0,"div",11),t.YNc(27,w,2,0,"div",12),t.qZA(),t.TgZ(28,"div",8)(29,"label",17),t._uU(30,"Email address"),t.qZA(),t._UZ(31,"input",18),t.YNc(32,F,2,0,"div",12),t.YNc(33,P,2,0,"div",12),t.YNc(34,R,2,0,"div",12),t.qZA(),t.TgZ(35,"div",8)(36,"label",19),t._uU(37,"Password"),t.qZA(),t._UZ(38,"input",20),t.YNc(39,y,2,0,"div",12),t.qZA(),t.TgZ(40,"div",8)(41,"label",21),t._uU(42,"Confirm Password"),t.qZA(),t._UZ(43,"input",22),t.YNc(44,M,2,0,"div",12),t.qZA(),t.TgZ(45,"div",23)(46,"div",24)(47,"button",25),t.NdJ("click",function(){return r.cancel()}),t._uU(48,"Cancel"),t.qZA()(),t.TgZ(49,"div",26)(50,"button",27),t._uU(51,"Login"),t.qZA()()()()()()()()()),2&i){let m,l,d,u,g,_,f,c,p,v,h;t.xp6(2),t.Q6J("ngIf",r.error),t.xp6(7),t.Q6J("formGroup",r.registrationForm),t.xp6(5),t.Q6J("ngIf",(null==(m=r.registrationForm.get("firstName"))?null:m.hasError("required"))&&(null==(m=r.registrationForm.get("firstName"))?null:m.touched)),t.xp6(1),t.Q6J("ngIf",(null==(l=r.registrationForm.get("firstName"))?null:l.hasError("maxlength"))&&(null==(l=r.registrationForm.get("firstName"))?null:l.touched)),t.xp6(5),t.Q6J("ngIf",(null==(d=r.registrationForm.get("lastName"))?null:d.hasError("required"))&&(null==(d=r.registrationForm.get("lastName"))?null:d.touched)),t.xp6(1),t.Q6J("ngIf",(null==(u=r.registrationForm.get("lastName"))?null:u.hasError("maxlength"))&&(null==(u=r.registrationForm.get("lastName"))?null:u.touched)),t.xp6(5),t.Q6J("ngIf",(null==(g=r.registrationForm.get("id"))?null:g.hasError("required"))&&(null==(g=r.registrationForm.get("id"))?null:g.touched)),t.xp6(1),t.Q6J("ngIf",(null==(_=r.registrationForm.get("id"))?null:_.hasError("maxlength"))&&(null==(_=r.registrationForm.get("id"))?null:_.touched)),t.xp6(5),t.Q6J("ngIf",(null==(f=r.registrationForm.get("email"))?null:f.hasError("required"))&&(null==(f=r.registrationForm.get("email"))?null:f.touched)),t.xp6(1),t.Q6J("ngIf",(null==(c=r.registrationForm.get("email"))?null:c.hasError("email"))&&(null==(c=r.registrationForm.get("email"))?null:c.touched)),t.xp6(1),t.Q6J("ngIf",(null==(p=r.registrationForm.get("email"))?null:p.hasError("maxlength"))&&(null==(p=r.registrationForm.get("email"))?null:p.touched)),t.xp6(5),t.Q6J("ngIf",(null==(v=r.registrationForm.get("password"))?null:v.hasError("required"))&&(null==(v=r.registrationForm.get("password"))?null:v.touched)),t.xp6(5),t.Q6J("ngIf",(null==(h=r.registrationForm.get("password_confirmation"))?null:h.hasError("confirmPassword"))&&(null==(h=r.registrationForm.get("password_confirmation"))?null:h.touched)),t.xp6(6),t.Q6J("disabled",r.registrationForm.invalid)}},dependencies:[o.UX,o._Y,o.Fj,o.JJ,o.JL,o.sg,o.u,T.IJ,N.O5],styles:["input.ng-dirty.ng-invalid[_ngcontent-%COMP%], input.ng-touched.ng-invalid[_ngcontent-%COMP%]{border-style:solid;border-color:#f22610;box-shadow:inset 0 1px 1px #00000013,0 0 8px #ff00004d}.error[_ngcontent-%COMP%]{color:#f22610}input.ng-dirty.ng-valid[_ngcontent-%COMP%], input.ng-touched.ng-valid[_ngcontent-%COMP%]{border-style:solid;border-color:#0a3;box-shadow:inset 0 1px 1px #00000013,0 0 8px #00ff004d}"]})}return e})()}}]);