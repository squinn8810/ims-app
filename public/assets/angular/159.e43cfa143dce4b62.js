"use strict";(self.webpackChunkims_ui=self.webpackChunkims_ui||[]).push([[159],{159:(m,n,t)=>{t.r(n),t.d(n,{HomeComponent:()=>r});var e=t(9468),l=t(9962),i=t(594);let r=(()=>{class o{constructor(a,s,c){this.loginService=a,this.router=s,this.activatedRoute=c,this.accessToken=localStorage.getItem("access_token"),this.accessTokenDetails={id:"?",name:"Test",email:"test@email.com"}}ngOnInit(){}logout(){this.loginService.logout().subscribe(()=>{localStorage.removeItem("access_token"),this.router.navigate(["/login"])})}static#e=this.\u0275fac=function(s){return new(s||o)(e.Y36(l.r),e.Y36(i.F0),e.Y36(i.gz))};static#t=this.\u0275cmp=e.Xpm({type:o,selectors:[["app-home"]],standalone:!0,features:[e.jDz],decls:3,vars:0,template:function(s,c){1&s&&(e.TgZ(0,"div")(1,"h1"),e._uU(2,"Home Page"),e.qZA()())}})}return o})()}}]);