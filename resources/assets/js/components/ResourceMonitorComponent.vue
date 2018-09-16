<template>
    <div class="mdl-cell mdl-cell--12-col statistics">
        <div title="Registered users" class="material-icons mdl-badge mdl-badge--overlap statistic-badge" :data-badge="users">account_box</div>
        <div title="Total posts" class="material-icons mdl-badge mdl-badge--overlap statistic-badge" :data-badge="posts">mode_comment</div>
        <div title="Categories" class="material-icons mdl-badge mdl-badge--overlap statistic-badge" :data-badge="categories">toc</div>
        <div title="Platform version" class="material-icons mdl-badge mdl-badge--overlap statistic-badge" data-badge="1.4">update</div>
        <div title="Memory usage" class="material-icons mdl-badge mdl-badge--overlap statistic-badge inactive-badge" id="mem-badge" :data-badge="memory">memory</div>
        <div title="Storage usage" class="material-icons mdl-badge mdl-badge--overlap statistic-badge inactive-badge" id="storage-badge" :data-badge="storage">storage</div>
        <div title="Current CPU load" class="material-icons mdl-badge mdl-badge--overlap statistic-badge inactive-badge" id="cpu-badge" :data-badge="cpu">settings_applications</div>
    </div>
</template>

<script>
    import * as axios from "axios";

    export default {
        props: ['users', 'posts', 'categories', 'token', 'refreshRate'],
        data() {
            return {
                memory: "0%",
                storage: "0%",
                cpu: "0%"
            }
        },
        created: function() {
            setInterval(this.updateResources, this.refreshRate);
        },
        methods: {
            updateResources() {
                let config = {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + this.token
                    }
                };

                axios.get("/api/system-resources", config)
                    .then(response => {
                        this.memory = response.data.memory + "%";
                        this.storage = response.data.storage + "%";
                        this.cpu = response.data.cpu + "%";
                    });
            }
        }
    }
</script>

<style scoped>

</style>
