<template>
  <section>
    <app-order-form-min/>
    <app-headers h1="Оформить заявку онлайн" h2="Шаг 2: Проверка личных данных"/>
    <v-form v-model="valid" ref="form" lazy-validation>
      <user-data-item
        :key="row.Code"
        v-for="row in userData"
        :input-type="row.ValueType"
        :code="row.Code"
        :label-name="row.Name"
        :input-value="row.CurrentValue"
        :enums="row.Enums"
      />
    </v-form>
    <app-nav :disableNext="!valid" backPath="contact-data" toPath="personal-contacts"/>
  </section>
</template>

<script>
import {mapGetters} from 'vuex'
import UserDataItem from "./UserDataItem";

export default {
  components: {UserDataItem},
  data() {
    return {
      valid: false
    }
  },
  computed: {
    ...mapGetters(['userData']),
  },
  beforeRouteEnter(to, from, next) {
    next(vm => {
      vm.$store.dispatch('requestUserData');
    })
  },
  async beforeRouteLeave(to, from, next) {
    if (to.name === 'personal-contacts') {
      try {
        await this.$store.dispatch('setUserData')
        next()
      } catch (e) {}
    } else next()
  },
  mounted() {
    this.$refs.form.validate()
  }
}
</script>
