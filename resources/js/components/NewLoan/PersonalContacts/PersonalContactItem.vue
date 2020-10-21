<template>
  <v-col>
    <v-form>
      <v-card>
        <v-card-text>
          <v-form ref="formPersonalContact">
            <v-row>
              <v-col>
                <v-text-field
                  v-model="lastName"
                  @input="$v.lastName.$touch()"
                  @blur="$v.lastName.$touch()"
                  @change="inputChanged"
                  :error-messages="lastNameErrors"
                  label="Фамилия"/>
              </v-col>
              <v-col>
                <v-text-field
                  v-model="firstName"
                  @input="$v.firstName.$touch()"
                  @blur="$v.firstName.$touch()"
                  @change="inputChanged"
                  :error-messages="firstNameErrors"
                  label="Имя"/>
              </v-col>
              <v-col>
                <v-text-field
                  v-model="middleName"
                  @input="$v.middleName.$touch()"
                  @blur="$v.middleName.$touch()"
                  @change="inputChanged"
                  :error-messages="middleNameErrors"
                  label="Отчество"/>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="4">
                <v-text-field
                  @input="$v.phone.$touch()"
                  @blur="$v.phone.$touch()"
                  @change="inputChanged"
                  :error-messages="phoneErrors"
                  v-model="phone"
                  v-mask="'+7(###)###-##-##'"
                  label="Телефон"/>
              </v-col>
            </v-row>
          </v-form>
          <v-btn
            @click="$store.commit('removePersonalContactByKey', contactKey); $emit('personalContactRemoved', contact)"
            v-if="contactKey > 1">Отменить добавление
          </v-btn>
        </v-card-text>
      </v-card>
    </v-form>
  </v-col>
</template>

<script>
import {validationMixin} from 'vuelidate'
import {required} from 'vuelidate/lib/validators'
import {mask} from 'vue-the-mask';

export default {
  mixins: [validationMixin],
  directives: {mask},
  props: ['contact'],
  data() {
    return {
      lastName: this.contact.lastName,
      middleName: this.contact.middleName,
      firstName: this.contact.firstName,
      phone: this.contact.phone,
      contactKey: this.contact.key,
      guid: this.contact.guid
    }
  },
  computed: {
    lastNameErrors() {
      const errors = []
      if (!this.$v.lastName.$dirty) return errors
      !this.$v.lastName.required && errors.push('Поле обязательно для заполнения')
      return errors
    },
    middleNameErrors() {
      const errors = []
      if (!this.$v.middleName.$dirty) return errors
      !this.$v.middleName.required && errors.push('Поле обязательно для заполнения')
      return errors
    },
    firstNameErrors() {
      const errors = []
      if (!this.$v.firstName.$dirty) return errors
      !this.$v.firstName.required && errors.push('Поле обязательно для заполнения')
      return errors
    },
    phoneErrors() {
      const errors = []
      if (!this.$v.phone.$dirty) return errors
      !this.$v.phone.isCorrect && errors.push('Телефон заполнен не полностью')
      return errors
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
    phone: {
      required,
      isCorrect(phone) {
        const regexp = /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/
        return regexp.test(phone);
      }
    }
  },
  methods: {
    inputChanged() {
      this.$store.commit('updatePersonalContact', {
        lastName: this.lastName,
        middleName: this.middleName,
        firstName: this.firstName,
        phone: this.phone,
        guid: this.guid,
        key: this.contactKey,
        isValid: !this.$v.$invalid
      })
    }
  },
  created() {
    this.$v.$touch()
  }
}
</script>
