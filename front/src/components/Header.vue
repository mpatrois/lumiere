<template>
  <header>
    <router-link to="/">
      <img src="../assets/logo_lumiere.svg" alt="Logo Lumière" class="logo">
    </router-link>
    <input type="text" v-model="searchText" class="searchBar" placeholder="Search here..." @keypress.enter="goToSearch"/>
    <div class="header__actions">
      <router-link to="/upload">
        <img src="https://image.flaticon.com/icons/svg/149/149185.svg" alt="" class="tmpIconHeader">
      </router-link>
      <img src="https://image.flaticon.com/icons/svg/633/633584.svg" alt="" class="tmpIconHeader" @click="displayNotifs">
      <img src="https://image.flaticon.com/icons/svg/78/78373.svg" alt="" class="tmpIconProfile" @click="displayProfile">
    </div>
  </header>
</template>

<script>
export default {
  name: 'Header',
  data() {
    return {
      searchText: '',
      videos: [],
    };
  },
  methods: {
    displayNotifs() {
      console.log('no notifs right now');
    },
    displayProfile() {
      console.log('profile page will be soon developped');
    },
    goToSearch() {
      this.$router.push(`/results?search_query=${this.searchText}`);
    },
  },
};
</script>
