webpackJsonp([12],{NHnr:function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var a=n("7+uW"),i=n("XyMi");var o=function(t){n("utkq")},l=Object(i.a)(null,function(){var t=this.$createElement,e=this._self._c||t;return e("div",{attrs:{id:"app"}},[e("router-view")],1)},[],!1,o,null,null).exports,r=n("/ocq");a.default.use(r.a);var u=new r.a({routes:[{path:"/",redirect:"/dashboard"},{path:"/",component:function(t){return Promise.all([n.e(0),n.e(3)]).then(function(){var e=[n("MpTN")];t.apply(null,e)}.bind(this)).catch(n.oe)},meta:{title:"自述文件"},children:[{path:"/dashboard",component:function(t){return Promise.all([n.e(0),n.e(4)]).then(function(){var e=[n("a52u")];t.apply(null,e)}.bind(this)).catch(n.oe)},meta:{title:"系统首页"}},{path:"/data_cat/show",component:function(t){return Promise.all([n.e(0),n.e(5)]).then(function(){var e=[n("MdWd")];t.apply(null,e)}.bind(this)).catch(n.oe)},children:[{path:"type/1",meta:{title:"分类列表"}}]},{path:"/data/show",component:function(t){return Promise.all([n.e(0),n.e(1)]).then(function(){var e=[n("Dt3m")];t.apply(null,e)}.bind(this)).catch(n.oe)},children:[{path:"type/1",meta:{title:"产品列表"}},{path:"type/2",meta:{title:"新闻列表"}}]},{path:"/art_single/get",component:function(t){return Promise.all([n.e(0),n.e(2)]).then(function(){var e=[n("qSSH")];t.apply(null,e)}.bind(this)).catch(n.oe)},children:[{path:"1",meta:{title:"关于我们"}},{path:"2",meta:{title:"公司简介"}},{path:"3",meta:{title:"人才招聘"}},{path:"4",meta:{title:"解决方案"}},{path:"5",meta:{title:"联系我们"}},{path:"6",meta:{title:"联系我们(首页)"}},{path:"7",meta:{title:"联系我们(内页)"}},{path:"8",meta:{title:"页脚部分"}}]},{path:"/user/show",component:function(t){return Promise.all([n.e(0),n.e(7)]).then(function(){var e=[n("jgEq")];t.apply(null,e)}.bind(this)).catch(n.oe)},meta:{title:"用户列表"}},{path:"/user/updatepwd",component:function(t){return Promise.all([n.e(0),n.e(9)]).then(function(){var e=[n("hRaF")];t.apply(null,e)}.bind(this)).catch(n.oe)},meta:{title:"修改密码"}},{path:"/404",component:function(t){return Promise.all([n.e(0),n.e(8)]).then(function(){var e=[n("3bH0")];t.apply(null,e)}.bind(this)).catch(n.oe)},meta:{title:"404"}},{path:"/403",component:function(t){return Promise.all([n.e(0),n.e(6)]).then(function(){var e=[n("KfZE")];t.apply(null,e)}.bind(this)).catch(n.oe)},meta:{title:"403"}}]},{path:"/login",component:function(t){return Promise.all([n.e(0),n.e(10)]).then(function(){var e=[n("GF4k")];t.apply(null,e)}.bind(this)).catch(n.oe)}},{path:"*",redirect:"/404"}]}),c=n("mtWM"),p=n.n(c),h=n("zL8q"),m=n.n(h);n("tvR6"),n("ympj"),n("j1ja");a.default.use(m.a,{size:"small"}),a.default.prototype.$axios=p.a,u.beforeEach(function(t,e,n){localStorage.getItem("user_id")||"/login"===t.path?navigator.userAgent.indexOf("MSIE")>-1&&"/editor"===t.path?a.default.prototype.$alert("vue-quill-editor组件不兼容IE10及以下浏览器，请使用更高版本的浏览器查看","浏览器不兼容通知",{confirmButtonText:"确定"}):n():n("/login")}),new a.default({router:u,render:function(t){return t(l)}}).$mount("#app")},tvR6:function(t,e){},utkq:function(t,e){},ympj:function(t,e){}},["NHnr"]);