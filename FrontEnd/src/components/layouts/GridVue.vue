<template>
      <div :class="'col s' + tamanho">
          <slot></slot>
      </div>
</template>

<script>

export default {
  name: 'GridVue',
  props:['tamanho'],
  data(){
    return{

    }
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