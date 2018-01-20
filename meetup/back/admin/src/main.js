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
// import '../static/js/jquery-3.2.1.min.js'
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

// import 'nicescroll'
import '../static/js/jquery.nicescroll.min.js'

import axios from 'axios'

Vue.prototype.$http = axios;
Vue.prototype.$http.defaults.baseURL = 'https://edcon.io/tp/public/index.php/admin/edcon/';

//vue-dragging 拖拽表格
// import VueDND from 'awe-dnd'
// Vue.use(VueDND)


/* eslint-disable no-new */
new Vue({
    el: '#app',
    router,
    template: '<App/>',
    components: {App}
});
