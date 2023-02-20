<template>
    <div class="row">

        <div class="col-12">
            <form>
                <div class="mb-3">
                    <label class="form-label">Create Post</label>
                    <textarea type="text" v-model="form.body" class="form-control" placeholder="enter"></textarea>
                    <div class="text-danger">{{ error.body }}</div>
                </div>
                <button v-on:click="createPost" class="btn btn-primary" type="button">Create</button>
            </form>
        </div>

        <div class="col-12 mb-5">
            <h2>your posts</h2>

            <div class="list-group">
                <div v-for="post in posts" class="list-group-item list-group-item-action" aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                        <!-- <h5 class="mb-1">{{ post.body }}</h5> -->
                        <router-link :to="detailRoute(post.id)">{{ post.body }}</router-link>
                        <!-- <div>{{ post.body }}</div> -->

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
            form: {
                body: ''
            },
            error: {}
        }
    },
    created() {

        // this.getPosts(this.$route.params.id)
        mGlobal.getMyPosts((posts) => {
            this.posts = posts
            this.$emit('load-done')
        })

    },

    methods: {
        joinOn(post) {
            return moment(post.created_at).fromNow()
        },

        detailRoute(postId) {
            return '/my-profile/posts/' + postId + '/detail'
        },


        createPost() {
            this.$emit('load-start')


            mGlobal.createPost(this.form, (success, error) => {
                if (success) {
                    this.error = {}
                    mGlobal.getMyPosts((posts) => {
                        this.posts = posts
                        this.$emit('load-done')
                    })
                    this.form.body = ''
                }
                else {
                    this.error = error
                    this.$emit('load-done')
                }

            })


        }
    },


}
</script>
