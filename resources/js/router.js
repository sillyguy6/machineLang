
import Vue from 'vue'
import VueRouter from 'vue-router'

import Home from './components/Home.vue'
import Memory from './components/Memory.vue'
import Cpu from './components/Cpu.vue'
import Console from './components/Console.vue'


window.Event = new Vue()


Vue.component('memory', Memory);
Vue.component('cpu', Cpu);
Vue.component('console', Console);

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        component: Home
    },


]

const router = new VueRouter({
    routes,
    mode: 'history',
    linkExactActiveClass: 'active',

})
// console.log(router)








window.$router = router
export default router
