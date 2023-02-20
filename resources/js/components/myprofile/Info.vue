<template>
    <div>

        <!-- <pulse-loader v-if="loading"></pulse-loader> -->


        <!-- <div v-if="!loading"> -->


        <!-- <router-link :to="'/users/' + user_info.id + '/posts'">Posts</router-link> -->
        <router-link :to="{ name: 'my-posts-list' }">Posts</router-link>
        <br>

        name : {{ user_info.name }} <br>
        email : {{ user_info.email }} <br>

        <button v-on:click="logout" class="btn btn-danger">Logout</button>



    </div>
</template>


<script>
export default {
    data() {
        return {
            user_info: {},
            // loading: true,
        }
    },

    created() {
        // this.getUser(this.$route.params.id)
        mGlobal.user(user => {
            this.user_info = user
            // this.loading = false

            this.$emit('load-done')
        })
    }
    ,
    methods: {
        logout() {

            this.$emit('load-start')
            window.mGlobal.logout(this.$router)
            // this.loading = true

        },




    },

    beforeRouteLeave(to, from, next) {
        console.log('info leave')
        next()
    }



}
</script>
