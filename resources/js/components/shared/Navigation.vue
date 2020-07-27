<template>
  <div class="row">
    <div>
      <router-link
        to="order-form"
        v-if="$route.name !== 'order-form'"
        class="btn btn-nav"
        tag="button">Отказаться
      </router-link>
    </div>
    <div class="xs12 ml-auto">
      <router-link class=" btn btn-nav m-4 ml-0"
                   tag="button"
                   v-if="backPath"
                   :to="backPath"
      >{{customTextBack || 'Назад'}}
      </router-link>
      <router-link class="btn btn-nav m-4 ml-0"
                   tag="button"
                   v-if="toPath"
                   @click.native="$emit('clickNext')"
                   :to="toPath"
                   :disabled="disableNext"
      >{{customTextNext || 'Далее'}}
      </router-link>
    </div>
  </div>
</template>

<script>
  export default {
    props: ['backPath', 'toPath', 'disableNext', 'customTextNext', 'customTextBack'],
  }
</script>

<style>
  .btn-nav {
    background: #00a0e3;
    color: #fff;
  }

  .btn-nav:hover {
    background: #fc0101;
    color: #fff;
  }
</style>
