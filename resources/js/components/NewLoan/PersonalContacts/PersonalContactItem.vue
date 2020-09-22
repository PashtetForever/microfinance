<template>
  <v-form>
    <v-card>
      <v-card-text>
        <v-form>
          <v-row>
            <v-col><v-text-field v-model="lastName" label="Фамилия"/></v-col>
            <v-col><v-text-field v-model="firstName" label="Имя"/></v-col>
            <v-col><v-text-field v-model="middleName" label="Отчество"/></v-col>
          </v-row>
          <v-row>
            <v-col cols="4"><v-text-field v-model="phone" label="Телефон"/></v-col>
          </v-row>
        </v-form>
      </v-card-text>
    </v-card>
  </v-form>
</template>

<script>
export default {
  props: ['lastName', 'firstName', 'middleName', 'phone']
}
</script>
