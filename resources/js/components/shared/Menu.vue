<template>
  <v-card>
    <v-list-item-group color="primary">
      <router-link to="/" v-if="!isExistLoan">
        <v-list-item>
          <v-list-item-icon>
            <v-icon>mdi-credit-card-outline</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>Оформить заём</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </router-link>
      <router-link to="profile" v-else-if="isExistLoan">
        <v-list-item>
          <v-list-item-icon>
            <v-icon>mdi-credit-card-outline</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>Мой заём</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </router-link>
      <router-link to="loan-repayment" v-if="isExistLoan">
        <v-list-item>
          <v-list-item-icon>
            <v-icon>mdi-wallet</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>Погашение займа</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </router-link>
      <router-link to="loan-extension" v-if="isExistLoan">
        <v-list-item>
          <v-list-item-icon>
            <v-icon>mdi-credit-card-plus-outline</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>Продление займа</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </router-link>
        <router-link to="history">
          <v-list-item >
            <v-list-item-icon>
              <v-icon>mdi-credit-card-plus-outline</v-icon>
            </v-list-item-icon>
            <v-list-item-content>
              <v-list-item-title>История займов</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </router-link>
      <router-link to="security">
        <v-list-item>
          <v-list-item-icon>
            <v-icon>mdi-credit-card-plus-outline</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>Безопасность</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </router-link>
      <v-list-item @click="logout">
        <v-list-item-icon>
          <v-icon>mdi-credit-card-plus-outline</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>Выйти</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list-item-group>
  </v-card>
</template>

<script>
  import {mapGetters} from 'vuex';

  export default {
    name: "Menu",
    computed: {
      ...mapGetters(['isExistLoan'])
    },
    methods: {
      logout() {
        this.$store.dispatch('logoutUser');
        this.$router.push({name: 'login'});
        location.reload();
      }
    }
  }
</script>

<style scoped>

</style>
