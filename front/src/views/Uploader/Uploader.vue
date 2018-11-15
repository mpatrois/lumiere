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
      <img v-if="previewImageSrc" :src="previewImageSrc">
      <video ref="videoPreview" controls v-if="videoData">
          <source :src="videoData">
          <!-- <source src="mov_bbb.ogg" type="video/ogg"> -->
          Your browser does not support HTML5 video.
        </video>
      <button type="submit">Register</button>
    </form>
    <button v-if="videoData" @click="snapImage()">Set Preview Image</button>
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
      message: '',
      previewImageSrc:null,
      videoData: null
    }
  },
  methods: {
    handleFileUpload() {
      this.message = '';
      if (uploaderSettings.formats.includes(this.$refs.videoFile.files[0].type)) {
        this.videoFile = this.$refs.videoFile.files[0]
        this.getImageFromFile(this.videoFile);
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
        formData.append('videoPreview', this.previewImageSrc);

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
        .catch((error) => {
          this.message = {
            class: `error`,
            text: `There is a bug while sending your file, please retry later`            
          }
        });
      }
    },
    getImageFromFile(file) {
      var fileReader = new FileReader();
        fileReader.onload = () => {
          var blob = new Blob([fileReader.result], {type: file.type});
          var url = URL.createObjectURL(blob);
          var video = document.createElement('video');
          this.videoData = url;
          video.preload = 'metadata';
          video.src = url;
          video.muted = true;
          video.playsInline = true;
          video.play();
        };
        fileReader.readAsArrayBuffer(file);
      },
      snapImage (){
        var canvas = document.createElement('canvas');
        var video = this.$refs.videoPreview;
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
        var image = canvas.toDataURL();
        this.previewImageSrc = canvas.toDataURL();
      }
  }
};
</script>


<style lang="scss" scoped>
  fieldset {
    border: none;
  }
</style>
