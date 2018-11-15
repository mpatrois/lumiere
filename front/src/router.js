import Vue from 'vue';
import Router from 'vue-router';
import Uploader from "./views/Uploader/Uploader.vue";
import ListVideos from "./views/ListVideos/ListVideos.vue";
import NotFound from "./views/404NotFound.vue";
import Login from "./views/Login.vue";
import App from "./App.vue";
import axios from 'axios';

Vue.use(Router);

function checkAuth(to, from, next) {
  axios.get('/api/user').then((response) => {
    if (response.data === '') {
      // console.log(to);
      next('/login?redirectUrl='+to.name);
    } else {
      next();
    }
  });
}

function redirectIfAuth(to, from, next) {
  axios.get('/api/user').then((response) => {
    if (response.data === '') {
      next();
    } else {
      next('/');
    }
  });
}

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    // {
    //   path: '/',
    //   name: 'app',
    //   // route level code-splitting
    //   // this generates a separate chunk (about.[hash].js) for this route
    //   // which is lazy-loaded when the route is visited.
    //   component: () => App,
    // },
    {
      path: '/',
      name: 'home',
      component: ListVideos
    },
    {
      path: '/404',
      name: 'errorPage',
      component: NotFound
    },
    {
      path: '*',
      redirect: '/404'
    },
    {
      beforeEnter: checkAuth,
      path: '/upload',
      name: 'upload',
      component: Uploader
    },
    {
      beforeEnter: redirectIfAuth,
      path: '/login',
      name: 'login',
      component: Login
    },
  ],
});
