<template>
    <div>
        <h2>{{ user.name }}</h2>
        <h5 class="mb-1">{{ post.body }}</h5>
        <!-- <button class="btn btn-success" v-on:click="edit">edit</button> -->

        <router-link class="btn btn-success" :to="{ name: 'my-post-edit', params: { postId: $route.params.postId } }">Edit</router-link>
        <button class="btn btn-danger" v-on:click="deletePost">delete</button>
        <small>Posted on {{ joinOn(post) }}</small>

    </div>
</template>


<script>

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

        getPost(id) {
            mGlobal.getPost(id, (post) => {
                if(post){
                    this.post = post;
                    this.user = this.post.user
                }
                this.$parent.$emit('load-done')
            })
        },

        deletePost(){
            this.$parent.$emit('load-start')
            mGlobal.deletePost(this.$route.params.postId, (data) => {
                if(data == 1){
                    this.$router.push({ name: 'my-posts-list' })
                }else{
                    console.log("can't delete post")
                    this.$parent.$emit('load-done')
                }
            })
        },

        joinOn(post){
            return mGlobal.joinOn(post)
        }
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
