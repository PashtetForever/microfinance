<template>
  <v-row>
    <v-col xs="12" md="11" offset-sm="1">
      <app-headers h1="Проверка электронной почты"/>
      <p>На указанную Вами почту было отправлено письмо с кодом. Введите код в поле ниже.</p>
      <v-form>
        <v-text-field
          v-model="code"
          placeholder="Код подтверждения"
        />
      </v-form>
      <app-nav
        backPath="/contact-data"
        toPath="/data"/>
    </v-col>
  </v-row>
</template>

<script>
  import {mapGetters} from 'vuex';

  export default {
    name: "VerifyEmail",
    data: () => ({
      code: ''
    }),
    computed: {
      ...mapGetters(['isVerifyEmail'])
    },
    methods: {
      async checkCode() {
        await this.$store.dispatch('checkEmailCode', this.code);
      }
    },
    async beforeRouteLeave(to, from, next) {
      if(to.name === 'dataTable') {
        await this.checkCode();
        if(!this.isVerifyEmail) {
          next(false);
          await this.$store.dispatch('error', 'Не верный код подтверждения');
        } else {
          await this.$store.dispatch('setContactData');
          next()
        }
      }
      else {
        next()
      }
    },
     beforeRouteEnter(to, from, next) {
      next(vm => {
        vm.code = '';
        if(!vm.$store.getters.isVerifyEmail)
          vm.$store.dispatch('sendEmailCode');
      })
    }
  }
</script>

<style scoped>

</style>
