<template>
<div class="container log-in-form">
    <div class="row">
        <div class="pannel-container">
            <div class="panel panel-default">
                <div class="panel-heading">Connexion</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" v-on:submit.prevent="login">
                        <template v-if="errors">
                            <div v-for="(error, index) in errors" :key="index">
                                <p v-for="(errorMessage, index) in error"
                                    class="error"
                                    :key="index">
                                    {{ errorMessage }}
                                </p>
                            </div>
                        </template>
                        <div class="form-group">
                            <label for="email">E-Mail</label>

                            <div>
                                <input v-model="email"
                                       type="email"
                                       class="form-control"
                                       name="email" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password">Mot de passe</label>

                            <div>
                                <input
                                    v-model="password"
                                    type="password"
                                    class="form-control"
                                    name="password"
                                    required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <input
                                    v-model="remember"
                                    type="checkbox"
                                    name="remember">
                                    <label>
                                        <span>Se souvenir de moi</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="action">
                                <button type="submit" class="btn btn-primary">
                                    Connexion
                                </button>

                                <!-- <a>
                                    Vous n'avez pas de compte ?
                                    <router-link :to="{'name':'register'}">
                                        S'inscrire
                                    </router-link>
                                </a> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</template>
<script>

// import LoginService from '../services/login.service';
import axios from 'axios';

export default {
  data() {
    return {
      email: '',
      password: '',
      remember: true,
      errors: [],
      redirectUrl: '/'
    };
  },
  created(){
      if(this.$route.query.redirectUrl){
          this.redirectUrl = this.$route.query.redirectUrl;
      }
  },
  methods: {
    login() {
      this.errors = [];
      axios.post('/api/login',{
        email: this.email,
        password: this.password,
        remember: this.remember ? 'on' : null,
      }).then(() => {
        this.$router.push(this.redirectUrl);
      }).catch(({ response }) => {
        this.errors = response.data.errors;
      });
    },
  },
};
</script>
<style lang="scss">
    // @import '../assets/components/login_register.scss';
</style>