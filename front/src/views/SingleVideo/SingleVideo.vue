<template>
  <section v-if="video">
    <div class="video__container">
      <img :src="'/api/video/preview/'+video.id" alt="" @click="launchVideo" v-if="!isVideoLaunched">
      <video width="400" controls v-if="isVideoLaunched" autoplay>
        <source :src="'/api/video/play/' + video.id">
        Your browser does not support HTML5 video.
      </video>
    </div>
    <div class="video__infos">
      <h1>{{ video.title }}</h1>
      <div class="video__infos__subinfos">
        <p>Views <span>{{viewsNb}}K</span></p>
        <p>16/11/2018</p>
        <p>Shared <span>{{sharedNb}}K</span></p>
        <p>plants <span>{{plantsNb}}K</span></p>
      </div>
    </div>
    <p>{{ video.title }}</p>
    <span>{{ video.description }}</span>


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
      viewsNb: this.randomNb(100, 800),
      sharedNb: this.randomNb(1, 50),
      plantsNb: this.randomNb(50, 400)
    };
  },
  methods: {
    randomNb(min, max) {
      return Math.floor(Math.random() * (max- min + 1) + min);
    },
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
