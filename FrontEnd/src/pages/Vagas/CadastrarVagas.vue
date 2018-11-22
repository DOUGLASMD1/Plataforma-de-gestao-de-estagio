<template>

<site-coordenador-template>

<div class="row">
  <h3> Cadastro de Vagas </h3>

    <form class="col s12" action="" method="POST">
      <div class="row">

        <div class="input-field col s2">
          <input required="required" placeholder="Título" v-model="titulo" type="text" class="validate">
          <label for="titulo"></label>
        </div>

        <div class="input-field col s2">
          <input required="required" placeholder="Área" v-model="area" type="text" class="validate">
          <label for="area"></label>
        </div>

      </div>

      <div class="row">

        <div class="input-field col s7">
          <textarea required="required" placeholder="Requisitos" v-model="requisitos" class="materialize-textarea"></textarea>
          <label for="requisitos"></label>
        </div>

        <div class="input-field col s2">
          <input required="required" placeholder="Supervisor" v-model="supervisor" type="text" class="validate">
          <label for="area"></label>
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
  
        <a type="submit" class=" col s2 waves-effect waves-light btn">Cadastrar</a>
    </form>
</div>
  </site-coordenador-template>

</template>

<script>
import SiteCoordenadorTemplate from '@/templates/SiteCoordenadorTemplate'

export default {
  name: 'CadastrarVagas',
  data () {
    return {
      titulo:'',
      area:'',
      requisitos:'',
      supervisor:'',
      andamento:'A'
    }
  },
  components:{
      SiteCoordenadorTemplate
  }, 
  methods:{
    cadastrarVagas(){
      //console.log('Ok');
      this.$http.post(this.urlApi+`register-vaga`,{
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