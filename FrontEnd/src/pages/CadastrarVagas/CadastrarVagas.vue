<template>

<site-coordenador-template>

<div class="row">
  <h3> Cadastro de Vagas </h3>

    <form class="col s12" action="" method="POST">
      <div class="row">

        <div class="input-field col s2">
          <input required="required" placeholder="Título" id="titulo" type="text" class="validate">
          <label for="titulo"></label>
        </div>

        <div class="input-field col s2">
          <input required="required" placeholder="E-mail" id="email" type="text" class="validate">
          <label for="email"></label>
        </div>

        <div class="input-field col s2">
          <input required="required" placeholder="Telefone" id="telefone" type="date" class="validate">
          <label for="telefone"></label>
        </div>

        <div class="input-field col s2">
          <input required="required" placeholder="Área" id="area" type="text" class="validate">
          <label for="area"></label>
        </div>

        <div class="input-field col s2">
          <input required="required" placeholder="Empresa" id="empresa" type="text" class="validate">
          <label for="empresa"></label>
        </div>

      </div>

      <div class="row">
        <div class="input-field col s7">
          <textarea required="required" placeholder="Requisitos" id="requisitos" class="materialize-textarea"></textarea>
          <label for="requisitos"></label>
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
    }
  }, components:{
      SiteCoordenadorTemplate
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>