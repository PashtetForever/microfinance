<template>
  <div class="background-form row justify-content-center">
    <div class="calc-wrapper col-md-4 align-content-center">
      <form novalidate="novalidate" @submit.prevent>
        <p class="sumInputTitle text-center">Авторизация</p>
        <div class="form-group">
          <label for="login">Логин<span class="star">*</span></label>
          <input v-model="login" name="login" type="text" class="form-control" id="login">
        </div>
        <div class="form-group">
          <label for="password">Пароль<span class="star">*</span></label>
          <input v-model="password" name="password" type="password" class="form-control" id="password">
        </div>
        <div class="form-group">
          <label for="phone">Телефон<span class="star">*</span></label>
          <input
            v-model="phone"
            name="phone"
            type="text"
            class="form-control"
            id="phone"
            v-mask="phoneMask"
            placeholder="+7(495) 000-00-00"
          >
        </div>
        <!--<div class="row">
          <div class="col">
            <router-link to="/change-password">Забыли пароль?</router-link>
          </div>
        </div>-->
        <button @click="submitForm"
                :disabled="!valid"
                type="submit"
                class="submit btn btn-base rounded mx-auto d-block"
        >Далее
        </button>
      </form>
    </div>
  </div>
</template>

<script>
  import {mask} from 'vue-the-mask';

  export default {
    directives: {
      mask
    },
    data() {
      return {
        login: '',
        password: '',
        phone: '+7',
        phoneMask: '+7(###) ###-##-##',
        valid: false
      }
    },
    methods: {
      isValidFields() {
        return (this.login !== '' && this.password !== '' && this.phone !== '');
      },
      async submitForm() {
        if (this.isValidFields()) {
          const response = await this.$store.dispatch('userLogin', {
            login: this.login,
            password: this.password,
            phone: this.phone
          });
          this.$store.commit('mandarinLogin', response.Mandarin.Login)
          this.$router.push('/verify');
        } else {
          this.$store.dispatch('error', 'Заполните поля логин, пароль и телефон');
        }
      }
    },
    watch: {
      phone(value) {
        this.valid = value.length === 17;
      }
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
