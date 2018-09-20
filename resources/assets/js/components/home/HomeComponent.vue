<template>
    <div>
        <resource-monitor-component users="1" posts="1" categories="1" refresh-rate="2000"></resource-monitor-component>
        <resource-graph-component refresh-rate="2000" steps="20"></resource-graph-component>
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
