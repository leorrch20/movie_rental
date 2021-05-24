<template>
    <div class="wrapper">
        <Navbar v-if="!['login', 'register', 'help'].includes($route.name)"></Navbar>
        <Sidebar v-if="!['login', 'register', 'help'].includes($route.name)"></Sidebar>
        <div :class="{'content-wrapper': !['login', 'register', 'help'].includes($route.name)}">
            <router-view></router-view>
            <!-- set progressbar -->
            <vue-progress-bar></vue-progress-bar>
        </div>
        <Footer v-if="!['login', 'register', 'help'].includes($route.name)"></Footer>
    </div>
</template>

<script>

import Navbar from "./components/Navbar";
import Sidebar from "./components/Sidebar";
import Footer from "./components/Footer";

export default {
    name: "App",
    components: {
        Navbar,
        Sidebar,
        Footer
    },
    data(){
        return {
            authenticated: false
        }
    },
    mounted() {
        if(!this.authenticated && this.$router.currentRoute.name !== 'login') {
            this.$router.replace({ name: "login" });
        }
    },
    methods: {
        setAuthenticated(status) {
            this.authenticated = status;
        },
        logout() {
            this.authenticated = false;
        }
    }
}
</script>

<style scoped>

</style>
