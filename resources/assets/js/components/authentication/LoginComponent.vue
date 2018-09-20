<template>
    <div class="md-layout">
        <div class="md-layout-item md-medium-size-33 md-small-100">
            <img id="platform-logo" src="/graphics/platform-logo.svg" />
        </div>
        <div class="md-layout-item md-medium-size-67 md-small-size-100">
            <span class="md-title">
                <h1>Sign in:</h1>
            </span>
        </div>
    </div>
</template>

<script>
    export default {
        name: "LoginComponent"
    }
</script>

<style scoped>
    #platform-logo {
        width: 200px;
        display: block;
        margin: auto;
    }
</style>
