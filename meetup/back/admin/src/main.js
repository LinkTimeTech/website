// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'

// 引用API文件
import api from './api/index.js'
// 将API方法绑定到全局
Vue.prototype.$api = api;
// 引用工具文件
import utils from './utils/util.js'
// 将工具方法绑定到全局
Vue.prototype.$utils = utils;

Vue.config.productionTip = true;

// 配置百度编辑器

import '../static/ue/ueditor.config.js'
import '../static/ue/ueditor.all.min.js'
import '../static/ue/lang/zh-cn/zh-cn.js'
import '../static/ue/ueditor.parse.min.js'

// import 'jquery'
import $ from 'jquery'

// import 'bootstrap'
import '../static/css/bootstrap.min.css'
import '../static/js/bootstrap.min.js'

// import '模板的js'
import '../static/js/minimal.js'

// import 'icon'
import '../static/css/font-awesome.min.css'

// import 'menu'
// import '../static/css/jquery.mmenu.all.css'
// import '../static/js/jquery.mmenu.min.js'

//axios
import axios from 'axios'
Vue.prototype.$http = axios;

//QS
import Qs from 'qs'


//测试环境：
Vue.prototype.$http.defaults.baseURL = 'http://192.168.50.119:8080/omise/';


// 正式环境：
// Vue.prototype.$http.defaults.baseURL = 'https://api.baoming.in/omise/';
// Vue.prototype.$http.defaults.withCredentials = true   //设置cookies

// http response 服务器响应拦截器，这里拦截401错误，并重新跳入登页重新获取token
// axios.interceptors.response.use(
//   response => {
//     return response;
//   },
//   error => {
//     if (error.response) {
//       switch (error.response.status) {
//         case 401:
//           // 这里写清除token的代码
//           router.replace({
//             path: '/login',
//             query: { redirect: router.currentRoute.fullPath } //登录成功后跳入浏览的当前页面
//           })
//       }
//     }
//     return Promise.reject(error.response.data)
//   });


/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  template: '<App/>',
  components: {App},
  // data: {
  //   // 空的实例放到根组件下，所有的子组件都能调用
  //   Bus: new Vue()
  // }
});
