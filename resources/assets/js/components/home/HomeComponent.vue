<template>
    <md-card>
        <md-card-content>
            <resource-monitor-component class="resource-monitor" users="1" posts="1" categories="1" refresh-rate="2000"></resource-monitor-component>
            <resource-graph-component refresh-rate="2000" steps="20"></resource-graph-component>
        </md-card-content>
    </md-card>
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
    .resource-monitor {
        text-align: center;
    }
</style>
