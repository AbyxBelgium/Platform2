<template>
    <div>
        <resource-monitor-component></resource-monitor-component>
        <resource-graph-component></resource-graph-component>
    </div>
</template>

<script>
    import ResourceMonitorComponent from "../resource/ResourceMonitorComponent";
    import ResourceGraphComponent from "../resource/ResourceGraphComponent";

    export default {
        name: "HomeComponent",
        components: {ResourceGraphComponent, ResourceMonitorComponent}
    }
</script>

<style scoped>

</style>
