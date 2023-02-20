<template>
    <div>





        <!-- <pulse-loader v-if="loading"></pulse-loader>
        <div v-else>
            <router-view @load-done="loadDone"></router-view>
        </div> -->


        <pulse-loader v-if="loading"></pulse-loader>

        <div v-show="!loading">
            <router-view @load-done="loadDone"></router-view>
        </div>






    </div>
</template>


<script>
export default {
    data() {
        return {
            loading: true,
        };
    },

    methods: {
        loadDone(){
            this.loading = false
            // console.log(e)
        }
    },

    created() {
        // console.log(this.$route.params)
    },


    beforeRouteUpdate(to, from, next) {
        this.loading = true
        next()
    },

    beforeRouteLeave(to, from, next) {
        this.loading = true
        next()

    },


};
</script>
