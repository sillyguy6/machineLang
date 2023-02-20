<template>
    <div>

        <pulse-loader v-if="loading"></pulse-loader>

        <div v-show="msg" class="bg-danger">{{ msg }}</div>

        <div v-show="!loading">
            <router-view @load-done="loadDone" @load-start="loadStart"></router-view>
        </div>


    </div>
</template>


<script>
export default {
    data() {
        return {
            loading: true,
            msg: ''
        }
    },
    methods: {
        loadDone(){
            this.loading = false
            // console.log(e)
        },
        loadStart(){
            this.loading = true
            // console.log(e)
        }
    },

    beforeRouteUpdate(to, from, next) {
        this.loading = true
        next()
    },

    beforeRouteLeave(to, from, next) {
        // console.log('myprofile leave')

        this.loading = true

        if(mGlobal.isLoginOrRegister(to)){

            mGlobal.isAuth((isAuth, user) => {
                if(isAuth){
                    // if(from.name == 'account-info'){
                    //     next(false)
                    //     this.loading = false
                    // }
                    // else{
                    //     next({name: 'account-info'})
                    // }
                    this.msg = 'already login'
                    this.loading = false
                    next(false)

                }
                else{
                    next()
                }
            })

        }
        else{
            next()
        }

    },

}
</script>
