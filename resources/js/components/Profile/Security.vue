<template>
  <v-container>
    <v-row>
      <v-col cols="6">
        <v-alert v-if="result" color="success">Пароль успешно сохранен.</v-alert>
        <v-form v-model="valid" ref="formNewPass" lazy-validation>
          <v-text-field
            v-model="oldPassword"
            label="Текущий пароль"
            type="password"
            :rules="passwordRule"
            required
          ></v-text-field>
          <v-text-field
            v-model="newPassword"
            label="Новый пароль"
            type="password"
            :rules="passwordRule"
            required
          ></v-text-field>
          <v-btn @click="submitForm" :disabled="!valid">Сохранить</v-btn>
        </v-form>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    name: "Security",
    data: () => ({
      oldPassword: '',
      newPassword: '',
      passwordRule: [
        v => !!v || 'Требуется ввести пароль',
      ],
      valid: true,
      result: false
    }),
    methods: {
      async submitForm() {
        if (this.$refs.formNewPass.validate()) {
          const response = await this.$store.dispatch('changeOldPassword',
              {
                oldPassword: this.oldPassword,
                newPassword: this.newPassword
              }
          );
          if(response.Result)
            this.result = true;

        } else {
          await this.$store.dispatch('error', 'Требуется заполнить поля')
        }
      },
    }
  }
</script>

<style scoped>

</style>
