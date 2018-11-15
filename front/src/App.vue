<template>
  <div id="app">
    <div id="nav">
    </div>
    <router-view/>
  </div>
</template>

<script>
import Vue from 'vue';
import axios from 'axios';
import Header from "./components/Header.vue"

export default {
  name: "App",
  components: {
    Header
  }
}
</script>


<style lang="scss">
@import 'styles';
</style>
