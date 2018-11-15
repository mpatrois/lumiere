<template>
  <section v-if="video">
    <h1>SINGLEVIDEO view</h1>
    <p>{{ video.title }}</p>
    <span>{{ video.description }}</span>
    <img :src="'/api/video/preview/'+video.id" alt="" @click="launchVideo" v-if="!isVideoLaunched">

    <video width="400" controls v-if="isVideoLaunched" autoplay>
      <source :src="'/api/video/play/' + video.id">
        Your browser does not support HTML5 video.
    </video>
  </section>
</template>

<script>
import axios from 'axios';

export default {
  name: 'SingleVideo',
  data() {
    return {
      video: '',
      isVideoLaunched: false,
    };
  },
  methods: {
    launchVideo() {
      this.isVideoLaunched = true;
    },
  },
  created() {
    axios.get(`/api/video/${this.$route.params.id}`)
      .then((video) => {
        this.video = video.data;
      });
  },
};
</script>
