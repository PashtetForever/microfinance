<template>
  <v-container fluid>
    <section v-if="canBeExtended">
      <v-alert
        color="red"
        elevation="2"
        v-if="contractData.PercentSum > 0"
      >Для продления займа Вам необходимо оплатить текущий процент. <br>
        <span>Сумма процентов: <span class="font-weight-bold">{{ contractData.PercentSum }} руб.</span></span>
      </v-alert>
      <router-view></router-view>
    </section>
    <section v-else>
      <v-alert>
        К сожалению, Вы не можете продлить текущий заём. <br>
        <p></p>
      </v-alert>
    </section>
  </v-container>
</template>

<script>
  import ChoiceDate from "./ChoiceDate"
  import {mapGetters} from 'vuex'

  export default {
    components: {ChoiceDate},
    computed: {
      ...mapGetters(['loanData', 'canBeExtended', 'contractData'])
    },
    async beforeRouteEnter(to, from, next) {
      await next(vm => {
        vm.$store.dispatch('getContractData')
      })
    },
  }
</script>
