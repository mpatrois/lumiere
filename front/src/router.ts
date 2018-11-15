import Vue from 'vue';
import Router from 'vue-router';
import Uploader from "./views/Uploader/Uploader.vue";
import ListVideos from "./views/ListVideos/ListVideos.vue";
import NotFound from "./views/404NotFound.vue";

Vue.use(Router);

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/upload',
      name: 'upload',
      component: Uploader
    },
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
    }
  ],
});
