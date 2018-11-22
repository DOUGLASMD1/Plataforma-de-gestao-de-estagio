<template>

<site-template>

<div class="row">
  <h3> Aprovar Vaga </h3>

    <form class="col s12" action="" method="POST">
      <div class="row">

        <div class="input-field col s2">
          <input required="required" placeholder="RGA" v-model="rga" type="text" class="validate">
          <label for="titulo">{{rga}}</label>
        </div>

        <div class="input-field col s2">
          <input required="required" placeholder="Numero da vaga" v-model="vaga" type="text" class="validate">
          <label for="area">{{vaga}}</label>
        </div>

        <div class="input-field col s2">
          <input required="required" v-model="aprovado" type="checkbox" class="validate">
          <label for="area">Aprovado</label>
        </div>

        <div class="input-field col s2">
          <input required="required" v-model="reprovado" type="checkbox" class="validate">
          <label for="area">Reprovado</label>
        </div>

      </div>

        <a v-on:click="aprovarVagas()" type="submit" class=" col s2 waves-effect waves-light btn">Candidatar</a>
    </form>
</div>
  </site-template>

</template>

<script>
import SiteSupervisorTemplate from '@/templates/SiteSupervisorTemplate'

export default {
  name: 'AprovarVaga',
  data () {
    return {
      rga:'',
      vaga:'',
      aprovado:'A'
    }
  },
  components:{
      SiteSupervisorTemplate
  }, 
  methods:{
    aprovarVagas(){
      //console.log('Ok');
      this.$http.post(this.urlApi+`update-aluno-vaga`,{
        Rga:this.rga,
        idVaga:this.vaga,
        status:this.aprovado

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