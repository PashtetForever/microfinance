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
          <template v-slot:expanded-item="{item}">
            <td :colspan="header.length" >
              <p class="my-2" v-for="doc in item.documents" :key="doc.name"><a :href="doc.path">{{doc.name}}</a></p>
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
