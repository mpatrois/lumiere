<template>
  <section>
    <h1>LISTVIDEOS View</h1>
    <ul>
      <li v-for="(video,index) in videos" :key="index" >
        <router-link :to="`/video/${video.id}`">
          <h2>Title : {{ video.title }}</h2>
          <p>desc : {{ video.description }}</p>
          <img :src="'/api/video/preview/'+video.id">
        </router-link>
        <h2>Title : {{ video.title }}</h2>
        <p>desc : {{ video.description }}</p>
        <img :src="'/api/video/preview/'+video.id">
        <a :href="video.path" target="_blank">link</a>
      </li>
    </ul>
  </section>
</template>

<script>
import axios from 'axios';

export default {
  name: "ListVideos",
  data() {
    return {
      videos: []
    }
  },
  created() {
    axios.get('/api/video').then(videos => {
      this.videos = videos.data;
    })
  },
}
</script>
