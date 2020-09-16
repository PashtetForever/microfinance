<template>
  <section>
    <template v-if="!isBlocked">
      <v-card>
        <v-card-title>Номер заявки №{{loanData.Number}}</v-card-title>
        <v-card-text class="text--primary">
          <v-row :style="{background: color}">
            <v-col><b>Сумма займа:</b> {{loanData.Sum}} руб.</v-col>
            <v-col><b>Срок займа (дней):</b> {{loanData.Days}}</v-col>
            <v-col><b>Статус:</b> {{loanData.Status}}<a @click="updateStatus" class="d-block">
              <v-icon>mdi-refresh</v-icon>
              Обновить статус</a></v-col>
          </v-row>
          <v-row v-if="!this.isExistSignContract && loanData.Status ==='Одобрена'">
            <v-col>
              <v-row>
                <v-col class="mb-2">
                  <v-checkbox hide-details="false" v-model="agreeThree"
                              label="На уступку третьим лицам прав требований по договору согласен"/>
                  <v-checkbox hide-details="false" v-model="agreeContract">
                    <template v-slot:label>
                      <div>
                        Ознакомлен и согласен с
                        <a target="_blank"
                           href="https://mkksentimo.ru/upload/iblock/7d5/%D0%9E%D0%B1%D1%89%D0%B8%D0%B5%20%D1%83%D1%81%D0%BB%D0%BE%D0%B2%D0%B8%D1%8F%20%D0%B4%D0%BE%D0%B3%D0%BE%D0%B2%D0%BE%D1%80%D0%B0%20%D0%BF%D0%BE%D1%82%D1%80%D0%B5%D0%B1%D0%B8%D1%82%D0%B5%D0%BB%D1%8C%D1%81%D0%BA%D0%BE%D0%B3%D0%BE%20%D0%BE%D0%BD-%D0%BB%D0%B0%D0%B9%D0%BD%20%D0%B7%D0%B0%D0%B9%D0%BC%D0%B0.docx"
                           @click.stop
                           v-on="on"
                        >Общими условиями договора</a>
                      </div>
                    </template>
                  </v-checkbox>
                </v-col>
              </v-row>
              <check-sms-form :disabled="!(agreeThree && agreeContract)" @successSmsForm="signContract" card-title="Подписать договор"
                              button-name="Подписать договор"/>
              <a class="btn btn-nav" @click="cancelLoan">Отказаться</a>
            </v-col>
          </v-row>
          <v-row v-if="loanData.Status ==='Ожидает решения'">
            <v-col>
              <v-alert class="m-4" color="success">
                Ваша заявка принята! Для рассмотрения заявки нам необходимо с Вами связаться. Приготовьте, пожалуйста,
                телефон, мы перезвоним Вам через несколько минут
              </v-alert>
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
        </v-card-text>
      </v-card>
    </template>
    <template v-else>
      <v-alert color="red">
        В оформлении займа отказано. Вы сможете повторно оформить займ с {{ blockedUntil }}
      </v-alert>
    </template>
  </section>
</template>

<script>
  import {mapGetters} from 'vuex'
  import CheckSmsForm from "../shared/CheckSmsForm";

  export default {
    components: {CheckSmsForm},
    data: () => ({
      agreeThree: false,
      agreeContract: false,
      on: false
    }),
    computed: {
      ...mapGetters(['loanData', 'documents', 'isExistSignContract', 'isBlocked', 'blockedUntil']),
      color() {
        let color;

        switch (this.loanData.Status) {
          case 'Ожидает решения': {
            color = '#fff4c8';
            break;
          }
          case 'Одобрена': {
            color = '#e6ffc8';
            break;
          }
          case 'Отказано': {
            color = '#f9c7c7';
            break;
          }
        }

        return color;
      }
    },
    methods: {
      async updateStatus() {
        location.reload();
      },
      async signContract(data) {
        await this.$store.dispatch('signContract', data.code);
        location.reload();
      },
      async cancelLoan() {
        await this.$store.dispatch('cancelLoan')
        await this.$router.push({name: 'order-form'})
      }
    },
    async beforeRouteEnter(to, from, next) {
      await next(vm => {
        vm.$store.dispatch('loadContactData');

        if (!vm.$store.getters.isBlocked)
          vm.$store.dispatch('getLoanData')

        if (!vm.$store.getters.isBlocked && vm.loanData.Status === 'Отказано') {
          vm.$store.dispatch('cancelLoan')
          vm.$router.push({name: 'order-form'})
        }
      })
    }
  }
</script>

<style>
  .v-card__text .v-label {
    margin-bottom: 0;
  }
</style>
