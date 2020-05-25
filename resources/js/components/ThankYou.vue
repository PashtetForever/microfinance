<template>
  <v-row>
    <v-col>
      <app-headers h1="Спасибо! Оплата успешно проведена."/>
      <p>Займ полностью выплачен и закрыт. Благодарим за обращение. ООО МКК "Сентимо"</p>
      <app-nav
        toPath="/"
        customTextNext="Оформить новую заявку"/>
    </v-col>
  </v-row>
</template>

<script>
  export default {
    name: "ThankYou",
  }
</script>

<style scoped>

</style>
