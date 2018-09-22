<template>
    <md-table>
        <md-table-row>
            <md-table-head>Title</md-table-head>
            <md-table-head>Category</md-table-head>
            <md-table-head>Actions</md-table-head>
        </md-table-row>
        <md-table-row v-for="post in posts" :key="post.id">
            <md-table-cell>{{ post.title }}</md-table-cell>
            <md-table-cell></md-table-cell>
            <md-table-cell></md-table-cell>
        </md-table-row>
    </md-table>
</template>

<script>
    import * as axios from "axios"

    export default {
        name: "PostListComponent",
        data() {
            return {
                posts: [{
                    title: 'DIT IS EEN TITEL!',
                    id: 7
                }]
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
                        this.posts = response.data.posts.data;
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
