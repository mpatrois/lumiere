<template>
  <div>
    <h1>LISTVIDEOS View</h1>
    <ul>
      <li v-for="(video,index) in videos" :key="index">
        <router-link :to="`/video/${video.id}`">
          <h2>Title : {{ video.title }}</h2>
          <p>desc : {{ video.description }}</p>
          <img :src="'/api/video/preview/'+video.id">
        </router-link>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'ListVideos',
  data() {
    return {
      videos: [],
    };
  },
  computed: {
    // videoFiltered() {
    //   return this.videos.filter(video => !video.title.includes(this.searchText))
    // }
  },
  created() {
    axios.get('/api/video').then((videos) => {
      this.videos = videos.data;
    });
  },
};
</script>
