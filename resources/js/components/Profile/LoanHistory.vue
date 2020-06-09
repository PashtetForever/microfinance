<template>
  <v-container fluid>
    <app-headers h1="История займов"/>
    <v-row>
      <v-col>
        <v-data-table
          :headers="header"
          :items="loans"
          :disable-filtering="true"
          :disable-pagination="true"
          :disable-sort="true"
          :hide-default-footer="true"
          :single-expand="false"
          no-data-text="Нет истории займов"
          class="elevation-1"
          show-expand
        >
          <template v-slot:item="{ item, expand, isExpanded }">
            <tr>
              <td>
                <a class="btn btn-nav" @click="expand(!isExpanded)">Документы</a>
              </td>
              <td class="d-block d-sm-table-cell" v-for="field in item.loan">
                {{field}}
              </td>
            </tr>
          </template>

          <template v-slot:expanded-item="{ headers, item }">
            <td :colspan="headers.length">
              <p class="mt-2 mb-0" v-for="doc in item.documents"><a :href="doc.path">{{doc.name}}</a></p>
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
    }),
    async mounted() {
      this.loans = await this.$store.dispatch('getHistoryLoans');
    }
  }
</script>

<style scoped>

</style>
