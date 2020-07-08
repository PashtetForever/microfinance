<template>
  <v-container fluid>
    <section v-if="canBeExtended">
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
    async mounted() {
      await this.$store.dispatch('getContractData')
    }
  }
</script>
