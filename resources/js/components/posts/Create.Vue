<template>
    <div class="row">






        <div class="col-6">
            <form>
                <div class="mb-3">
                    <label class="form-label">Body</label>
                    <textarea type="text" v-model="body" class="form-control"></textarea>

                </div>
                <button v-on:click="addPost" class="btn btn-primary" type="button">Add</button>
            </form>
        </div>



    </div>
</template>


<script>
export default {
    data() {
        return {
            body: '',
        };
    },

    methods: {
        addPost() {
            if(this.body.length < 10){
                return
            }
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/api/posts/create',{
                    'body' : this.body
                }).then((response) => {
                    // console.log(response.data);
                    if(response.data == 1){
                        this.body = ''
                    }

                })
            })
        },

        deletePost(index) {
            // console.log(index)
            // this.posts.splice(index, 1);
        },
    },


};
</script>
