<template>
  <section>
    <app-order-form-min/>
    <app-headers h1="Оформить заявку онлайн" h2="Шаг 2: Проверка личных данных"/>
    <v-row>
      <v-col>
        <v-form ref="dataForm" v-model="valid">
          <v-data-table
            :headers="headers"
            :items="cols"
            :disable-filtering="true"
            :disable-pagination="true"
            :disable-sort="true"
            :hide-default-footer="true"
            no-data-text="Нет данных для изменения"
            class="elevation-1"
          >
            <template v-slot:item.value="{item}">
              <v-select v-if="item.type === 'enum'"
                        v-model="item.value"
                        :items="getInputOptions(item).items"
                        :item-value="item.name"
                        :value="item.code"
                        :hide-details="true"
                        required
                        :rules="notEmptyRule"
                        height="54"
                        @change="changeInput"
              />
              <v-checkbox v-if="item.type === 'bool'"
                          v-model="item.value"
                          @change="changeInput"
              />
              <v-text-field v-if="item.type ==='string'"
                            :value="item.value"
                            v-model="item.value"
                            :id="item.code"
                            @input="changeInput"
                            :rules="(item.description !== 'Причина изменения ФИО' && item.description !== 'Иные доходы') ? notEmptyRule : []"
                            required
              />
              <v-text-field v-if="item.type === 'numeric'"
                            :value="item.value"
                            v-model="item.value"
                            :id="item.code"
                            @input="changeInput"
                            type="number"
                            required
              />
              <v-text-field v-if="item.type ==='date'"
                            :value="item.value"
                            v-model="item.value"
                            :id="item.code"
                            @input="changeInput"
                            :rules="notEmptyRule"
                            required
              />
            </template>
          </v-data-table>
        </v-form>
      </v-col>
    </v-row>
    <v-alert v-if="!valid" elevation="2" color="red">Требуется заполнить обязательные поля</v-alert>
    <app-nav :disableNext="!valid" backPath="contact-data" toPath="personal-contacts"/>
  </section>
</template>

<script>
  import {mapGetters} from 'vuex'

  export default {
    data() {
      return {
        headers: [
          {text: 'Описание', value: 'description', width: '50%'},
          {text: 'Значение', value: 'value', width: '50%'},
        ],
        notEmptyRule: [
          v => !!v || 'Поле обязательно для заполнения',
        ],
        valid: false,
        disableNext: true
      }
    },
    computed: {
      ...mapGetters(['userData']),
      cols() {
        let cols = [];
        for (let item of this.userData) {
          if (!item.Name || item.Passport)
            continue;
          if (item.CurrentValue === null)
            item.CurrentValue = '';
          cols.push({
            description: item.Name,
            value: item.CurrentValue,
            enum: item.Enums,
            type: item.ValueType,
            code: item.Code
          })
        }

        return cols;
      },
    },
    methods: {
      validate() {
        this.$refs.dataForm.validate();
      },
      getInputOptions(item) {
        let options;

        if (item.enum) {
          let select = {};
          select.name = item.description;
          select.state = item.enum.find(val => {
            return val.Code === item.value
          });
          select.items = [];
          for (let enumItem of item.enum) {
            select.items.push({
              text: enumItem.Name,
              value: enumItem.Code
            })
          }
          options = select;
        }

        return options;
      },
      changeInput() {
        this.$store.dispatch('isChangedData', true);
      },
    },
    watch: {
      valid() {
        this.disableNext = !this.valid;
      },
    },
    beforeRouteEnter(to, from, next) {
      next(vm => {
        vm.$store.dispatch('requestUserData');
        vm.validate();
      });
    },
    beforeRouteLeave(to, from, next) {
      let resultData = [];
      for (let column of this.cols) {
        resultData.push({
          Code: column.code,
          Value: column.value
        });
      }
      this.$store.dispatch('setUserData', resultData);
      next();
    },
    mounted() {
      this.validate();
    }
  }
</script>

<style scoped>

</style>
