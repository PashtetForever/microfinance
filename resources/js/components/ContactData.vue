<template>
  <v-row>
    <v-col xs="12" md="11" offset-sm="1">
      <app-order-form-min/>
      <app-headers h1="Подтверждение контактных данных"/>
      <v-alert
        color="red"
        elevation="2"
        v-if="!isVerifyEmail"
      >Необходимо подтвердить Вашу учетную записи. Заполните форму ниже, на указанный Email придет сообщение с кодом,
        введите код на следующем шаге.
      </v-alert>
      <v-form v-model="isValid" ref="personalDataForm">
        <v-text-field
          disabled
          v-model="fio" placeholder="Фамилия Имя Отчество">
        </v-text-field>
        <v-text-field
          v-model="phone" placeholder="Телефон"
          disabled
        >
        </v-text-field>
        <v-text-field
          :rules="emailRules"
          required
          v-model="email" :value="email" placeholder="E-mail">
        </v-text-field>
        <v-checkbox label="" v-model="verify" :rules="verifyRules" required>
          <template v-slot:label>
            <div>
              Нажимая на кнопку «Далее» я принимаю
              <span
                v-for="(doc, index) in documents"
                :key="doc.path">{{(index !== 0) ? ',' : ''}}
                <a target="_blank" :href="doc.path" @click.stop>{{doc.name}}</a>
              </span>
            </div>
          </template>
        </v-checkbox>

      </v-form>
      <app-nav backPath="/" :toPath="this.pathToNext" :disableNext="!isValid"/>
    </v-col>
  </v-row>
</template>

<script>
  import {mapGetters} from 'vuex';

  export default {
    data: () => ({
      emailRules: [
        v => !!v || 'Требуется ввести Email',
        v => /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/.test(v) || 'Введенный Email не корректен',
      ],
      verifyRules: [
        v => !!v || 'Требуется согласие',
      ],
      documents: [
        {
            name: 'Политику сайта',
            path: 'http://sentimo.ispvds.com/upload/iblock/74a/74aab95bb9314315ff00e136a7d6aea0.docx'
        },
        {
          name: 'Правила предоставления он-лайн займов',
          path: process.env.VUE_APP_DOCUMENTS_PATH + 'documenti/Правила предоставления он-лайн займов.doc'
        },
        {
          name: 'Соглашение об использовании АСП',
          path: process.env.VUE_APP_DOCUMENTS_PATH + 'documenti/Соглашение об АСП.docx'
        },
        {
          name: 'и даю согласие на Обработку персональных данных',
          path: process.env.VUE_APP_DOCUMENTS_PATH + 'documenti/Согласие на обработку персональных данных.docx'
        },
      ],
      verify: false,
      isValid: false,
      originalEmail: '',
    }),
    computed: {
      ...mapGetters(['isVerifyEmail', 'phone', 'fio']),
      email: {
        get() {
          return this.$store.getters.email
        },
        set(value) {
          this.$store.commit('email', value)
        }
      },
      pathToNext() {
        return (!this.isChangedEmail && this.$store.getters.isVerifyEmail) ? 'data' : 'verify-email';
      },
      isChangedEmail() {
        return this.originalEmail !== this.email
      }
    },
    async mounted() {
        await this.$store.dispatch('loadContactData');
    },
    beforeRouteLeave(to, from, next) {
      if(this.isChangedEmail)
        this.$store.commit('isVerifyEmail', false);
      next()
    },
    beforeRouteEnter(to, from, next) {
      next(vm => {
        vm.originalEmail = vm.$store.getters.email;
      })
    }
  }
</script>
