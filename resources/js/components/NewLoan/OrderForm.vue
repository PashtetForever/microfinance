<template>
  <section>
    <app-headers h1="Оформить заявку онлайн" h2="Шаг 1: Выбор суммы и срока займа"/>
    <v-row>
      <v-col>
        <p class="inputTitle">Сумма займа</p>
        <p class="sum">{{sum}} <span>руб.</span></p>
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
        <p class="inputTitle">Срок займа</p>
        <p class="days">{{days}} <span>дней</span></p>
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
      <v-col>
        <p>Сумма процентов: {{percentSum}} руб.</p>
      </v-col>
      <v-col>
        <p>Процентная ставка: {{percent}}% в день</p>
      </v-col>
    </v-row>
    <app-nav toPath="contact-data"/>
  </section>
</template>

<script>

  export default {
    data() {
      return {
        sum: 1000,
        days: 1,
        percent: 1
      }
    },
    computed: {
      percentSum() {
        return (this.sum * this.days * this.percent) / 100
      }
    },
    beforeRouteEnter(to, from, next) {
      next(vm => {
        vm.sum = vm.$store.getters.getSum;
        vm.days = vm.$store.getters.getDays;
      })
    },
    updated() {
      this.$store.dispatch('setSum', this.sum);
      this.$store.dispatch('setDays', this.days);
    },
    async mounted() {
      await this.$store.dispatch('isExistLoan');
      if (this.$store.getters.isExistLoan)
        this.$router.push('/profile');
    }
  }
</script>

<style>
  label.error {
    display: none !important;
  }

  label.error[for="pers"] {
    display: inline-block !important;
    color: #D72024 !important;
  }

  .form-control.error,
  .custom-select.error {
    border-color: #D72024 !important;
  }

  #daysInput {
    background: #fff;
    width: 41px;
  }

  .pretty input[name="pers"] {
    width: unset;
    height: unset;
  }

  .sum,
  .days {
    font-size: 45px;
  }

  p.days span,
  p.sum span {
    font-size: 19px;
  }

  .inputTitle {
    text-transform: uppercase;
  }

  .accept-any-sum label {
    margin-bottom: 0 !important;
  }

  .v-slider__thumb {
    width: 25px !important;
    height: 25px !important;
  }

  .v-slider__thumb:before {
    left: -6px !important;
    top: -6px !important;
  }

</style>
