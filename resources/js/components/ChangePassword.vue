<template>
  <div class="background-form row justify-content-center">
    <div class="calc-wrapper col-md-4 align-content-center">
      <v-form @submit.prevent lazy-validation v-model="valid">
        <p class="sumInputTitle text-center">Восстановление пароля</p>
        <div class="form-group">
          <label for="firstName">Фамилия<span class="star">*</span></label>
          <input v-model="firstName" name="firstName" type="text" class="form-control" id="firstName">
        </div>
        <div class="form-group">
          <label for="lastName">Имя<span class="star">*</span></label>
          <input v-model="lastName" name="lastName" type="text" class="form-control" id="lastName">
        </div>
        <div class="form-group">
          <label for="middleName">Отчество<span class="star">*</span></label>
          <input v-model="middleName" name="middleName" type="text" class="form-control" id="middleName">
        </div>
        <div class="form-group">
          <label for="phone">Телефон<span class="star">*</span></label>
          <input v-mask="'+7(###) ###-##-##'" placeholder="+7(999) 999-99-99" v-model="phone" name="phone" type="text"
                 class="form-control" id="phone">
        </div>
        <button @click="submitForm"
                :disabled="$v.$invalid"
                type="submit"
                class="submit btn btn-base rounded mx-auto d-block"
        >Получить новый пароль
        </button>
      </v-form>
    </div>
    <v-dialog v-model="dialog" max-width="400">
      <v-card>
        <v-card-title class="headline">Проверка номера телефона</v-card-title>
        <v-card-text>
          Введите код отправленный на номер телефона указанный ранее
          <v-text-field v-model="smsCode" placeholder="Код из смс" type="text"/>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="green darken-1" text @click="verifyCode">Изменить пароль</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
    import {mask} from 'vue-the-mask';
    import {required, minLength} from 'vuelidate/lib/validators'

    export default {
        directives: {
            mask
        },
        name: "ChangePassword",
        data: () => ({
            valid: false,
            login: '',
            firstName: '',
            middleName: '',
            lastName: '',
            phone: '',
            dialog: false,
            smsCode: ''
        }),
        methods: {
            async submitForm() {
                this.dialog = true;
                await this.$store.dispatch('sendCodeChangePassword', this.phone);
            },
            async verifyCode() {
                const response = await this.$store.dispatch('changePassword', {
                    lastName: this.lastName,
                    firstName: this.firstName,
                    middleName: this.middleName,
                    code: this.smsCode,
                    phone: this.phone
                });

                if(response.status === 200) {
                    this.dialog = false;
                    this.$router.push('/login')
                }
            }
        },
        validations: {
            firstName: {
                required,
                minLength: minLength(2)
            },
            middleName: {
                required,
                minLength: minLength(3)
            },
            lastName: {
                required,
                minLength: minLength(3)
            },
        }
    }
</script>

<style scoped>
  input {
    background: #ececec;
    border-radius: 12px;
  }

  button.submit {
    background: #fc0101;
    color: #fff;
    border-radius: 6px !important;
    font-size: 19px;
    text-transform: uppercase;
    padding: 3px 10px;
    outline: none;
  }
</style>
