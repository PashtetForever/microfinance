<template>
  <section>
    <app-headers h1="Подтвердить документы и отправить заявку"/>
    <p>На ранее указаный Вами номер была отправлена СМС с кодом подтверждения. Введите его ниже</p>
    <v-form @submit.prevent="checkCode">
      <v-text-field
        type="text"
        v-model="code"
        autofocus="true"
        placeholder="Введите код из СМС">
      </v-text-field>
      <a class="btn btn-nav" @click="checkCode">Подтвердить</a>
    </v-form>
  </section>
</template>

<script>
  export default {
    name: "MandarinVerifySms",
    data: () => ({
      code: ''
    }),
    methods: {
      async checkCode() {
        await this.$store.dispatch('sendMandarinSmsCode', this.code);
        const isVerify = await this.$store.dispatch('checkMandarinSmsStatus');
        if(isVerify){
          this.$store.commit('smsCode', this.code);
          await this.$store.dispatch('createLoan');
          this.$store.commit('isExistLoan', true);
          this.$router.push('/profile')
        } else {
          await this.$store.dispatch('error', 'Веден неверный код. Повторите попытку')
        }
      }
    }
  }
</script>

<style scoped>

</style>
