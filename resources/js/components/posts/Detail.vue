<template>
    <div>
        <pulse-loader v-if="loading"></pulse-loader>
        <div v-else>
            <h2>{{ user.name }}</h2>
            <h5 class="mb-1">{{ post.body }}</h5>
            <small>Posted on {{ joinOn(post) }}</small>

        </div>
    </div>
</template>


<script>
import moment from "moment";

export default {
    data() {
        return {
            post: {},
            user: {},
            loading: false,
        };
    },
    created() {
        this.getPost(this.$route.params.postId)
    },

    methods: {
        joinOn(post) {
            return moment(post.created_at).fromNow();
        },
        getPost(id) {
            axios.get("/api/posts/" + id).then((response) => {
                this.post = response.data;
                this.user = this.post.user
                // this.loading = false;

                this.$parent.$emit('load-done')

                // console.log(response.data)
            });
        },
    },

    beforeRouteUpdate(to, from, next) {
        // console.log('beforeRouteUpdate profile')
        // this.loading = true;
        this.getPost(to.params.postId)
        next();
    },

    // beforeRouteLeave(to, from, next) {
        // this.loading = true;
    //     next();
    // },
};
</script>
