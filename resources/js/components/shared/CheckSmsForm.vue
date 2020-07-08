<template>
  <v-dialog v-model="dialog" max-width="330">
    <template v-slot:activator="{ on }">
      <slot name="activator-button"></slot>
      <v-row>
        <v-col>
          <a class="btn btn-nav" @click="sendSmsCode" v-on="on">{{buttonName}}</a>
        </v-col>
      </v-row>
    </template>
    <v-card>
      <v-card-title class="headline">{{cardTitle}}</v-card-title>
      <v-card-text>Введите код отправленный на номер телефона {{phone}}
        <v-text-field v-model="smsCode" placeholder="Код из смс" type="text"/>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="green darken-1" text @click="dialog = false">Отменить</v-btn>
        <v-btn color="green darken-1" text @click="checkSmsCode">{{buttonName}}</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
  import {mapGetters} from 'vuex'

  export default {
    props: ['buttonName', 'cardTitle', 'cardText'],
    data: () => ({
      dialog: false,
      smsCode: null
    }),
    computed: {
      ...mapGetters(['phone'])
    },
    methods: {
      async checkSmsCode() {
        if (this.smsCode) {
          const result = await this.$store.dispatch('checkVerificationCode', {
            phone: this.phone,
            code: this.smsCode
          });
          if (!result)
            return this.$store.dispatch('error', 'Проверьте правильность введеного кода подписи');
          else {
            this.$emit('successSmsForm', {code: this.smsCode})
            this.dialog = false
          }
        }
      },
      async sendSmsCode() {
        await this.$store.dispatch('sendPhoneVerifyCode')
      }
    },
  }
</script>

<style scoped>

</style>
