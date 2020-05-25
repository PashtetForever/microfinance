<template>
  <v-row>
    <v-col xs="12" md="12">
      <v-row>
        <v-col>
          <p class="inputTitle">Сумма займа: <span class="font-weight-bold">{{sum}} руб.</span></p>
          <v-slider
            v-model="sum"
            class="align-center"
            :max="30000"
            :min="1000"
            :step="1000"
            :color="'#fc0101'"
            :track-color="'#f6f6f6'"
            hide-details
          >
          </v-slider>
        </v-col>
        <v-col>
          <p class="inputTitle">Срок займа: <span class="font-weight-bold">{{days}} {{dayString}}</span></p>
          <v-slider
            v-model="days"
            class="align-center"
            :max="32"
            :min="1"
            :step="1"
            :color="'#fc0101'"
            :track-color="'#f6f6f6'"
            hide-details
          />
        </v-col>
      </v-row>
      <v-row>
        <v-col><span class="text-uppercase">Процент по займу:</span> <span class="font-weight-bold">{{percentSum}} руб.</span></v-col>
        <v-col><span class="text-uppercase">Вернуть:</span> <span class="font-weight-bold">{{dateEndLoan}}</span></v-col>
      </v-row>
    </v-col>
  </v-row>
</template>

<script>
  export default {
    data() {
      return {
        percent: 1,
      }
    },
    computed: {
      sum: {
        get() {
          return this.$store.getters.getSum
        },
        set(value) {
          this.$store.commit('setSum', value)
        }
      },
      days: {
        get() {
          return this.$store.getters.getDays
        },
        set(value) {
          this.$store.commit('setDays', value)
        }
      },
      percentSum() {
        return (this.sum * this.days * this.percent) / 100
      },
      dateEndLoan() {
        return this.$store.getters.dateEndLoan
      },
      dayString() {
        const lastNumber = this.days.toString().length > 1 ? this.days.toString().slice(-1) : this.days;

        if(lastNumber === 1)
          return 'день';
        else if(lastNumber >= 2 && lastNumber < 5 && this.days > 20) {
          return 'дня';
        } else {
          return 'дней';
        }
      }
    },
    beforeMount() {
      this.sum = this.$store.getters.getSum;
      this.days = this.$store.getters.getDays;
    },
    updated() {
      this.$store.dispatch('setSum', this.sum);
      this.$store.dispatch('setDays', this.days);
    },
  }
</script>

<style scoped>

</style>
