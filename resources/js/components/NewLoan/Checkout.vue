<template>
  <section>
    <app-headers h1="Отправить заявку онлайн" h2="Шаг 3: Подтверждение документов и отправка заявки"/>
    <template v-if="documents.length">
      <v-row>
        <v-col>
          Нажимая кнопку "Отправить заявку" я подписываю:
          <span v-for="(document, index) in documents" :key="document.path">
            {{(index !== 0) ? ',' : ''}} <a
            target="_blank"
            :href="document.path"
          >{{document.name}}</a>
          </span>
        </v-col>
      </v-row>
      <v-row>
        <v-col>
          <app-nav
            backPath="personal-contacts"
            toPath="verify-sms"
            customTextBack="Отказаться"
            customTextNext="Отправить заявку"
            @clickNext="clickNext"
          />
        </v-col>
      </v-row>
    </template>
  </section>
</template>
<script>
  export default {
    data() {
      return {
        documents: [
          {
            name: 'Заявление на предоставление займа',
            path: process.env.VUE_APP_DOCUMENTS_PATH + 'documenti/Заявление-анкета клиента МКК Сентимо.doc'
          },
          {
            name: 'Согласие на обработку персональных данных',
            path: process.env.VUE_APP_DOCUMENTS_PATH + 'documenti/Согласие на обработку персональных данных.docx'
          },
          {
            name: 'Согласие на взаимодействие с третьими лицами при взыскании задолженности',
            path: process.env.VUE_APP_DOCUMENTS_PATH + 'documenti/Согласие на осуществление взаимодействия с третьими лицами.docx'
          },
          {
            name: 'Соглашение о способах взаимодействия при возникновении задолженности',
            path: process.env.VUE_APP_DOCUMENTS_PATH + 'documenti/Соглашение о частоте и способах взаимодействия.docx'
          },
          {
            name: 'Соглашение об использовании АСП',
            path: process.env.VUE_APP_DOCUMENTS_PATH + 'documenti/Соглашение об АСП.docx'
          },
          {
            name: 'Согласие на получение кредитной истории',
            path: process.env.VUE_APP_DOCUMENTS_PATH + 'documenti/Согласие на получение кредитных отчетов.docx'
          },
        ],
        currentDocument: undefined,
        acceptedDocs: [],
        isDocumentsAccepted: false,
      }
    },
    methods: {
      async clickNext() {
        await this.$store.dispatch('startPersonIdentification');
      }
    },
  }
</script>

<style scoped>

</style>
