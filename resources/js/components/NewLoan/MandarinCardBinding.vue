<template>
  <v-row>
    <v-col>
      <span class="headline">Пожалуйста, подождите...</span>
    </v-col>
  </v-row>
</template>

<script>
  export default {
    name: "MandarinCardBinding",
    beforeRouteEnter(to, from, next) {
      next(vm => {
        if(vm.$store.getters.userWebLink) {
          location.replace(this.$store.getters.userWebLink);
        }
        return false;
      });
    }
  }
</script>

<style scoped>

</style>
