<template>
  <section>
    <app-order-form-min/>
    <app-headers h1="Добавление контактных лиц"/>
    <v-row v-for="contact in personalContacts" :key="contact.key">
      <personal-contact-item :contact="contact"/>
    </v-row>
    <v-row justify="center">
      <v-col md="auto">
        <v-btn :disabled="personalContacts.length >= 5" @click="$store.commit('addEmptyPersonalContact')">Добавить
          контакт
        </v-btn>
      </v-col>
    </v-row>
    <v-row>
      <v-col>
        <v-alert
          color="red"
          elevation="2"
          v-if="filledContacts.length < 2"
        >Требуется заполнить контактную информацию минимум двух лиц
        </v-alert>
      </v-col>
    </v-row>
    <v-row>
      <v-col>
        <app-nav @clickNext="clickNext"
                 backPath="data"
                 :disableNext="filledContacts.length < 2 || !isValidAllItems"
                 toPath="card-binding"/>
      </v-col>
    </v-row>
  </section>
</template>

<script>
import PersonalContactItem from "./PersonalContactItem";
import {mapGetters} from "vuex"

export default {
  components: {
    PersonalContactItem
  },
  computed: {
    ...mapGetters(['personalContacts', 'filledContacts', 'isValidAllItems'])
  },
  async mounted() {
    await this.$store.dispatch('loadPersonalContacts');
  },
  methods: {
    cancelAdd(key) {
      this.$store.commit('removePersonalContactByKey', key)
    },
    async clickNext() {
      await this.$store.dispatch('setPersonalContacts');
    }
  }
}
</script>

<style scoped>

</style>
