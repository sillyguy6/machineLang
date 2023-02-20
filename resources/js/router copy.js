
import Vue from 'vue'
import VueRouter from 'vue-router'
// import Tool from './components/Tool.vue'
import About from './components/About.vue'
import Login from '../components/Login.vue'
import Register from '../components/Register.vue'
import Home from '../components/Home.vue'

import MyProfile from '../components/myprofile/MyProfile.vue'
import MyPostList from '../components/myprofile/post/List.vue'
import MyPost from '../components/myprofile/post/Post.vue'
import MyPostDetail from '../components/myprofile/post/Detail.vue'
import MyPostEdit from '../components/myprofile/post/Edit.vue'
import Info from '../components/myprofile/Info.vue'




// import Create from '../components/posts/Create.vue'
import Post from '../components/posts/Post.vue'
import UserPostsList from '../components/posts/UserPosts.vue'
import PostDetail from '../components/posts/Detail.vue'


import User from '../components/users/User.vue'
import UsersList from '../components/users/List.vue'
import UserProfile from '../components/users/Profile.vue'
import PulseLoader from 'vue-spinner/src/PulseLoader.vue'
// import ScaleLoader from 'vue-spinner/src/ScaleLoader.vue'

import mGlobal from './global.js'
import moment from "moment";


window.mGlobal = mGlobal
window.moment = moment

Vue.component('pulse-loader', PulseLoader);
// Vue.component('scale-loader', ScaleLoader);





Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        component: Home
    },
    {
        path: '/users',
        component: UsersList,
        meta: { requiresAuth: true },
    },
    {
        path: '/users/:id',
        component: User,
        meta: { requiresAuth: true },

        children: [
            {
                path: 'profile',
                component: UserProfile,
            },
            {
                path: 'posts',
                component: UserPostsList,

            },
            {
                path: 'posts/:postId',
                component: Post,
                children: [
                    {
                        path: 'detail',
                        component: PostDetail
                    }
                ]
            }
        ]
    },
    // {
    //     path: '/tool',
    //     component: Tool
    // },
    {
        path: '/about',
        component: About,
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
    },
    {
        path: '/my-profile',
        component: MyProfile,

        meta: { requiresAuth: true },
        children: [
            {
                path: 'info',
                name: 'account-info',
                component: Info,
            },
            {
                path: 'posts',
                name: 'my-posts-list',
                component: MyPostList,
            },
            {
                path: 'posts/:postId',
                component: MyPost,
                children: [
                    {
                        path: 'detail',
                        name: 'my-post-detail',
                        component: MyPostDetail
                    },
                    {
                        path: 'edit',
                        name: 'my-post-edit',
                        component: MyPostEdit
                    },
                ]
            },
        ]

    },

]

const router = new VueRouter({
    routes,
    mode: 'history',
    linkExactActiveClass: 'active',

})
// console.log(router)







router.beforeEach((to, from, next) => {
    console.log('global')
    let islr = mGlobal.isLoginOrRegister(to)

    if(mGlobal.isRouteRequireAuth(to) || islr){
        // console.log('check auth')
        mGlobal.isAuth(function (isAuth, user) {
            if (isAuth) {
                if (islr) {
                    next({ name : 'account-info' })
                }
                else {
                    next()
                }
            }
            else {
                if(islr){
                    next()
                }
                else{
                    // if(from.name == 'login'){
                    //     next(new Error('duplicate'))
                    // }
                    // else{
                    //     next({ name: 'login' })
                    // }

                    next({ name: 'login' })

                }

            }
        })
    }
    else {
        next()
    }

})


// router.onError((error) => {
//     console.log('error : ' + error)
// })

window.$router = router
export default router
