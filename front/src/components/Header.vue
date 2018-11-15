<template>
  <header v-if="hasSearchBar">
    <router-link to="/">
      <img src="../assets/logo_lumiere.svg" alt="Logo Lumière" class="logo">
      <input type="text" v-model="searchText" placeholder="Search here..."/>
      <img src="https://image.flaticon.com/icons/svg/149/149185.svg" alt="" class="uploadIcon">
    </router-link>
  </header>
</template>

<script>
export default {
  name: "Header",
  props: ['hasSearchBar'],
  data() {
    return {
      searchText: ''
    }
  }
}
</script>


