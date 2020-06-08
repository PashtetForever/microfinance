<template>
  <v-container fluid>
    <section v-if="loanData.Number">
      <v-row>
        <v-col>
          <v-row v-if="documents.length === 0">
            <v-col>
              <v-alert
                color="red"
                elevation="2"
                v-if="isNeedPayPercent"
              >Для продления займа Вам необходимо оплатить текущий процент. <br>
                <span>Сумма процентов: <span class="font-weight-bold">{{ percentSum }} руб.</span></span>
              </v-alert>
              <v-row>
                <v-col>
                  <p><span class="font-weight-bold">Количество дней прдления:</span> {{days}}</p>
                </v-col>
                <v-col>
                  <p><span class="font-weight-bold">Новая дата возврата займа:</span> {{returnDate.format('L')}}</p>
                </v-col>
              </v-row>
              <v-row>
                <v-col>
                  <v-slider
                    v-model="days"
                    class="align-center"
                    :max="30"
                    :min="1"
                    :step="1"
                    :color="'#fc0101'"
                    :track-color="'#f6f6f6'"
                    hide-details/>
                </v-col>
              </v-row>
            </v-col>
          </v-row>
          <v-row v-if="documents.length">
            <v-col>
              <span class="subtitle-1">Документы</span>
              <v-simple-table>
                <template v-slot:default>
                  <thead>
                  <tr>
                    <th class="text-left">Название документа</th>
                    <th class="text-left">Дата</th>
                    <th class="text-left">СМС код</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="doc in documents" :key="doc.name">
                    <td><a target="_blank" :href="doc.path">{{ doc.name }}</a></td>
                    <td>{{doc.date}}</td>
                    <td>{{doc.smsCode}}</td>
                  </tr>
                  </tbody>
                </template>
              </v-simple-table>
            </v-col>
          </v-row>
          <v-dialog v-model="dialog" max-width="330" v-if="documents.length === 0">
            <template v-slot:activator="{ on }">
              <v-row>
                <v-col>
                  <a class="btn btn-nav" @click="sendSmsCode" v-on="on">Продлить займ</a>
                </v-col>
              </v-row>
            </template>
            <v-card>
              <v-card-title class="headline">Продлить займ</v-card-title>
              <v-card-text>
                Введите код отправленный на номер телефона указанный ранее
                <v-text-field v-model="smsCode" placeholder="Код из смс" type="text"/>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="green darken-1" text @click="dialog = false">Отменить</v-btn>
                <v-btn color="green darken-1" text @click="getExtendDocuments">Подписать</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
          <a v-else class="btn btn-nav" @click="extendLoan">Продлить займ</a>
        </v-col>
      </v-row>
    </section>
    <section v-else>
      <v-alert color="danger">
        В данный момент у Вас нет активных займов
      </v-alert>
    </section>
  </v-container>
</template>

<script>
  import {mapGetters} from 'vuex';
  import _ from "lodash";
  import moment from "moment";

  export default {
    data: () => ({
      days: 1,
      contractData: null,
      percentSum: 0,
      returnDate: moment(),
      dialog: false,
      smsCode: '',
    }),
    computed: {
      ...mapGetters(['loanData']),
      isNeedPayPercent() {
        return (this.percentSum > 0)
      },
      documents() {
        return this.$store.getters.extendDocuments;
      }
    },
    methods: {
      extendLoan() {
        if (this.isNeedPayPercent)
          this.payment();
        else {
          this.$store.dispatch('extensionLoan', {
            returnDate: this.returnDate.format('YYYYMMDD'),
            smsCode: this.smsCode
          }).then(() => {
            this.$router.push('/profile')
          })
        }
      },
      async payment() {
        const response = await this.$store.dispatch('extensionPayPercent', {
          sum: this.percentSum,
          date: this.returnDate.format('YYYYMMDD')
        });
        if (response.hasOwnProperty('userWebLink')) {
          location.replace(response.userWebLink);
        }
      },
      async getExtendDocuments() {
        if (this.smsCode) {
          const result = await this.$store.dispatch('checkVerificationCode', {
            phone: this.$store.getters.phone,
            code: this.smsCode
          });
          if (!result)
            return this.$store.dispatch('error', 'Проверьте правильность введеного кода подписи');
        }
        this.dialog = false;
        const documents = await this.$store.dispatch('getExtensionLoanDocuments', {
          returnDate: this.returnDate.format('YYYYMMDD'),
          smsCode: this.smsCode
        });
        documents.forEach((item) => {this.$store.commit('addDocument', item);})

      },
      async sendSmsCode() {
        await this.$store.dispatch('sendPhoneVerifyCode')
      },
    },
    async mounted() {
      if (!this.$store.getters.email) {
        await this.$store.dispatch('loadContactData');
      }
    },
    beforeRouteEnter(to, from, next) {
      next( vm => {
        vm.contractData = vm.$store.dispatch('getValidContract');
        vm.percentSum = _.parseInt(vm.contractData.PercentSum) + _.parseInt(vm.contractData.Penalty);
        vm.returnDate = moment(vm.contractData.ReturnDate, 'DD.MM.YYYY').locale('ru').add(1, 'days');
      })
    },
    watch: {
      days() {
        this.returnDate = moment(this.contractData.ReturnDate, 'DD.MM.YYYY').locale('ru')
        this.returnDate.add(this.days, 'days')
      }
    }
  }
</script>
