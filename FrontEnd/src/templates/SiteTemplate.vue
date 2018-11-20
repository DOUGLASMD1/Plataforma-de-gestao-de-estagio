<template>
  <span>

    <header>
      <nav-bar logo="Estágio" url="#/">
          <li><router-link to="#">Documentos Pendentes</router-link></li>
          <li><router-link to="#">Consultas</router-link></li>
          <li><router-link to="#">Status</router-link></li>
          <li><router-link to="#">Documentos</router-link></li>
          <li><router-link to="/login">sair</router-link></li>
      </nav-bar>
    </header>
    
    <main>
      <div class="row">

        <grid-vue tamanho="12">
          <slot/>
        </grid-vue>
        
      </div>
    </main>

    <footer-vue logo="Sigest" descricao="Informações sobre o estágio" ano="2018">

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
