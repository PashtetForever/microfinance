<template>
  <v-app id="app">
    <v-content>
      <template v-if="loading">
        <v-overlay :value="loading">
          <v-progress-circular indeterminate size="64" class="align-content-center"/>
          <v-row>
            <v-col><span class="headline text-center">Пожалуйста подождите, информация обрабатывается</span>
            </v-col>
          </v-row>
        </v-overlay>
      </template>
      <template v-if="$store.getters.isAuthorized">
        <v-container fluid>
          <v-row>
            <v-col lg="3" md="4" sm="4" xs="12">
              <Menu/>
              <div class="mt-4">
                <v-card class="text-center p-2">
                  <span class="title"><a href="tel:88002349051">8-800-234-90-51</a></span><br>
                  Техническая поддержка<br>
                  <span class="small">с 09.00 до 18.00 по МСК</span>
                </v-card>
              </div>
            </v-col>
            <v-col lg="9" md="8" sm="8" xs="12">
              <keep-alive>
                <router-view/>
              </keep-alive>
            </v-col>
          </v-row>
        </v-container>
      </template>
      <template v-else>
        <v-container>
          <v-row>
            <v-col>
              <router-view/>
            </v-col>
          </v-row>
        </v-container>
      </template>
      <v-snackbar v-model="snackbar">{{errorText}}
        <v-btn color="pink" text @click="$store.commit('snackbar', false)">Закрыть</v-btn>
      </v-snackbar>
    </v-content>
  </v-app>
</template>

<script>
  import Menu from "../components/shared/Menu";
  import {mapGetters} from 'vuex';

  export default {
    components: {Menu},
    computed: {
      ...mapGetters(['snackbar', 'errorText', 'loading'])
    },
    mounted() {
      if(this.$route.path === '/')
        this.$router.push({name: 'order-form'})
    }
  };
</script>
<style>
  .v-application {
    background: #fff !important;
  }

  .container--fluid {
    max-width: 1140px;
  }

  .v-application--wrap {
    min-height: auto !important;
  }

  .v-overlay__content {
    text-align: center !important;
  }

  .btn-nav {
    color: #fff !important;
  }
</style>
