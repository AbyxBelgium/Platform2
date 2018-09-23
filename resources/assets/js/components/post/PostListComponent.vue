<template>
    <div>
        <md-table>
            <md-table-row>
                <md-table-head>Title</md-table-head>
                <md-table-head>Category</md-table-head>
                <md-table-head>Actions</md-table-head>
            </md-table-row>
            <md-table-row v-for="post in posts" :key="post.id">
                <md-table-cell>
                    {{ post.title }}
                </md-table-cell>
                <md-table-cell>
                    {{ post.category_id }}
                </md-table-cell>
                <md-table-cell>
                    <md-button class="md-icon-button md-raised md-accent">
                        <md-icon>delete</md-icon>
                    </md-button>
                    <md-button class="md-icon-button md-raised md-accent">
                        <md-icon>edit</md-icon>
                    </md-button>
                    <md-button class="md-icon-button md-raised md-accent">
                        <md-icon>visibility</md-icon>
                    </md-button>
                </md-table-cell>
            </md-table-row>
        </md-table>
        <div class="page-control">
            <md-button class="md-icon-button md-raised md-primary">
                <md-icon>skip_previous</md-icon>
            </md-button>
            <md-button class="md-icon-button md-raised md-primary">
                <md-icon>keyboard_arrow_left</md-icon>
            </md-button>
            <p>Page 1 of 1</p>
            <md-button class="md-icon-button md-raised md-primary">
                <md-icon>keyboard_arrow_right</md-icon>
            </md-button>
            <md-button class="md-icon-button md-raised md-primary">
                <md-icon>skip_next</md-icon>
            </md-button>
        </div>
    </div>
</template>

<script>
    import * as axios from "axios"

    export default {
        name: "PostListComponent",
        data() {
            return {
                posts: []
            }
        },
        methods: {
            loadPosts(page) {
                let config = {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('token')
                    }
                };

                axios.get('/api/posts?page=' + page, config)
                    .then(response => {
                        this.posts = response.data.data;
                    });
            }
        },
        created: function() {
            this.loadPosts(1);
        }
    }
</script>

<style scoped>
    .page-control {
        text-align: center;
        margin-top: 10px;
    }

    .page-control > p {
        display: inline;
        position: relative;
        top: 11px;
    }
</style>
