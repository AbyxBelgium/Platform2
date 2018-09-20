<template>
    <div>
        <md-badge :md-content="users" class="md-accent">
            <md-icon title="Registered users" class="md-size-2x">account_box</md-icon>
        </md-badge>
        <md-badge :md-content="posts" class="md-accent">
            <md-icon title="Total posts" class="md-size-2x">mode_comment</md-icon>
        </md-badge>
        <md-badge :md-content="categories" class="md-accent">
            <md-icon title="Categories" class="md-size-2x">toc</md-icon>
        </md-badge>
        <md-badge md-content="2.0" class="md-accent">
            <md-icon title="Platform version" class="md-size-2x">update</md-icon>
        </md-badge>
        <md-badge :md-content="memory" class="md-accent">
            <md-icon title="Memory usage" class="md-size-2x">memory</md-icon>
        </md-badge>
        <md-badge :md-content="storage" class="md-accent">
            <md-icon title="Storage usage" class="md-size-2x">storage</md-icon>
        </md-badge>
        <md-badge :md-content="cpu" class="md-accent">
            <md-icon title="Current CPU load" class="md-size-2x">settings</md-icon>
        </md-badge>
    </div>
</template>

<script>
    import * as axios from "axios";

    export default {
        name: 'ResourceMonitorComponent',
        props: ['users', 'posts', 'categories', 'refreshRate'],
        data() {
            return {
                memory: "0%",
                storage: "0%",
                cpu: "0%",
                loaded: false,
                interval: undefined
            }
        },
        created: function() {
            this.interval = setInterval(this.updateResources, this.refreshRate);
        },
        methods: {
            updateResources() {
                let config = {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('token')
                    }
                };

                axios.get("/api/system-resources", config)
                    .then(response => {
                        this.loaded = true;
                        this.memory = response.data.memory + "%";
                        this.storage = response.data.storage + "%";
                        this.cpu = response.data.cpu + "%";
                    });
            }
        },
        beforeDestroy: function(){
            if (this.interval) {
                clearTimeout(this.interval);
            }
        }
    }
</script>

<style scoped>
</style>
