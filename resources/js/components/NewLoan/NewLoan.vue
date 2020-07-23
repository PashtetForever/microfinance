<template>
  <v-row>
    <v-col xs="12" md="11" offset-sm="1">
      <router-view></router-view>
    </v-col>
  </v-row>
</template>

<script>
  export default {
    async mounted() {
      await this.$store.dispatch('loadContactData');
    }
  }
</script>
