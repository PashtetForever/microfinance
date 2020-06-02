<template>
  <v-container fluid>
    <section v-if="loanData.Number">
      <v-row>
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
          <a class="btn btn-nav mt-4" @click="click">Продлить займ</a>
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
      returnDate: undefined
    }),
    computed: {
      ...mapGetters(['loanData']),
      isNeedPayPercent() {
        return (this.percentSum > 0)
      },
    },
    methods: {
      click() {
        if(this.isNeedPayPercent)
          this.payment()
        else
          this.extension()
      },
      async payment() {
        const response = await this.$store.dispatch('extensionPayPercent', {
          sum: this.percentSum,
          date: this.returnDate.format('YYYYMMDD')
        });
        if(response.hasOwnProperty('userWebLink')) {
          location.replace(response.userWebLink);
        }
      },
      async extension() {
        await this.$store.dispatch('extendLoan', this.returnDate.format('YYYYMMDD'))
        this.$router.push('/profile')
      }
    },
    async mounted() {
      this.contractData = await this.$store.dispatch('getValidContract');
      this.percentSum = _.parseInt(this.contractData.PercentSum) + _.parseInt(this.contractData.Penalty);
      this.returnDate = moment(this.contractData.ReturnDate, 'DD.MM.YYYY').locale('ru').add(1,'days');
    },
    watch: {
      days() {
        this.returnDate = moment(this.contractData.ReturnDate, 'DD.MM.YYYY').locale('ru')
        this.returnDate.add(this.days, 'days')
      }
    }
  }
</script>

<style scoped>

</style>
