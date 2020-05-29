<template>
  <v-card>
    <v-card-title>Номер заявки №{{loanData.Number}}</v-card-title>
    <v-card-text class="text--primary">
      <v-row :style="{background: color}">
        <v-col><b>Сумма займа:</b> {{loanData.Sum}} руб.</v-col>
        <v-col><b>Срок займа:</b> {{loanData.Days}}</v-col>
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
          <v-dialog v-model="dialog" max-width="290">
            <template v-slot:activator="{ on }">
              <v-row>
                <v-col>
                  <a class="btn btn-nav" :class="{disabled: !(agreeContract && agreeThree)}" @click="sendSms" v-on="on">Подписать
                    договор</a>
                  <a class="btn btn-nav float-right">Отказаться</a>
                </v-col>
              </v-row>
            </template>
            <v-card>
              <v-card-title class="headline">Подписать договор</v-card-title>
              <v-card-text>
                Введите код отправленный на номер телефона указанный ранее
                <v-text-field v-model="smsCode" placeholder="Код из смс" type="text"/>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="green darken-1" text @click="dialog = false">Отменить</v-btn>
                <v-btn color="green darken-1" text @click="signContract">Подписать</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
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
                <td><a :href="doc.path">{{ doc.name }}</a></td>
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

<script>
  export default {
    name: "PersonalLoan",
    data: () => ({
      dialog: false,
      agreeThree: false,
      agreeContract: false,
      smsCode: '',
      on: false,
      isSendSms: false,
    }),
    computed: {
      loanData() {
        return this.$store.getters.loanData
      },
      documents() {
        return this.$store.getters.documents
      },
      isExistSignContract() {
        const contract = this.documents.find(item => {
          return (item.name === 'Договор потребительского займа')
        });

        return !!contract;
      },
      isExistFilledContract() {
        const contract = this.documents.find(item => {
          return (item.name === 'Договор займа (заполненный)')
        });

        return !!contract;
      },
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
      async sendSms() {
        if (!this.isSendSms)
          await this.$store.dispatch('sendPhoneVerifyCode');
      },
      async signContract() {
        if (this.smsCode) {
          const result = await this.$store.dispatch('checkVerificationCode', {code: this.smsCode});
          if (!result)
            return this.$store.dispatch('error', 'Проверьте правильность введеного кода подписи');
          else
            this.isSendSms = true;
        }
        this.dialog = false;
        await this.$store.dispatch('signContract', this.smsCode);
        location.reload();
      }
    },
    async mounted() {
      await this.$store.dispatch('getLoanData');
    }
  }
</script>

<style>
  .v-card__text .v-label {
    margin-bottom: 0;
  }
</style>
