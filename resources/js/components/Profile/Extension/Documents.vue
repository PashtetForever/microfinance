<template>
  <v-row v-if="extendDocuments.length">
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
          <tr v-for="doc in extendDocuments" :key="doc.name">
            <td><a target="_blank" :href="doc.path">{{ doc.name }}</a></td>
            <td>{{doc.date}}</td>
            <td>{{doc.smsCode}}</td>
          </tr>
          </tbody>
        </template>
      </v-simple-table>
      <a class="btn btn-nav" @click="accessDocuments">Принять</a>
    </v-col>
  </v-row>
</template>

<script>
  import {mapGetters} from 'vuex'

  export default {
    computed: {
      ...mapGetters(['extendDocuments', 'sumPercent'])
    },
    methods: {
      async accessDocuments() {
        if(this.sumPercent > 0)
          await this.repaymentPercent()
        else {
          await this.$store.dispatch('extensionLoan', {
            returnDate: this.$route.params.returnDate,
            smsCode: this.$route.params.smsCode
          });
          await this.$router.push({name: 'profile'})
        }
      },
      async repaymentPercent() {
        const response = await this.$store.dispatch('extensionPayPercent', {
          sum: this.sumPercent,
          date: this.$route.params.returnDate
        });
        if (response.hasOwnProperty('userWebLink')) {
          location.replace(response.userWebLink);
        }
      }
    }
  }
</script>
