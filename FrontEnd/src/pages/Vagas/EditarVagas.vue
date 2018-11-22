<template>

<site-supervisor-template>

<div class="row">
  <h3> Editar Vagas </h3>

    <form class="col s12" action="" method="POST">
      <div class="row">

        <div class="input-field col s2">
          <input required="required" placeholder="Título" v-model="titulo" type="text" class="validate">
          <label for="titulo">{{titulo}}</label>
        </div>

        <div class="input-field col s2">
          <input required="required" placeholder="Área" v-model="area" type="text" class="validate">
          <label for="area">{{area}}</label>
        </div>

      </div>

      <div class="row">

        <div class="input-field col s7">
          <textarea required="required" placeholder="Requisitos" v-model="requisitos" class="materialize-textarea"></textarea>
          <label for="requisitos">{{requisitos}}</label>
        </div>

        <div class="input-field col s2">
          <input required="required" placeholder="Supervisor" v-model="supervisor" type="text" class="validate">
          <label for="area">{{supervisor}}</label>
        </div>

        <div class="input-field col s2">
          <input required="required" v-model="andamento" type="checkbox" class="validate">
          <label for="area">Andamento</label>
        </div>

        <div class="input-field col s2">
          <input required="required" v-model="encerrado" type="checkbox" class="validate">
          <label for="area">Encerrado</label>
        </div>

      </div>
  
        <a v-on:click="alterarVagas()" type="submit" class=" col s2 waves-effect waves-light btn">Alterar</a>
    </form>
</div>
  </site-supervisor-template>

</template>

<script>
import SiteSupervisorTemplate from '@/templates/SiteSupervisorTemplate'

export default {
  name: 'EditarVagas',
  data () {
    return {
      titulo:'',
      area:'',
      requisitos:'',
      supervisor:'',
      andamento:'E'
    }
  },
  components:{
      SiteSupervisorTemplate
  }, 
  methods:{
    alterarVagas(){
      //console.log('Ok');
      this.$http.put(this.urlApi+`update-vaga/{idVagas}`,{
        Titulo:this.titulo,
        Area:this.titulo,
        Requisitos_para_Vaga:this.requisitos,
        supervisor:this.supervisor,
        status:this.andamento
      }, {"headers":{"authorization":"Bearer"+this.usuario.token}})
    .then(response => {})
    .catch(e => {
      this.errors.push(e)
      alert("Erro!!! Tente novamente mais tarde");
    })
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>