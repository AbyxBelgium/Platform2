<template>
    <list-component>
        <md-table slot="table-content">
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
    </list-component>
</template>

<script>
    import * as axios from "axios"
    import ListComponent from "../list/ListComponent";

    export default {
        name: "PostListComponent",
        components: {ListComponent},
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
</style>
