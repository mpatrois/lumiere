<template>
  <div>
    <ul v-for="(video,index) in videosFiltered" :key="index" v-if="videosFiltered.length > 0">
      <li>
        <p>{{ video.title }}</p>
      </li>
    </ul>
    <p v-else>
      Pas de résultats pour votre recherche
    </p>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: "Results",
  data() {
    return {
      searchText: '',
      videos: []
    }
  },
  computed:{
    videosFiltered(){
      return this.videos.filter(video => {
          const title = video.title.toLowerCase();
          const query =  this.searchText.toLowerCase();
          return title.includes(query);
        })
    }
  },
  created() {
    this.searchText = this.$route.query.search_query;
    axios.get('/api/video').then(({ data }) => {
      this.videos = data;
    });
  },
  watch: {
    '$route.query'() {
      this.searchText = this.$route.query.search_query;
    }
  }
}
</script>

