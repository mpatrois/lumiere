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
    <p :class="message.class ? message.class : ''" v-if="message">{{ message.text }}</p>
  </section>
</template>

<script>
import axios from 'axios';
import uploaderSettings from "./uploaderSettings.js"

export default {
  name: 'Uploader',
  data(){
    return {
      videoTitle: '',
      videoDesc: '',
      videoFile: '',
      message: ''
    }
  },
  methods: {
    handleFileUpload() {
      this.message = '';
      if (uploaderSettings.formats.includes(this.$refs.videoFile.files[0].type)) {
        this.videoFile = this.$refs.videoFile.files[0]
      } else {
        this.message = {
          class: `error`,
          text: `Format not supported, please upload a video with .mp4 or .mov format`
        };
        this.$refs.videoFile.type = 'text';
        this.$refs.videoFile.type = 'file';
      }
    },
    submitVideoForm() {
      let formData = new FormData();

      if (this.videoTitle && this.videoDesc && this.videoFile) {
        formData.append('title', this.videoTitle);
        formData.append('description', this.videoDesc);
        formData.append('file', this.videoFile);

        axios.post('/api/video',formData, 
        { 
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        }
        ).then(response => {
          console.log(message);
          this.message = {
            class: `success`,
            text: `The file has been send, thank you`
          }
        })
        .catch(error => {
          console.log(error);
          this.message = {
            class: `error`,
            text: `There is a bug while sending your file, please retry later`            
          }
        });
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
