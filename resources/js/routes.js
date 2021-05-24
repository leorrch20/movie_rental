import Vue from "vue";
import VueRouter from "vue-router";

const router = new VueRouter({
    history,
    routes: [
        { path: '/', name: 'dashboard', component: require('./components/Dashboard.vue').default },
        { path: '/login', name: 'login', component: require('./views/pages/Login.vue').default },
        { path: '/users', name: 'users', component: require('./components/Users.vue').default },
    ]
});

export default router;
