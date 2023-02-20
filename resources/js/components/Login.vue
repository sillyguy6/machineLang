<template>
    <div class="row">




        <pulse-loader v-if="loading"></pulse-loader>
        <div class="col" v-else>
            <h3>Login</h3>
            <div v-show="msg" class="bg-danger">{{ msg }}</div>
            <form>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" v-model="form.email" class="form-control" />

                    <label class="form-label">Password</label>
                    <input type="text" v-model="form.password" class="form-control" />

                    <div>{{ error }}</div>

                </div>

                <pulse-loader v-if="loading"></pulse-loader>
                <button v-else v-on:click="login" class="btn btn-primary" type="button">Login</button>

            </form>
        </div>
    </div>
</template>


<script>
export default {
    data() {
        return {
            form: {
                email: '',
                password: '',

            },
            error: '',
            msg: '',
            loading: false,
            IsLoginSuccess: false
        }
    }
    ,
    methods: {
        login() {
            // if(this.IsLoginSuccess) return
            this.loading = true

            mGlobal.login(this.form, (success, error) => {
                if (success) {
                    this.error = ''
                    this.$router.push({ name: 'account-info' })
                }
                else {
                    this.error = error
                    this.loading = false
                }

            })
        }
    },

    // beforeRouteLeave(to, from, next) {
    //     // if (mGlobal.isRouteRequireAuth(to)) {
    //     //     this.msg = 'you must login first'
    //     // }
    //     // else {
    //     //     this.loading = true
    //     //     next()
    //     // }

    //     console.log('hi')

    //     // this.$router.onError((error) => {
    //     //     console.log('err : ' + error)
    //     // })

    //     next()

    // },


}
</script>
