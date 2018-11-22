<template>

<site-template>

<div class="row">
  <h3>Frequência</h3>

  <form class="col s12">
      <div class="row">

        <div class="input-field col s2">
          <input required="required" placeholder="Data início" v-model="data_inicio" type="date" class="validate">
          <label for="data_inicio"></label>
        </div>

        <div class="input-field col s2">
          <input required="required" placeholder="Data fim" v-model="data_fim" type="date" class="validate">
          <label for="data_fim"></label>
        </div>

      </div>

      <div class="row">
        Descricão Aluno: <br>
        <div class="input-field col s7">
          <textarea required="required" v-model="textarea" class="materialize-textarea"></textarea>
          <label for="textarea"></label>
        </div>
      </div>

      <div class="row">

        Descrição Supervisor:<br>
        <div class="row">
        <div class="input-field col s7">
          <input disabled value="" id="disabled" type="text" class="validate">
          <label for="disabled"></label>
        </div>
      </div>

        <!--<div class="input-field col s2">
          <input required="required" placeholder="ID do estágio" v-model="id_estagio" type="text" class="validate">
          <label for="data_fim"></label>
        </div>
        

        <div class="input-field col s1">
          <input required="required" v-model="aprovado" type="checkbox" class="validate">
          <label for="area">Aprovado</label>
        </div>

        <div class="input-field col s1">
          <input required="required" v-model="pendente" type="checkbox" class="validate">
          <label for="area">Pendente</label>
        </div>
        -->
      </div>

      <a v-on:click="cadastrarFrequencia()" type="submit" class=" col s2 waves-effect waves-light btn">Enviar</a>
  </form>
</div>
  </site-template>
</template>

<script>
import SiteTemplate from '@/templates/SiteTemplate'

export default {
  name: 'Frequencia',
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
      SiteTemplate,
  }, 
  methods:{
    cadastrarVagas(){
      //console.log('Ok');
      this.$http.post(this.urlApi+`register-frequencia`,{
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