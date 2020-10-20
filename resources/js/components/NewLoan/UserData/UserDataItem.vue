<template>
  <section v-if="inputType === 'string'">
    <v-text-field @change="changeInput" :rules="rules()" :label="labelName" :value="inputValue"/>
  </section>
  <section v-else-if="inputType === 'numeric'">
    <v-text-field @change="changeInput" :rules="rules()" type="number" :label="labelName" :value="inputValue"/>
  </section>
  <section v-else-if="inputType === 'enum'">
    <v-select
      v-model="selected"
      :label="labelName"
      :items="enumOptions"
      item-text="name"
      item-value="value"
      return-object
      @change="changeInput"
    />
  </section>
  <section v-else-if="inputType === 'date'">
    <v-menu
      ref="menu"
      v-model="menu"
      :close-on-content-click="false"
      transition="scale-transition"
      offset-y
      min-width="290px"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-text-field
          :value="dateFormatted"
          :label="labelName"
          readonly
          v-bind="attrs"
          v-on="on"
        ></v-text-field>
      </template>
      <v-date-picker
        ref="picker"
        v-model="date"
        :max="new Date().toISOString().substr(0, 10)"
        min="1950-01-01"
        locale="ru"
        @change="menu = false; changeInput(dateFormatted)"
      ></v-date-picker>
    </v-menu>
  </section>
</template>

<script>
import moment from 'moment'
import {mapGetters} from 'vuex'

export default {
  props: ['labelName', 'inputType', 'inputValue', 'enums', 'code'],
  data() {
    return {
      selected: undefined,
      enumOptions: [],
      datePickerStatus: false,
      date: null,
      menu: false,
      errorMessage: 'Поле обязательно для заполнения'
    }
  },
  computed: {
    ...mapGetters(['userDob']),
    dateFormatted() {
      return this.date ? moment(this.date).locale('ru').format('DD.MM.YYYY') : ''
    }
  },
  methods: {
    getSelectOptionsArray() {
      let result = [];

      this.enums.forEach((row => {
        if (this.inputValue === row.Code)
          this.selected = {name: row.Name, value: row.Code}
        result.push({name: row.Name, value: row.Code})
      }))

      return result;
    },
    rules() {
      if(this.code === 'СНИЛС')
        return [v => v.length >= 11 || 'СНИЛС заполнен не полностью']

      else if (this.labelName !== 'Причина изменения ФИО'
        && this.labelName !== 'Иные доходы'
        && this.labelName !== 'Источник иных доходов'
      )
        return [v => !!v || this.errorMessage]
    },
    changeInput(value) {
      let valueCode

      if(this.inputValue === 'string' || this.inputValue === 'numeric' || this.inputType === 'date')
        valueCode = value
      else if(this.inputType === 'enum')
        valueCode = value.value

      this.$store.commit('updateProperty', {
        code: this.code,
        value: valueCode
      })
    }
  },
  watch: {
    menu(val) {
      val && setTimeout(() => (this.$refs.picker.activePicker = 'YEAR'))
    },
  },
  mounted() {
    if (this.enums)
      this.enumOptions = this.getSelectOptionsArray()
    if (!this.userDob)
      this.date = new Date().toISOString().substr(0, 10)
    else {
      const [day, month, year] = this.userDob.split('.')
      this.date = new Date(year, month, day).toISOString().substr(0, 10)
    }
  }
}
</script>
