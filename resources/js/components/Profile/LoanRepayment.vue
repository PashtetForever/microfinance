<template>
  <section>
    <v-card v-if="data.Sum">
      <v-row>
        <v-col>
          <v-alert color="success m-4 mb-0">
            Вы можете погасить заём, используя вашу банковскую карту. Для этого Вам необходимо перейти по ссылке,
            нажав на кнопку «Оплатить». Обращаем Ваше внимание, что сумма платежа составляет <b>{{sum()}} руб.</b>
          </v-alert>
        </v-col>
      </v-row>
      <v-card-title>Погашение займа № {{data.Number}}</v-card-title>
      <v-card-text class="text--primary">
        <v-simple-table>
          <template v-slot:default>
            <tbody>
            <tr>
            <tr>
              <td><b>Сумма займа:</b></td>
              <td> {{data.Sum}} руб.</td>
            </tr>
            <tr>
              <td><b>Срок займа (дней):</b></td>
              <td> {{data.Days}}</td>
            </tr>
            <tr>
              <td><b>Дата возврата займа:</b></td>
              <td> {{data.ReturnDate}}</td>
            </tr>
            <tr>
              <td><b>Сумма процентов на текущий день:</b></td>
              <td> {{data.PercentSum}} руб.</td>
            </tr>
            <tr>
              <td><b>Процент:</b></td>
              <td> {{data.Percent}} %</td>
            </tr>
            <tr>
              <td><b>Пени:</b></td>
              <td> {{data.Penalty}}</td>
            </tr>
            </tbody>
          </template>
        </v-simple-table>
        <a @click="repayment" class="btn btn-nav">Оплатить</a>
      </v-card-text>
    </v-card>
    <v-card v-else>
      <v-alert color="danger">
        В данный момент у Вас нет активных займов
      </v-alert>
    </v-card>
  </section>
</template>

<script>
  import _ from "lodash"

  export default {
    name: "LoanRepayment",
    data: () => ({
      data: []
    }),
    methods: {
      async repayment() {
        const response = await this.$store.dispatch('repayment', this.sum());

        if (response.hasOwnProperty('userWebLink')) {
          location.replace(response.userWebLink);
        }
      },
      sum() {
        let summ = this.data.Sum;
        summ = +summ.replace(/\s/g, '');
        return _.ceil(_.toNumber(this.data.PercentSum.replace(/\s/g, '')) + _.toNumber(this.data.Penalty.replace(/\s/g, '')) + summ, 2)
      }
    },
    async mounted() {
      this.data = await this.$store.dispatch('getValidContract');
      if (!this.$store.getters.email) {
        await this.$store.dispatch('loadContactData');
      }
    }
  }
</script>

<style scoped>

</style>
