<template>
  <section>
    <v-row>
      <v-col>
        <v-row>
          <v-col>
            <p><span class="font-weight-bold">Количество возможных продлений:</span> {{contractData.LeftExtends}}</p>
          </v-col>
        </v-row>
        <v-row>
          <v-col>
            <p><span class="font-weight-bold">Количество дней продления:</span> {{days}}</p>
          </v-col>
          <v-col>
            <p><span class="font-weight-bold">Новая дата возврата займа:</span> {{returnDate.format('L')}}</p>
          </v-col>
        </v-row>
        <h2>Выберете срок продления</h2>
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
    <v-row>
      <v-col>
        <check-sms-form
          button-name="Продлить займ"
          card-title="Продлить займ"
          @successSmsForm="successSmsForm"
        />
      </v-col>
    </v-row>
  </section>

</template>

<script>
  import {mapGetters} from 'vuex'
  import CheckSmsForm from "../../shared/CheckSmsForm";
  import moment from "moment";

  export default {
    components: {CheckSmsForm},
    computed: {
      ...mapGetters(['contractData', 'canBeExtended'])
    },
    data: () => ({
      days: 1,
      returnDate: moment(),
    }),
    methods: {
      async successSmsForm(data) {
        try {
          await this.$store.dispatch('clearExtendDocuments');
          await this.$store.dispatch('getExtensionLoanDocuments', {
            returnDate: this.returnDate.format('YYYYMMDD'),
            smsCode: data.code
          })

          await this.$router.push({
            name: 'check-documents',
            params: {
              returnDate: this.returnDate.format('YYYYMMDD'),
              smsCode: data.code
            }
          })
        } catch (e) {
        }
      }
    },
    watch: {
      days() {
        this.returnDate = moment(this.contractData.ReturnDate, 'DD.MM.YYYY').locale('ru')
        this.returnDate.add(this.days, 'days')
      }
    },
    mounted() {
      if (!this.canBeExtended)
        this.$router.push('/loan-extension')
      this.returnDate = moment(this.contractData.ReturnDate, 'DD.MM.YYYY').locale('ru').add(1, 'days');
    }
  }
</script>

<style scoped>

</style>
