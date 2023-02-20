<template>
    <div>

        <pulse-loader v-if="loading"></pulse-loader>
        <div v-else>

            <h2>{{ user.name }}'s posts</h2>

            <div class="list-group">
                <div v-for="post in posts" class="list-group-item list-group-item-action" aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                        <!-- <h5 class="mb-1">{{ post.body }}</h5> -->
                        <router-link :to="detailRoute(post.id)">{{ post.body }}</router-link>
                        <!-- <router-link :to=" '/posts/' + post.id + '/detail' ">{{ post.body }}</router-link> -->
                        <small>Posted on {{ joinOn(post) }}</small>
                    </div>
                </div>
            </div>

        </div>


    </div>
</template>


<script>

import moment from 'moment'

export default {
    data() {
        return {
            posts: [],
            user: {},
            loading: false,
        }
    },
    created() {

        this.getPosts(this.$route.params.id)
    },
    computed: {
        // ready(){
        //     return this.gotUser && this.gotPosts
        // }
    },

    methods: {
        joinOn(post) {
            return moment(post.created_at).fromNow()
        },

        detailRoute(postId) {
            return '/users/' + this.$route.params.id + '/posts/' + postId + '/detail'
        },

        getPosts(id) {
            axios.get('/api/users/' + id)
                .then((response) => {
                    this.user = response.data
                    this.posts = this.user.posts
                    this.$emit('load-done')
                    // this.loading = false
                })
        },
    },

    beforeRouteUpdate(to, from, next) {
        // console.log('beforeRouteUpdate profile')
        // this.loading = true;
        this.getPosts(to.params.id)
        next();
    },

    // beforeRouteLeave(to, from, next) {
    //     // this.loading = true;
    //     next();
    // },
}
</script>
