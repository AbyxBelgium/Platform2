<template>
    <div>
        <md-toolbar class="md-primary" md-elevation="1">
            <h3 class="md-title" style="flex: 1">Backend</h3>
            <md-button>Refresh</md-button>
            <md-button>Create</md-button>
        </md-toolbar>
        <div class="page-content">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AppComponent"
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
