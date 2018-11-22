<template>

<site-template>

<div class="row">
  <h3> Se candidatar na Vaga </h3>

    <form class="col s12" action="" method="POST">
      <div class="row">

        <div class="input-field col s2">
          <input required="required" placeholder="RGA" v-model="rga" type="text" class="validate">
          <label for="titulo"></label>
        </div>

        <div class="input-field col s2">
          <input required="required" placeholder="Numero da vaga" v-model="vaga" type="text" class="validate">
          <label for="area"></label>
        </div>

      </div>


  
        <a v-on:click="candidatarVagas()" type="submit" class=" col s2 waves-effect waves-light btn">Candidatar</a>
    </form>
</div>
  </site-template>

</template>

<script>
import SiteTemplate from '@/templates/SiteTemplate'

export default {
  name: 'CandidatarVaga',
  data () {
    return {
      rga:'',
      vaga:''
    }
  },
  components:{
      SiteTemplate
  }, 
  methods:{
    candidatarVagas(){
      //console.log('Ok');
      this.$http.post(this.urlApi+`registe-aluno-vaga`,{
        Rga:this.rga,
        idVaga:this.vaga,
        status:'EA'

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