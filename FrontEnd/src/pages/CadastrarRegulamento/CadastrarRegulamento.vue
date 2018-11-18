<template>

<site-coordenador-template>

<div class="row">
  <h3>Regulamento do Estágio</h3>

    <form class="col s7">
      <div class="row">
        <div class="input-field col s7">
          <textarea required="required" id="textarea1" class="materialize-textarea"></textarea>
          <label for="textarea1"></label>
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
  name: 'CadastrarRegulamento',
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