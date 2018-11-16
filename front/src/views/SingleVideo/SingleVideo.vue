<template>
  <section v-if="video" class="singleVideo__container">
    <div class="singleVideo__video__container">
      <video ref="video" autoplay="true" @click="play()">
        <source :src="'/api/video/play/' + video.id">
        Your browser does not support HTML5 video.
      </video>
      <div class="video-controls">
        <span class="play" v-if="isPause()">
          <img src="../../assets/play_button.svg">
        </span>
        <span class="play" v-else>
          <img src="../../assets/pause_button.svg">
        </span>

        <span>{{secondToHumanDisplay(currentTime)}}</span>
        <div class="progress-bar">
          <div class="progress" :style="{
            width: getDurationPercent()+'%'
          }"></div>
        </div>
      <span>{{secondToHumanDisplay(duration)}}</span>
    </div>
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
            <li v-for="(emoji, index) in emojiReactions" :key="index">
              <span>{{emoji}}</span>
            </li>
          </ul>
        </div>
        <div class="profile">
          <img src="../../../src/assets/userProfile.jpeg" alt="" class="pic">
          <div class="name">
            <h2>Jim Carrey</h2>
            <span>200K followers</span>
          </div>
        </div>
        <div class="description" v-if="visibleDescription">
          {{ video.description }}
        </div>
        <a @click="() => visibleDescription = !visibleDescription"
          class="descriptionBtn">
          {{ visibleDescription ? "Fermer la description" : " voir la description" }}
        </a>
        <div class="other-videos">
          <h2>Autres videos de Jim Carrey</h2>
          <ul>
            <li>
              <img src="../../assets/Rectangle.jpg">
              <h4>Titre de la video</h4>
              <span class="date">23/10/2018</span>
            </li>
            <li>
              <img src="../../assets/Rectangle2.jpg">
              <h4>Titre de la video</h4>
              <span class="date">23/10/2018</span>
            </li>
            <li>
              <img src="../../assets/Rectangle3.jpg">
              <h4>Titre de la video</h4>
              <span class="date">23/10/2018</span>
            </li>
          </ul>
        </div>
      </div>
      <CommentsSection :comments="video.comments"/>
    </div>
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
      currentTime: 0,
      duration: 0,
      visibleDescription: false,
    };
  },
  computed: {
  },
  methods: {
    randomNb(min, max) {
      return Math.floor(Math.random() * (max- min + 1) + min);
    },
    launchVideo() {
      this.isVideoLaunched = true;
    },
    play() {
      if (this.$refs.video.paused) {
        this.$refs.video.play();
      } else {
        this.$refs.video.pause();
      }
    },
    secondToHumanDisplay(timeSecond) {
      const date = new Date(null);
      date.setSeconds(timeSecond);
      const result = date.toISOString().substr(14, 5);
      return result;
    },
    getDurationPercent() {
      return this.currentTime * 100 / this.duration;
    },
    isPause() {
      return this.$refs.video !== undefined && this.$refs.video.paused;
    },
  },
  created() {
    axios.get(`/api/video/${this.$route.params.id}`)
      .then((video) => {
        this.video = video.data;
        setTimeout(() => {
          this.duration = this.$refs.video.duration;
          this.$refs.video.ontimeupdate = (event) => {
            this.currentTime = event.target.currentTime;
          };
          this.$refs.video.play();
        }, 200);
      });
  },
  beforeDestroy() {
    this.$refs.video.ontimeupdate = null;
  },
};
</script>


<style lang="scss">
.singleVideo__video__container{
  position: relative;
  &:hover{
    .video-controls{
      opacity: 1;
    }
  }
}
.video-controls{
  position: absolute;
  width: 100%;
  color: white;
  bottom: 10px;
  text-align: center;
  opacity: 0;
  transition: 400ms opacity;
  span{
    display: inline-block;
    vertical-align: middle;
  }
}

.progress-bar{
  font-family: 'SF';
  display: inline-block;
  width: 50%;
  background: #9c9b9b;
  height: 3px;
  margin: 0px 20px;
  vertical-align: middle;
  .progress{
    background: #FFFFFF;
    height: 3px;
  }
}

.other-videos{
  margin-top:20px;
  h2{
    margin-bottom: 10px;
  }
  ul{
    li{
      display: inline-block;
      width: 300px;
      margin-right: 30px;
      margin-bottom: 30px;
      img{
        width: 100%;
      }
      .date{
        color: #ccc;
        font-size: 12px;
      }
    }
  }
}

.play{
  margin-right: 10px;
}

</style>
