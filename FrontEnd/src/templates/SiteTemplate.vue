<template>
  <span>

    <header>
      <nav-bar logo="Estágio" url="#/">
          <li><a href="#/login">Login</a></li>
          <li><a href="#/">Avisos</a></li>
          <li><a href="#/">Documentos Pendentes</a></li>
          <li><a href="#/">Documentos Analisados</a></li>
          <li><a href="#/">Consultas</a></li>
          <li><a href="#/">Supervisores</a></li>
      </nav-bar>
    </header>
    
    <main>
      <div class="row">

        <grid-vue tamanho="12">
          <slot/>
        </grid-vue>
        
      </div>
    </main>

    <footer-vue logo="Estágio" descricao="Informações sobre o estágio" ano="2018">
        <li><a class="grey-text text-lighten-3" href="#!">Home</a></li>
        <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
        <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
        <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
    </footer-vue>
    
  </span>
</template>

<script>

import NavBar from '@/components/layouts/NavBar'
import FooterVue from '@/components/layouts/FooterVue'
import GridVue from '@/components/layouts/GridVue'

export default {
  name: 'SiteTemplate',
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
