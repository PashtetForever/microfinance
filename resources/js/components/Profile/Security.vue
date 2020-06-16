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
            required
            @input="$v.oldPassword.$touch()"
            @blur="$v.oldPassword.$touch()"
            :error-messages="oldPasswordErrors"
          ></v-text-field>
          <v-text-field
            v-model="newPassword"
            label="Новый пароль"
            type="password"
            required
            :error-messages="newPasswordErrors"
            @input="$v.newPassword.$touch()"
            @blur="$v.newPassword.$touch()"
          ></v-text-field>
          <v-text-field
            v-model="repeatPassword"
            label="Повторите новый пароль"
            :error-messages="repeatPasswordErrors"
            type="password"
            @input="$v.repeatPassword.$touch()"
            @blur="$v.repeatPassword.$touch()"
            required
          ></v-text-field>
          <v-btn @click="submitForm" :disabled="!valid">Сохранить</v-btn>
        </v-form>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import { validationMixin } from 'vuelidate'
  import { required, sameAs, minLength } from 'vuelidate/lib/validators'

  export default {
    mixins: [validationMixin],
    name: "Security",
    data: () => ({
      oldPassword: '',
      newPassword: '',
      repeatPassword: '',
      valid: true,
      result: false,
    }),
    computed: {
      repeatPasswordErrors () {
        const errors = []
        if (!this.$v.repeatPassword.$dirty) return errors
        !this.$v.repeatPassword.sameAsPassword && errors.push('Новый пароль не совпадает')
        return errors
      },
      newPasswordErrors () {
        const errors = []
        if (!this.$v.newPassword.$dirty) return errors
        !this.$v.newPassword.minLength && errors.push('Пароль должен быть не менее 6 симоволов')
        !this.$v.newPassword.required && errors.push('Обязательное поле')
        return errors
      },
      oldPasswordErrors () {
        const errors = []
        if (!this.$v.oldPassword.$dirty) return errors
        !this.$v.oldPassword.required && errors.push('Обязательное поле')
        return errors
      },
    },
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
    },
    validations: {
      repeatPassword: {
        sameAsPassword: sameAs('newPassword')
      },
      newPassword: {
        required,
        minLength: minLength(6)
      },
      oldPassword: {
        required,
      },
    }
  }
</script>
