<template>
  <div class="background-form row justify-content-center">
    <div class="calc-wrapper col-md-4 align-content-center">
      <form novalidate="novalidate" @submit.prevent>
        <p class="sumInputTitle text-center">Введите код из СМС</p>
        <div class="form-group">
          <label for="code">Код<span class="star">*</span></label>
          <input v-model="code" name="code" type="text" class="form-control" id="code">
        </div>
        <button
          @click="submit"
          :disabled="!valid"
          type="submit"
          class="submit btn btn-base rounded mx-auto d-block"
        >Войти
        </button>
      </form>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        code: '',
        valid: false,
      }
    },
    watch: {
      code() {
        this.valid = this.code.length !== 0;
      }
    },
    methods: {
      async submit() {
        await this.$store.dispatch('checkVerificationCode', {phone: this.$store.getters.phone, code: this.code})
          .then(() => {
            if (this.$store.getters.isVerify) {
              this.$store.commit('isAuthorized', true);
              this.$router.push({name: 'order-form'});
            }
          })
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
