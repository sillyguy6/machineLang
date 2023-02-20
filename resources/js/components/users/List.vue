<template>
    <div>

        <pulse-loader v-if="loading"></pulse-loader>
        <div v-else>

            <div class="list-group">
                <div v-for="user in users" class="list-group-item list-group-item-action" aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                        <!-- <h5 class="mb-1">{{ user.name }}</h5> -->
                        <router-link :to="'/users/' + user.id + '/profile'">{{ user.name }}</router-link>
                        <small>Joinned at {{ joinOn(user) }}</small>
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
            users: [],
            loading: true,
        }
    },
    created() {

        axios.get('/api/users')
            .then((response) => {
                this.users = response.data
                this.loading = false
                // console.log(this.users)
            })
    },

    methods: {
        joinOn(user) {
            return moment(user.created_at).fromNow()
        }
    },

    beforeRouteLeave(to, from, next) {
        this.loading = true
        next()
    },
}
</script>
