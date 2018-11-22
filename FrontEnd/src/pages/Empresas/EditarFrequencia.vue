<template>

<site-supervisor-template>

<div class="row">
  <h3>Editar Frequência</h3>

  <form class="col s12">
      <div class="row">

        <div class="input-field col s2">
          <input required="required" placeholder="Data início" v-model="data_inicio" type="date" class="validate">
          <label for="data_inicio">{{data_inicio}}</label>
        </div>

        <div class="input-field col s2">
          <input required="required" placeholder="Data fim" v-model="data_fim" type="date" class="validate">
          <label for="data_fim">{{data_fim}}</label>
        </div>

      </div>

      <div class="row">
        Descricão Aluno: <br>
        <div class="input-field col s7">
          <textarea disabled value="" id="disabled" v-model="textarea" class="materialize-textarea"></textarea>
          <label for="textarea">{{textarea}}</label>
        </div>
      </div>

      <div class="row">

        Descrição Supervisor:<br>
        <div class="input-field col s7">
          <textarea required="required" v-model="textarea1" class="materialize-textarea"></textarea>
          <label for="textarea1">{{textarea1}}</label>
        </div>

      </div>

      <a v-on:click="cadastrarFrequencia()" class="waves-effect waves-light btn-large"><i class="material-icons left">check</i>Aprovar</a>
      <a v-on:click="cadastrarFrequencia()" class="waves-effect waves-light btn-large"><i class="material-icons left">error</i>Pendente</a>
    
  </form>


</div>
  </site-supervisor-template>

</template>

<script>
import SiteSupervisorTemplate from '@/templates/SiteSupervisorTemplate'


export default {
  name: 'EditarFrequencia',
  data () {
    return {
      data_inicio:'',
      data_fim:'',
      textarea:'',
      textarea1:'',
      pendente:'P',
      id_estagio:''
    }
  },
  components:{
      SiteSupervisorTemplate
  }, 
  methods:{
    cadastrarVagas(){
      //console.log('Ok');
      this.$http.put(this.urlApi+`update-frequencia/{idFrequencia}`,{
        Data_inicio: this.data_inicio,
        data_fim: this.data_fim,
        Descricao_aluno: this.textarea,
        Descricao_Supervisor: this.textarea1,
        status: this.pendente,
        estagio_idestagio: this.id_estagio
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