"use strict";(self.webpackChunkims_ui=self.webpackChunkims_ui||[]).push([[932],{6666:(T,u,t)=>{t.r(u),t.d(u,{LoginComponent:()=>Z});var r=t(95),g=t(2507),_=t(6814),o=t(9468),c=t(594),f=t(9962);function p(n,m){if(1&n&&(o.TgZ(0,"div",22),o._uU(1),o.qZA()),2&n){const l=o.oxw();o.xp6(1),o.hij(" ",l.error.error.message," ")}}function v(n,m){1&n&&(o.TgZ(0,"div",23),o._uU(1," Email is required "),o.qZA())}function h(n,m){1&n&&(o.TgZ(0,"div",23),o._uU(1," Email should be in the form of 'xx@xx.xx' "),o.qZA())}function b(n,m){1&n&&(o.TgZ(0,"div",23),o._uU(1," Password is required "),o.qZA())}let Z=(()=>{class n{constructor(l,i,e){this.router=l,this.formBuilder=i,this.loginService=e}ngOnInit(){this.loginForm=this.formBuilder.group({email:new r.NI("",[r.kI.email,r.kI.required]),password:new r.NI("",[r.kI.required]),remember:new r.NI(!1)})}onSubmit({value:l,valid:i}){i&&this.loginService.login(l).subscribe(e=>{localStorage.setItem("auth-token",btoa(e.authentication)),this.router.navigate(["home"])},e=>{this.error=e})}static#o=this.\u0275fac=function(i){return new(i||n)(o.Y36(c.F0),o.Y36(r.qu),o.Y36(f.r))};static#e=this.\u0275cmp=o.Xpm({type:n,selectors:[["app-login"]],standalone:!0,features:[o.jDz],decls:35,vars:6,consts:[[1,"container"],[1,"row","d-flex","justify-content-center"],["class","col-8 mt-3 alert alert-danger","role","alert",4,"ngIf"],[1,"col-8","mt-3","card"],[1,"card-body"],[1,"card-title"],[1,"card-text"],["nonvalidate","",3,"formGroup","ngSubmit"],[1,"row","mb-3"],["for","email","required","",1,"form-label"],["type","email","formControlName","email",1,"form-control"],["class","error",4,"ngIf"],["for","password","required","",1,"form-label"],["type","password","formControlName","password",1,"form-control"],[1,"col-3","form-check"],["type","checkbox","formControlName","remember",1,"form-check-input"],["for","remember",1,"form-check-label"],[1,"col-3","d-flex","align-items-center","justify-content-end"],["href","/register-user"],["href","/forgot-password"],[1,"col-3","d-flex","justify-content-end","px-0"],["type","submit",1,"btn","btn-primary",3,"disabled"],["role","alert",1,"col-8","mt-3","alert","alert-danger"],[1,"error"]],template:function(i,e){if(1&i&&(o.TgZ(0,"div",0)(1,"div",1),o.YNc(2,p,2,1,"div",2),o.TgZ(3,"div",3)(4,"div",4)(5,"div",5)(6,"h5"),o._uU(7,"Login"),o.qZA()(),o.TgZ(8,"div",6)(9,"form",7),o.NdJ("ngSubmit",function(){return e.onSubmit(e.loginForm)}),o.TgZ(10,"div",8)(11,"label",9),o._uU(12,"Email address"),o.qZA(),o._UZ(13,"input",10),o.YNc(14,v,2,0,"div",11),o.YNc(15,h,2,0,"div",11),o.qZA(),o.TgZ(16,"div",8)(17,"label",12),o._uU(18,"Password"),o.qZA(),o._UZ(19,"input",13),o.YNc(20,b,2,0,"div",11),o.qZA(),o.TgZ(21,"div",8)(22,"div",14),o._UZ(23,"input",15),o.TgZ(24,"label",16),o._uU(25,"Remember"),o.qZA()(),o.TgZ(26,"div",17)(27,"a",18),o._uU(28,"Register"),o.qZA()(),o.TgZ(29,"div",17)(30,"a",19),o._uU(31,"Forgot Password?"),o.qZA()(),o.TgZ(32,"div",20)(33,"button",21),o._uU(34,"Login"),o.qZA()()()()()()()()()),2&i){let a,s,d;o.xp6(2),o.Q6J("ngIf",e.error),o.xp6(7),o.Q6J("formGroup",e.loginForm),o.xp6(5),o.Q6J("ngIf",(null==(a=e.loginForm.get("email"))?null:a.hasError("required"))&&(null==(a=e.loginForm.get("email"))?null:a.touched)),o.xp6(1),o.Q6J("ngIf",(null==(s=e.loginForm.get("email"))?null:s.hasError("email"))&&(null==(s=e.loginForm.get("email"))?null:s.touched)),o.xp6(5),o.Q6J("ngIf",(null==(d=e.loginForm.get("password"))?null:d.hasError("required"))&&(null==(d=e.loginForm.get("password"))?null:d.touched)),o.xp6(13),o.Q6J("disabled",e.loginForm.invalid)}},dependencies:[r.UX,r._Y,r.Fj,r.Wl,r.JJ,r.JL,r.sg,r.u,g.IJ,_.O5],styles:["input.ng-dirty.ng-invalid[_ngcontent-%COMP%], input.ng-touched.ng-invalid[_ngcontent-%COMP%]{border-style:solid;border-color:#f22610;box-shadow:inset 0 1px 1px #00000013,0 0 8px #ff00004d}.error[_ngcontent-%COMP%]{color:#f22610}input.ng-dirty.ng-valid[_ngcontent-%COMP%], input.ng-touched.ng-valid[_ngcontent-%COMP%]{border-style:solid;border-color:#0a3;box-shadow:inset 0 1px 1px #00000013,0 0 8px #00ff004d}"]})}return n})()}}]);