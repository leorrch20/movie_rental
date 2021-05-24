require('./bootstrap');

import Vue from "vue";
import Form from 'vform'
import { HasError, AlertError } from 'vform/src/components/bootstrap5';
import VueProgressBar from 'vue-progressbar';
import VueRouter from "vue-router";
import router from "./routes";
import Swal from 'sweetalert2';
import App from './App.vue';
import axios from 'axios';

// Form validation server side
window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

// Progressbar
Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '2px'
})

// Swal
window.swal = Swal;
const Toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

window.toast = Toast;

// Router
Vue.use(VueRouter);

window.Fire = new Vue();

axios.defaults.withCredentials = true

const app = new Vue({
    el: '#app',
    router,
    render: h =>h(App)
});
