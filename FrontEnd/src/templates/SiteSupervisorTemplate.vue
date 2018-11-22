<template>
  <span>

    <header>
      <nav-bar logo="Estágio" url="#/">
          <li><router-link to="#">Documentos Pendentes</router-link></li>
          <li><router-link to="#">Consultas</router-link></li>
          <li><router-link to="#">Status</router-link></li>
          <li><router-link to="#">Empresa</router-link></li>
          <li v-if="usuario">{{usuario.name}}</li>
          <li><a v-on:click="sair()">sair</a></li>
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
  name: 'SiteSupervisorTemplate',
  data(){
    return {
      usuario: false
    }
  },
  components: {
    NavBar,
    FooterVue,
    GridVue
  },
  created(){
    let usuarioAux = sessionStorage.getItem('usuario');

    if(usuarioAux){
      this.usuario = JSON.parse(usuarioAux);
    }else{
      this.$router.push('/login');
    }
  },
  methods:{
    sair(){
      sessionStorage.clear();
      this.usuario = false;
      this.$router.push('/login');
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
