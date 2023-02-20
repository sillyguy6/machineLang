<template>
    <div>

        <!-- <pulse-loader v-if="loading"></pulse-loader> -->
        <!-- <div v-else> -->


            <router-link :to="'/users/' + user_info.id + '/posts'">Posts</router-link>
            <br>

            name : {{ user_info.name }} <br>
            <!-- email : {{ user_info.email }} <br> -->



    </div>
</template>


<script>

export default {
    data() {
        return {
            user_info: {},
            // loading: false,
        }
    },

    created() {
        this.getUser(this.$route.params.id)
    }
    ,
    methods: {

        getUser(id) {
            axios.get('/api/users/' + id)
            .then((response) => {
                this.user_info = response.data

                // this.loading = false
                this.emitEvent()

                // console.log(response.data)
            })
        },

        emitEvent(){
            this.$emit('load-done')
        }
    },

    // beforeRouteEnter(to, from, next) {
    //     console.log('profile enter')
    //     next()
    // },
    beforeRouteUpdate(to, from, next) {
        // console.log('beforeRouteUpdate profile')
        // this.loading = true
        this.getUser(to.params.id)
        next()
    },
    // beforeRouteLeave(to, from, next) {
    //     // console.log('Leave profile to ' + to.path)
    //     this.loading = true

    //     next()

    // },

}
</script>
