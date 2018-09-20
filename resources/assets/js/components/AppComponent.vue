<template>
    <div>
        <md-toolbar class="md-primary" md-elevation="1">
            <h3 class="md-title" style="flex: 1">Backend</h3>
            <md-button>Refresh</md-button>
            <md-button>Create</md-button>
        </md-toolbar>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        name: "AppComponent"
    }
</script>

<style scoped>

</style>
