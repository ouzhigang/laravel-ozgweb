webpackJsonp([10],{GF4k:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var o=r("KKrt"),n={data:function(){return{ruleForm:{name:"",pwd:"",vcode:""},rules:{name:[{required:!0,message:"请输入用户名",trigger:"blur"}],pwd:[{required:!0,message:"请输入密码",trigger:"blur"}]},is_show_vcode:!1,vcode_img:o.a.web_server_root+"index/getvcode"}},created:function(){document.title=o.a.web_title},methods:{submitForm:function(e){var t=this;this.$refs[e].validate(function(e){if(!e)return t.$alert("请正确输入完整信息","提示",{confirmButtonText:"确定",type:"error"}),!1;t.$axios.post(o.a.web_server_root+"index/login",{name:t.ruleForm.name,pwd:t.ruleForm.pwd,vcode:t.ruleForm.vcode}).then(function(e){0==e.data.code?(localStorage.setItem("user_name",e.data.data.name),localStorage.setItem("user_id",e.data.data.id),t.$router.push("/")):2==e.data.code?(t.ruleForm.vcode="",t.is_show_vcode=!0):3==e.data.code?(t.$alert(e.data.msg,"提示",{confirmButtonText:"确定",type:"error"}),t.ruleForm.vcode="",t.$refs.vcode_img.click()):(t.is_show_vcode=!1,t.$alert(e.data.msg,"提示",{confirmButtonText:"确定",type:"error"}))}).catch(function(e){t.$alert(e,"提示",{confirmButtonText:"确定",type:"error"})})})},vcodeUpdate:function(e){e.currentTarget.src=this.vcode_img+"?dt="+Math.random()}}},a=r("XyMi");var l=function(e){r("LC+9")},s=Object(a.a)(n,function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"login-wrap"},[r("div",{staticClass:"ms-login"},[r("div",{staticClass:"ms-title"},[e._v("后台管理系统")]),e._v(" "),r("el-form",{ref:"ruleForm",staticClass:"ms-content",attrs:{model:e.ruleForm,rules:e.rules,"label-width":"0px"}},[r("el-form-item",{attrs:{prop:"name"}},[r("el-input",{attrs:{placeholder:"请输入用户名"},model:{value:e.ruleForm.name,callback:function(t){e.$set(e.ruleForm,"name",t)},expression:"ruleForm.name"}},[r("el-button",{attrs:{slot:"prepend",icon:"el-icon-lx-people"},slot:"prepend"})],1)],1),e._v(" "),r("el-form-item",{attrs:{prop:"pwd"}},[r("el-input",{attrs:{type:"password",placeholder:"请输入密码"},nativeOn:{keyup:function(t){return!t.type.indexOf("key")&&e._k(t.keyCode,"enter",13,t.key,"Enter")?null:e.submitForm("ruleForm")}},model:{value:e.ruleForm.pwd,callback:function(t){e.$set(e.ruleForm,"pwd",t)},expression:"ruleForm.pwd"}},[r("el-button",{attrs:{slot:"prepend",icon:"el-icon-lx-lock"},slot:"prepend"})],1)],1),e._v(" "),r("el-form-item",{directives:[{name:"show",rawName:"v-show",value:e.is_show_vcode,expression:"is_show_vcode"}],attrs:{prop:"vcode"}},[r("el-input",{attrs:{placeholder:"请输入验证码",maxlength:"10"},nativeOn:{keyup:function(t){return!t.type.indexOf("key")&&e._k(t.keyCode,"enter",13,t.key,"Enter")?null:e.submitForm("ruleForm")}},model:{value:e.ruleForm.vcode,callback:function(t){e.$set(e.ruleForm,"vcode",t)},expression:"ruleForm.vcode"}},[r("el-button",{attrs:{slot:"prepend",icon:"el-icon-lx-info"},slot:"prepend"})],1),e._v(" "),e.is_show_vcode?r("img",{ref:"vcode_img",staticClass:"vcode-img",attrs:{src:e.vcode_img},on:{click:function(t){return e.vcodeUpdate(t)}}}):e._e()],1),e._v(" "),r("div",{staticClass:"login-btn"},[r("el-button",{attrs:{type:"primary"},on:{click:function(t){return e.submitForm("ruleForm")}}},[e._v("登录")])],1)],1)],1)])},[],!1,l,"data-v-016f69cc",null);t.default=s.exports},"LC+9":function(e,t){}});