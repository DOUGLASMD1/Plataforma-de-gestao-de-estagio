<template>
  <grid-vue tamanho="12">
          <slot/>
    </grid-vue>
</template>

<script>

import NavBar from '@/components/layouts/NavBar'
import FooterVue from '@/components/layouts/FooterVue'
import GridVue from '@/components/layouts/GridVue'

export default {
  name: 'LoginTemplate',
  components: {
    NavBar,
    FooterVue,
    GridVue
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
