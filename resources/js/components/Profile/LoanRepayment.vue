<template>
  <section>
    <v-card v-if="contractData.Sum">
      <v-row>
        <v-col>
          <v-alert color="success m-4 mb-0">
            Вы можете погасить заём, используя вашу банковскую карту. Для этого Вам необходимо перейти по ссылке,
            нажав на кнопку «Оплатить». Обращаем Ваше внимание, что сумма платежа составляет <b>{{sumPercent}} руб.</b>
          </v-alert>
        </v-col>
      </v-row>
      <v-card-title>Погашение займа № {{contractData.Number}}</v-card-title>
      <v-card-text class="text--primary">
        <v-simple-table>
          <template v-slot:default>
            <tbody>
            <tr>
            <tr>
              <td><b>Сумма займа:</b></td>
              <td> {{contractData.Sum}} руб.</td>
            </tr>
            <tr>
              <td><b>Срок займа (дней):</b></td>
              <td> {{contractData.Days}}</td>
            </tr>
            <tr>
              <td><b>Дата возврата займа:</b></td>
              <td> {{contractData.ReturnDate}}</td>
            </tr>
            <tr>
              <td><b>Сумма процентов на текущий день:</b></td>
              <td> {{contractData.PercentSum}} руб.</td>
            </tr>
            <tr>
              <td><b>Процент:</b></td>
              <td> {{contractData.Percent}} %</td>
            </tr>
            <tr>
              <td><b>Пени:</b></td>
              <td> {{contractData.Penalty}}</td>
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
  import {mapGetters} from 'vuex'

  export default {
    computed: {
      ...mapGetters(['contractData', 'sumPercent'])
    },
    methods: {
      async repayment() {
        const response = await this.$store.dispatch('repayment', this.sumPercent);

        if (response.hasOwnProperty('userWebLink')) {
          location.replace(response.userWebLink);
        }
      },
    },
    async beforeRouteEnter(to, from, next) {
      await next(vm => {
        vm.$store.dispatch('getContractData')
      })
    }
  }
</script>

<style scoped>

</style>
