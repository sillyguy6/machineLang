<template>
    <div class="row">

        <div class="col-12">
            <form>
                <div class="mb-3">
                    <label class="form-label">Edit</label>
                    <textarea type="text" v-model="form.body" class="form-control" placeholder="enter"></textarea>
                    <div class="text-danger">{{ error.body }}</div>
                </div>
                <button v-on:click="save" class="btn btn-primary" type="button">Save</button>
            </form>
        </div>




    </div>
</template>


<script>


export default {
    data() {
        return {
            post: {},
            user: {},
            form: {
                body: ''
            },
            error: {},
            log: ''
        }
    },
    created() {

        // this.getPosts(this.$route.params.id)
        mGlobal.getPost(this.$route.params.postId, (post) => {
            this.post = post
            this.user = post.user
            this.form.body = post.body
            this.$parent.$emit('load-done')
        })

    },

    methods: {
        joinOn(post) {
            return mGlobal.joinOn(post)
        },


        save() {
            this.$parent.$emit('load-start')

            mGlobal.updatePost(this.$route.params.postId, this.form, (success, error) => {
                if(success){
                    // this.error = {}
                    // this.log = 'success'
                    this.$router.push({
                        name: 'my-post-detail',
                        params: { postId: this.$route.params.postId }
                    })
                    // this.form.body = ''
                }
                else {
                    this.error = error
                    // this.log = ''
                    this.$parent.$emit('load-done')
                }
            })


        }
    },


}
</script>
