"use strict";(self.webpackChunkims_ui=self.webpackChunkims_ui||[]).push([[932],{6666:(E,u,t)=>{t.r(u),t.d(u,{LoginComponent:()=>b});var e=t(95),m=t(7285),_=t(6814),o=t(9468),c=t(1076),p=t(9962);function f(r,g){if(1&r&&(o.TgZ(0,"div",19),o._uU(1),o.qZA()),2&r){const l=o.oxw();o.xp6(1),o.hij(" ",l.error.error.message," ")}}function v(r,g){1&r&&(o.TgZ(0,"div",20),o._uU(1," Email is required "),o.qZA())}function h(r,g){1&r&&(o.TgZ(0,"div",20),o._uU(1," Email should be in the form of 'xx@xx.xx' "),o.qZA())}function Z(r,g){1&r&&(o.TgZ(0,"div",20),o._uU(1," Password is required "),o.qZA())}let b=(()=>{class r{constructor(l,i,n){this.router=l,this.formBuilder=i,this.loginService=n}ngOnInit(){this.loginForm=this.formBuilder.group({email:new e.NI("",[e.kI.email,e.kI.required]),password:new e.NI("",[e.kI.required]),remember:new e.NI(!1)})}onSubmit({value:l,valid:i}){i&&this.loginService.login(l).subscribe(n=>{localStorage.setItem("auth-token",btoa(n.authentication)),this.router.navigate(["home"])},n=>{this.error=n})}static#o=this.\u0275fac=function(i){return new(i||r)(o.Y36(c.F0),o.Y36(e.qu),o.Y36(p.r))};static#n=this.\u0275cmp=o.Xpm({type:r,selectors:[["app-login"]],standalone:!0,features:[o.jDz],decls:31,vars:6,consts:[[1,"container"],[1,"row","d-flex","justify-content-center"],["class","col-8 mt-3 alert alert-danger","role","alert",4,"ngIf"],[1,"col-8","mt-3","card"],[1,"card-body"],[1,"card-title"],[1,"card-text"],["nonvalidate","",3,"formGroup","ngSubmit"],[1,"row","mb-3"],["for","email","required","",1,"form-label"],["type","email","formControlName","email",1,"form-control"],["class","error",4,"ngIf"],["for","password","required","",1,"form-label"],["type","password","formControlName","password",1,"form-control"],[1,"col-4","d-flex","align-items-center","justify-content-end"],["href","/register-user"],["href","/forgot-password"],[1,"col-4","d-flex","justify-content-end","px-0"],["type","submit",1,"btn","btn-primary",3,"disabled"],["role","alert",1,"col-8","mt-3","alert","alert-danger"],[1,"error"]],template:function(i,n){if(1&i&&(o.TgZ(0,"div",0)(1,"div",1),o.YNc(2,f,2,1,"div",2),o.TgZ(3,"div",3)(4,"div",4)(5,"div",5)(6,"h5"),o._uU(7,"Login"),o.qZA()(),o.TgZ(8,"div",6)(9,"form",7),o.NdJ("ngSubmit",function(){return n.onSubmit(n.loginForm)}),o.TgZ(10,"div",8)(11,"label",9),o._uU(12,"Email address"),o.qZA(),o._UZ(13,"input",10),o.YNc(14,v,2,0,"div",11),o.YNc(15,h,2,0,"div",11),o.qZA(),o.TgZ(16,"div",8)(17,"label",12),o._uU(18,"Password"),o.qZA(),o._UZ(19,"input",13),o.YNc(20,Z,2,0,"div",11),o.qZA(),o.TgZ(21,"div",8)(22,"div",14)(23,"a",15),o._uU(24,"Register"),o.qZA()(),o.TgZ(25,"div",14)(26,"a",16),o._uU(27,"Forgot Password?"),o.qZA()(),o.TgZ(28,"div",17)(29,"button",18),o._uU(30,"Login"),o.qZA()()()()()()()()()),2&i){let a,s,d;o.xp6(2),o.Q6J("ngIf",n.error),o.xp6(7),o.Q6J("formGroup",n.loginForm),o.xp6(5),o.Q6J("ngIf",(null==(a=n.loginForm.get("email"))?null:a.hasError("required"))&&(null==(a=n.loginForm.get("email"))?null:a.touched)),o.xp6(1),o.Q6J("ngIf",(null==(s=n.loginForm.get("email"))?null:s.hasError("email"))&&(null==(s=n.loginForm.get("email"))?null:s.touched)),o.xp6(5),o.Q6J("ngIf",(null==(d=n.loginForm.get("password"))?null:d.hasError("required"))&&(null==(d=n.loginForm.get("password"))?null:d.touched)),o.xp6(9),o.Q6J("disabled",n.loginForm.invalid)}},dependencies:[e.UX,e._Y,e.Fj,e.JJ,e.JL,e.sg,e.u,m.IJ,_.O5],styles:["input.ng-dirty.ng-invalid[_ngcontent-%COMP%], input.ng-touched.ng-invalid[_ngcontent-%COMP%]{border-style:solid;border-color:#f22610;box-shadow:inset 0 1px 1px #00000013,0 0 8px #ff00004d}.error[_ngcontent-%COMP%]{color:#f22610}input.ng-dirty.ng-valid[_ngcontent-%COMP%], input.ng-touched.ng-valid[_ngcontent-%COMP%]{border-style:solid;border-color:#0a3;box-shadow:inset 0 1px 1px #00000013,0 0 8px #00ff004d}"]})}return r})()}}]);