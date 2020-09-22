<template>
  <v-form>
    <v-card>
      <v-card-text>
        <v-form>
          <v-row>
            <v-col><v-text-field  @change="$emit('personalContactChanged')" :value="lastName" @input="$emit('input', $event.target.value)" label="Фамилия"/></v-col>
            <v-col><v-text-field  @change="$emit('personalContactChanged')" :value="firstName" @input="$emit('input', $event.target.value)" label="Имя"/></v-col>
            <v-col><v-text-field  @change="$emit('personalContactChanged')" :value="middleName" @input="$emit('input', $event.target.value)" label="Отчество"/></v-col>
          </v-row>
          <v-row>
            <v-col cols="4"><v-text-field @change="$emit('personalContactChanged')" v-model="phone" label="Телефон"/></v-col>
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
