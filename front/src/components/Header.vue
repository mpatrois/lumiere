<template>
  <header>
    <router-link to="/">
      <img src="../assets/logo_lumiere.svg" alt="Logo Lumière" class="logo">
    </router-link>
    <div class="searchBar">
      <input type="text"
      v-model="searchText"
      placeholder="Rechercher"
      @keypress.enter="goToSearch"
      />
    </div>
    <div class="header__actions">
      <!-- <router-link to="/upload"> -->
        <img src="../assets/add.svg">
      <!-- </router-link> -->
      <img src="../assets/feed.svg" alt="">
      <img src="../assets/notif.svg" alt="">
      <img src="../assets/profile.svg" alt="">
      <!-- <div class="profile">
        <img src="https://image.flaticon.com/icons/svg/78/78373.svg" alt="" class="tmpIconHeader" @click="displayProfile">
        <div class="profile__content">
          Pas d'informations profile
        </div>
      </div> -->
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
