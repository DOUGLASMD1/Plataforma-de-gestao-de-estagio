<template>

<site-coordenador-template>

<div class="row">
  <h3> Cadastro de Supervisor </h3>

    <form class="col s12" action="" method="POST">
      <div class="row">

        <div class="input-field col s2">
          <input placeholder="Nome do Supervisor" id="supervisor" type="text" class="validate">
          <label for="supervisor"></label>
        </div>

        <div class="input-field col s2">
          <input placeholder="CPF" id="cpf" type="text" class="validate">
          <label for="cpf"></label>
        </div>

        <div class="input-field col s2">
          <input placeholder="RG" id="rg" type="text" class="validate">
          <label for="rg"></label>
        </div>

        <div class="input-field col s2">
          <input placeholder="Cargo" id="cargo" type="text" class="validate">
          <label for="cargo"></label>
        </div>

        <div class="input-field col s2">
          <input placeholder="Área de Atuação" id="areaAtuacao" type="text" class="validate">
          <label for="areaAtuacao"></label>
        </div>

        <div class="input-field col s2">
          <input placeholder="Email" id="email" type="text" class="validate">
          <label for="email"></label>
        </div>

      </div>

      <div class="row">

      	<div class="input-field col s2">
          <input placeholder="Senha" id="senha" type="text" class="validate">
          <label for="senha"></label>
        </div>

      </div>

Empresa: <br>
	<div class="row">

        <div class="input-field col s2">
          <input placeholder="Nome da empresa" id="nome_empresa" type="text" class="validate">
          <label for="nome_empresa"></label>
        </div>

        <div class="input-field col s2">
          <input placeholder="CNPJ" id="cnpj" type="text" class="validate">
          <label for="cnpj"></label>
        </div>

        <div class="input-field col s2">
          <input placeholder="Rua" id="rua" type="text" class="validate">
          <label for="rua"></label>
        </div>

        <div class="input-field col s2">
          <input placeholder="Bairro" id="bairro" type="text" class="validate">
          <label for="bairro"></label>
        </div>

        <div class="input-field col s2">
          <input placeholder="Cidade" id="cidade" type="text" class="validate">
          <label for="cidade"></label>
        </div>

        <div class="input-field col s2">
          <input placeholder="CEP" id="cep" type="text" class="validate">
          <label for="cep"></label>
        </div>

    </div>


    <div class="row">

    	<div class="input-field col s2">
          <input placeholder="Estado" id="estado" type="text" class="validate">
          <label for="estado"></label>
        </div>

        <div class="input-field col s2">
          <input placeholder="Complemento" id="complemento" type="text" class="validate">
          <label for="complemento"></label>
        </div>

        <div class="input-field col s2">
          <input placeholder="Número" id="numero" type="text" class="validate">
          <label for="numero"></label>
        </div>

        <div class="input-field col s2">
          <input placeholder="Telefone" id="telefone" type="text" class="validate">
          <label for="telefone"></label>
        </div>

        <div class="input-field col s2">
          <input placeholder="Representante" id="representante" type="text" class="validate">
          <label for="representante"></label>
        </div>

        <div class="input-field col s2">
          <input placeholder="Ramo" id="ramo" type="text" class="validate">
          <label for="ramo"></label>
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
  name: 'CadastrarSupervisor',
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