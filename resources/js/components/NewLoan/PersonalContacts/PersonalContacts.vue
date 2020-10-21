<template>
  <section>
    <app-order-form-min/>
    <app-headers h1="Добавление контактных лиц"/>
    <v-row v-for="contact in personalContacts" :key="contact.key">
      <personal-contact-item :contact="contact" @personalContactRemoved="onRemovedContact"/>
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
        <app-nav backPath="data"
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
  data() {
    return {
      removedContacts: []
    }
  },
  components: {
    PersonalContactItem
  },
  computed: {
    ...mapGetters(['personalContacts', 'filledContacts', 'isValidAllItems'])
  },
  methods: {
    cancelAdd(key) {
      this.$store.commit('removePersonalContactByKey', key)
    },
    onRemovedContact(contact) {
      if (contact.guid) {
        this.removedContacts.push(contact)
      }
    }
  },
  async beforeRouteEnter(fo, form, next) {
    await next(vm => vm.$store.dispatch('loadPersonalContacts'))
  },
  async beforeRouteLeave(to, from, next) {
    if (to.name === 'card-binding') {

      this.removedContacts.forEach((contact) => {
        this.$store.commit('addPersonalContactForRemove', contact)
      })
      try {
        await this.$store.dispatch('setPersonalContacts')
        next()
      } catch (e) {
      } finally {
        this.$store.commit('clearContactsForRemove')
      }

    } else next()
  }
}
</script>
