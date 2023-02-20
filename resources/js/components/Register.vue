<template>
    <div class="row">




        <pulse-loader v-if="loading"></pulse-loader>
        <div class="col" v-else>
            <h3>Register</h3>
            <form>
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="email" v-model="form.name" class="form-control" />

                    <label class="form-label">Email</label>
                    <input type="text" v-model="form.email" class="form-control" />

                    <label class="form-label">Password</label>
                    <input type="text" v-model="form.password" class="form-control" />

                    <label class="form-label">Confirm Password</label>
                    <input type="text" v-model="form.password_confirmation" class="form-control" />

                    <div>{{ error }}</div>

                </div>

                <pulse-loader v-if="loading"></pulse-loader>
                <button v-else v-on:click="register" class="btn btn-primary" type="button">Register</button>

            </form>
        </div>
    </div>
</template>


<script>
export default {
    data() {
        return {
            form: {
                name: '',
                email: '',
                password: '',
                password_confirmation: ''

            },
            error: '',
            loading: false,
            IsLoginSuccess: false
        }
    }
    ,
    methods: {
        register() {
            // if(this.IsLoginSuccess) return
            this.loading = true

            mGlobal.register(this.form, (success, error) => {
                if (success) {
                    this.error = ''
                    this.$router.push({ name: 'my-profile' })
                }
                else {
                    this.error = error
                    this.loading = false
                }

            })
        }
    },



}
</script>
