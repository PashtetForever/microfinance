<template>
  <v-row>
    <v-col xs="12" md="11" offset-sm="1">
      <app-order-form-min/>
      <app-headers h1="Добавление контактных лиц"/>
      <v-row v-for="contact in contacts" :key="contact.key">
        <v-col>
          <v-form>
            <v-card>
              <v-card-text>
                <v-form>
                  <v-text-field @change="changeInput" v-model="contact.Name" label="ФИО"/>
                  <v-text-field @change="changeInput" v-model="contact.PhoneNumber" label="Телефон"/>
                </v-form>
              </v-card-text>
            </v-card>
          </v-form>
        </v-col>
      </v-row>
      <v-row justify="center">
        <v-col md="auto">
          <v-btn :disabled="contacts.length >= 5" @click="addBlock">Добавить контакт</v-btn>
        </v-col>
      </v-row>
      <v-row>
        <v-col>
          <v-alert
            color="red"
            elevation="2"
            v-if="isDisableNext"
          >Требуется заполнить контактную информацию минимум двух лиц
          </v-alert>
        </v-col>
      </v-row>
      <v-row>
        <v-col>
          <app-nav @clickNext="clickNext" backPath="/data" :disableNext="isDisableNext" toPath="card-binding"/>
        </v-col>
      </v-row>
    </v-col>
  </v-row>
</template>

<script>
  export default {
    name: "PersonalContacts",
    data: () => ({
      contacts: [],
      filledContacts: [],
    }),
    async mounted() {
      this.contacts = await this.$store.dispatch('loadPersonalContacts');
      this.contacts = this.contacts.map((item, index) => {
        return {
          ...item,
          key: index
        }
      });
      if (this.contacts.length < 3) {
        for (let i = this.contacts.length; i < 3; i++) {
          this.addBlock();
        }
      }
      this.filledContacts = this.getFilledContacts();
    },
    computed: {
      isDisableNext() {
        return this.filledContacts.length < 2;
      }
    },
    methods: {
      addBlock() {
        this.contacts.push({Name: '', PhoneNumber: '', key: this.contacts.length + 1});
      },
      changeInput() {
        this.filledContacts = this.getFilledContacts();
      },
      getFilledContacts() {
        return this.contacts.filter(item => {
          return (item.Name !== '' && item.PhoneNumber !== '')
        })
      },
      async clickNext() {
        await this.$store.dispatch('setPersonalContacts', this.filledContacts);
      }
    }
  }
</script>

<style scoped>

</style>
