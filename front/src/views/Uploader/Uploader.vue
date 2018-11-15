<template>
  <section>
    <h1>UPLOADER VIEW</h1>
    <form method="POST" @submit.prevent="submitVideoForm"> 
      <fieldset>
        <input v-model="videoTitle" type="text" placeholder="Titre de la vidéo">
        <textarea v-model="videoDesc" placeholder="Description de la vidéo" />
      </fieldset>
      <label for="title">
      </label>
      <label for="video"></label>
      Votre vidéo :
      <input type="file" id="video" ref="videoFile" @change="handleFileUpload"/>


      <button type="submit">Register</button>
    </form>
    <p class="error-upload" v-if="errorUpload">{{ errorUpload }}</p>
  </section>
</template>

<script>
import uploaderSettings from "./uploaderSettings.js"


export default {
  name: 'Uploader',
  data(){
    return {
      videoTitle: '',
      videoDesc: '',
      videoFile: '',
      errorUpload: ''
    }
  },
  methods: {
    handleFileUpload() {
      this.errorUpload = '';
      if (uploaderSettings.formats.includes(this.$refs.videoFile.files[0].type)) {
        this.videoFile = this.$refs.videoFile.files[0]
      } else {
        this.errorUpload = `Format not supported, please upload a video with .mp4 or .mov format`;
        this.$refs.videoFile.type = 'text';
        this.$refs.videoFile.type = 'file';
      }
    },
    submitVideoForm() {
      let formData = new FormData();

      if (this.videoTitle && this.videoDesc && this.videoFile) {
        formData.append('file', this.videoFile);
      }
    }
  }
};
</script>


<style lang="scss" scoped>
  fieldset {
    border: none;
  }
</style>
