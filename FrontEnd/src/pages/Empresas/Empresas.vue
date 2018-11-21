<template>

<site-supervisor-template>

<div class="row">
  <h3>Empresas</h3>

  <table>
      <tr>
          <td>Nome da Empresa</td>
          <td>Cargo</td>
          <td>Vagas</td>
          <td>Status</td>
      </tr>
      <tr>


      </tr>

  </table>


</div>
  </site-supervisor-template>

</template>

<script>
import SiteSupervisorTemplate from '@/templates/SiteSupervisorTemplate'

export default {
  name: 'Empresas',
  data () {
    return {
        conteudo:{nome:'',cargo:'',vagas:'',status:''}
    }
  }, components:{
      SiteCoordenadorTemplate
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>