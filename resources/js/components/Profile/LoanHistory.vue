<template>
  <v-container fluid>
    <app-headers h1="История займов"/>
    <v-row>
      <v-col>
        <v-data-table
          :headers="header"
          :items="rows"
          :disable-filtering="true"
          :disable-pagination="true"
          :disable-sort="true"
          :hide-default-footer="true"
          :single-expand="true"
          item-key="number"
          no-data-text="Нет истории займов"
          class="elevation-1"
          show-expand
        >
          <template v-slot:item="{ item, expand, isExpanded }">
            <tr>
              <td>
                <a class="btn btn-nav" @click="expand(!isExpanded)">Документы</a>
              </td>
              <td class="d-block d-sm-table-cell" v-for="field in item">
                {{field}}
              </td>
            </tr>
          </template>

          <template v-slot:expanded-item="{ item, headers }">
            <td :colspan="headers.length">
              <p class="mt-2 mb-0" v-for="doc in getDocuments(item.number)"><a :href="doc.path">{{doc.name}}</a></p>
            </td>
          </template>
        </v-data-table>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    name: "LoanHistory",
    data: () => ({
      header: [
        {text: 'Номер', value: 'number'},
        {text: 'Сумма (руб.)', value: 'sum'},
        {text: 'Срок (дней)', value: 'days'},
        {text: 'Процент', value: 'percent'},
        {text: 'Дата создания', value: 'created_at'},
        {text: 'Дата возврата', value: 'deleted_at'},
      ],
      loans: [],
      rows: [],
    }),
    methods: {
      getDocuments(number) {
        return this.loans.find((item) => {
          return item.loan.number === number;
        }).documents;
      }
    },
    async mounted() {
      const response = await this.$store.dispatch('getHistoryLoans');
      this.loans = response;
      for (let item of response) {
        //item.loan.documents = item.documents;
        this.rows.push(item.loan)
      }
    }
  }
</script>

<style scoped>

</style>
