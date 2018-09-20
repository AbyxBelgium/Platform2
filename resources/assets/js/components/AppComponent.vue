<template>
    <div>
        <md-toolbar class="md-primary" md-elevation="1">
            <h3 class="md-title" style="flex: 1">Backend</h3>
            <md-button @click="logout">Logout</md-button>
        </md-toolbar>
        <div class="page-content">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AppComponent",
        methods: {
            logout() {
                this.$store.dispatch('logout').then(() => this.$router.push('/login'));
            }
        }
    }
</script>

<style scoped>
    .page-content {
        margin: auto;
        max-width: 1400px;
        padding-top: 20px;
        padding-left: 30px;
        padding-right: 30px;
    }
</style>
