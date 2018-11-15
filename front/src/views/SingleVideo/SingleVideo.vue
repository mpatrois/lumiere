<template>
  <section>
    <h1>SINGLEVIDEO view</h1>
    <h1>{{ video.title }}</h1>
  </section>
</template>

<script>
import axios from 'axios';

export default {
  name: "SingleVideo",
  data() {
    return {
      video: ''
    }
  },  
  created() {
    axios.get(`/api/video/${this.$route.params.id}`)
    .then(video => {
      this.video = video.data;
    })
  }
}
</script>
