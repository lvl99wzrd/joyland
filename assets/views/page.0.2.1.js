(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["page"],{2048:function(t,e,a){"use strict";a.r(e);var s=function(){var t=this,e=t._self._c;return e("div",{attrs:{id:"page"}},[t.loading?t._e():e("div",{staticClass:"page",style:{color:t.page.style.color,backgroundColor:t.page.style.bg_color}},[e("div",{staticClass:"max-w-xl mx-auto py-16"},[t.page.hide_title?t._e():e("h1",{staticClass:"page-title",domProps:{innerHTML:t._s(t.page.title)}}),e("div",{staticClass:"content",domProps:{innerHTML:t._s(t.page.content)}})])])])},i=[],o={name:"Page",data(){return{loading:!1,page:!1}},watch:{$route:function(){this.getPage()}},created(){this.getPage()},methods:{getPage(){this.loading=!0,this.appAxios({method:"get",url:this.app.rest.wp+"/pages",params:{slug:this.$route.params.slug,app:!0}}).then(t=>{this.page=t.data[0],this.setPageTitle(this.page.title)}).catch(t=>{console.log(t.response)}).finally(()=>{this.loading=!1})}}},n=o,l=(a("6ba7"),a("2877")),p=Object(l["a"])(n,s,i,!1,null,"4d9bdf64",null);e["default"]=p.exports},"6ba7":function(t,e,a){"use strict";a("d15d")},d15d:function(t,e,a){}}]);
//# sourceMappingURL=page.0.2.1.js.map