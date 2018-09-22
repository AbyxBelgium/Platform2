<template>
    <div>
        <md-card>
            <md-card-content>
                <resource-monitor-component class="resource-monitor" users="1" posts="1" categories="1" refresh-rate="3000"></resource-monitor-component>
                <resource-graph-component refresh-rate="3000" steps="20"></resource-graph-component>
            </md-card-content>
        </md-card>
        <md-card>
            <md-card-header>
                <h1>Recent posts</h1>
            </md-card-header>
            <md-card-content>
                <post-list-component></post-list-component>
            </md-card-content>
        </md-card>
    </div>
</template>

<script>
    import ResourceMonitorComponent from "../resource/ResourceMonitorComponent";
    import ResourceGraphComponent from "../resource/ResourceGraphComponent";
    import PostListComponent from "../post/PostListComponent";

    export default {
        name: "HomeComponent",
        components: {PostListComponent, ResourceGraphComponent, ResourceMonitorComponent}
    }
</script>

<style scoped>
    .resource-monitor {
        text-align: center;
    }

    .md-card {
        margin-bottom: 10px;
    }
</style>
