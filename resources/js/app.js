
require('./bootstrap');

window.Vue = require('vue');


import App from './components/app';
import router from './router/index'
const app = new Vue({
    el: '#app',
    template: '<App/>',
    components: { App },
    router
});


