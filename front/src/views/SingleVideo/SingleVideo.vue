<template>
  <section v-if="video" class="singleVideo__container">
    <div class="singleVideo__video__container">
      <img :src="'/api/video/preview/'+video.id" alt="" @click="launchVideo" v-if="!isVideoLaunched">
      <video width="400" controls v-if="isVideoLaunched" autoplay>
        <source :src="'/api/video/play/' + video.id">
        Your browser does not support HTML5 video.
      </video>
    </div>
    <div class="singleVideo__video__content">
      <div class="singleVideo__video__content__infos">
        <div class="first-line">
          <div>
            <h1 class="title">{{ video.title }}</h1>
            <div class="subinfos">
              <p>Views <span class="bolded">{{viewsNb}}K</span></p>
              <p>16/11/2018</p>
              <p>Shared <span class="bolded">{{sharedNb}}K</span></p>
              <p>plants <span class="bolded">{{plantsNb}}K</span></p>
            </div>
          </div>
          <ul class="reactions-buttons">
            <li v-for="(emoji, index) in emojiReactions" :key="index">{{emoji}}</li>
          </ul>
        </div>
        <div class="profile">
          <img src="../../../src/assets/userProfile.jpeg" alt="" class="pic">
          <div class="name">
            <h2>Jim Carrey</h2>
            <span>200K followers</span>
          </div>
        </div>
      </div>
      <CommentsSection :comments="video.comments"/>
    </div>
    <p>{{ video.title }}</p>
    <span>{{ video.description }}</span>
  </section>
</template>

<script>
import axios from 'axios';
import CommentsSection from './CommentsSection.vue';

export default {
  name: 'SingleVideo',
  components: {
    CommentsSection,
  },
  data() {
    return {
      video: '',
      isVideoLaunched: false,
      viewsNb: this.randomNb(100, 800),
      sharedNb: this.randomNb(1, 50),
      plantsNb: this.randomNb(50, 400),
      emojiReactions: [
        '🍃', '❤️', '😂', '🤨', '😡',
      ],
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
