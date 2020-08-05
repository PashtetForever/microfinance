<template>
  <div class="background-form row justify-content-center">
    <div class="calc-wrapper col-md-8 align-content-center">
      <form novalidate="novalidate" @submit.prevent>
        <p class="sumInputTitle text-center">Регистрация</p>
        <v-row>
          <v-col>
            <div class="form-group">
              <label for="lastName">Фамилия<span class="star">*</span></label>
              <input v-model="lastName" name="lastName" type="text" class="form-control" id="lastName">
            </div>
            <div class="form-group">
              <label for="firstName">Имя<span class="star">*</span></label>
              <input v-model="firstName" name="lastName" type="text" class="form-control" id="firstName">
            </div>
            <div class="form-group">
              <label for="middleName">Отчество<span class="star">*</span></label>
              <input v-model="middleName" name="middleName" type="text" class="form-control" id="middleName">
            </div>
            <div class="form-group">
              <label for="gender">Пол<span class="star">*</span></label>
              <v-radio-group height="78px" v-model="gender" id="gender">
                <v-radio
                  label="Мужской"
                  value="мужской"
                />
                <v-radio
                  label="Женский"
                  value="женский"
                />
              </v-radio-group>
            </div>
            <div class="form-group">
              <label for="snils">СНИЛС<span class="star">*</span></label>
              <input v-mask="masks.snilsMask" v-model="snils" name="snils" type="text" class="form-control" id="snils" placeholder="123-123-123 11">
            </div>
            <div class="form-group">
              <label for="email">E-mail<span class="star">*</span></label>
              <input v-model="email" name="email" type="text" class="form-control" id="email">
            </div>
            <div class="form-group">
              <label for="phone">Телефон<span class="star">*</span></label>
              <input
                v-model="phone"
                name="phone"
                type="text"
                class="form-control"
                id="phone"
                placeholder="+7(495) 000-00-00"
              >
            </div>
          </v-col>
          <v-col>
            <div class="form-group">
              <label for="passportSeries">Серия паспорта<span class="star">*</span></label>
              <input v-model="passport.series" placeholder="0000" name="passportSeries" type="text" class="form-control" id="passportSeries">
            </div>
            <div class="form-group">
              <label for="passportNumber">Номер паспорта<span class="star">*</span></label>
              <input v-model="passport.number" placeholder="000000" name="passportNumber" type="text" class="form-control" id="passportNumber">
            </div>
            <div class="form-group">
              <label for="passportDate">Дата выдачи паспорта<span class="star">*</span></label>
              <input v-model="passport.date" v-mask="masks.dateMask" placeholder="ДД.ММ.ГГГГ" name="passportDate" type="text" class="form-control" id="passportDate">
            </div>
            <div class="form-group">
              <label for="passportRelease">Кем выдан<span class="star">*</span></label>
              <input v-model="passport.release" name="passportRelease" type="text" class="form-control" id="passportRelease">
            </div>
            <div class="form-group">
              <label for="passportCode">Код подразделения<span class="star">*</span></label>
              <input v-mask="masks.releaseMask" placeholder="000-000" v-model="passport.code" name="passportCode" type="text" class="form-control" id="passportCode">
            </div>
            <div class="form-group">
              <label for="dob">Дата рождения<span class="star">*</span></label>
              <input v-mask="masks.dateMask" placeholder="ДД.ММ.ГГГГ" v-model="dob" name="dob" type="text" class="form-control" id="dob">
            </div>
          </v-col>
        </v-row>
        <button @click="submitForm"
                :disabled="!valid"
                type="submit"
                class="submit btn btn-base rounded mx-auto d-block"
        >Зарегистрироваться
        </button>
        <v-row>
          <v-col class="text-center">
            <router-link to="/login">Войти</router-link>
          </v-col>
        </v-row>
      </form>
    </div>
  </div>
</template>

<script>
import Api from "../../api/Api";
import { validationMixin } from 'vuelidate'
import { required, minLength, numeric, email } from 'vuelidate/lib/validators'
import {mask} from 'vue-the-mask';

export default {
  mixins: [validationMixin],
  directives: {
    mask
  },
  data: () => ({
    lastName: '',
    firstName: '',
    middleName: '',
    dob: '',
    gender: '',
    passport: {
      series: '',
      number: '',
      code: '',
      release: '',
      date: '',
    },
    email: '',
    phone: '',
    snils: '',
    valid: true,
    masks: {
      snilsMask: '###-###-### ##',
      dateMask: '##.##.####',
      releaseMask: '###-###'
    }
  }),
  methods: {
    async submitForm() {
      try{
        let fio = this.lastName + ' ' + this.firstName + ' ' + this.middleName

        await Api.registration(
          fio,
          this.dob,
          this.gender,
          this.passport.series,
          this.passport.number,
          this.passport.date,
          this.passport.release,
          this.passport.code,
          this.email,
          this.phone,
          this.snils,
        )

        await this.$router.push({name: 'login'})
      } catch (e) {

      }

    },
  },
  validations: {
    lastName: {
      required,
    },
    firstName: {
      required,
    },
    middleName: {
      required,
    },
    snils: {
      required,
      minLength: minLength(7)
    },
    email: {
      required,
      email
    },
    phone: {
      required,
    },
  }
}
</script>
<style scoped>
input {
  background: #ececec;
  border-radius: 12px;
}
</style>
