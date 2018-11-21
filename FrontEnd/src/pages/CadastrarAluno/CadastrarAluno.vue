<template>

<site-coordenador-template>

<div class="row">
  <h3> Cadastro de Aluno </h3>

    <form class="col s12" action="" method="POST">
      <div class="row">

        <div class="input-field col s2">
          <input required="required" placeholder="RGA do aluno" id="rga" type="text" class="validate">
          <label for="rga"></label>
        </div>

        <div class="input-field col s2">
          <input required="required" placeholder="CPF do aluno" id="cpf" type="text" class="validate">
          <label for="cpf"></label>
        </div>

        <div class="input-field col s2">
          <input required="required" placeholder="RG do aluno" id="rg" type="text" class="validate">
          <label for="rg"></label>
        </div>

        <div class="input-field col s2">
          <input required="required" placeholder="Nome do aluno" id="nome" type="text" class="validate">
          <label for="nome"></label>
        </div>

        <div class="input-field col s2">
          <input required="required" placeholder="Email" id="email" type="text" class="validate">
          <label for="email"></label>
        </div>

        <div class="input-field col s2">
          <input required="required" placeholder="Senha do aluno" id="senha" type="text" class="validate">
          <label for="senha"></label>
        </div>

      </div>

    Endereço do aluno: <br>
    <div class="row">

        <div class="input-field col s2">
          <input required="required" placeholder="Rua" id="rua" type="text" class="validate">
          <label for="rua"></label>
        </div>

        <div class="input-field col s2">
          <input required="required" placeholder="numero" id="numero" type="text" class="validate">
          <label for="numero"></label>
        </div>

        <div class="input-field col s2">
          <input required="required" placeholder="Bairro" id="bairro" type="text" class="validate">
          <label for="bairro"></label>
        </div>

        <div class="input-field col s2">
          <input required="required" placeholder="Cidade" id="cidade" type="text" class="validate">
          <label for="cidade"></label>
        </div>

        <div class="input-field col s2">
          <input required="required" placeholder="CEP" id="cep" type="text" class="validate">
          <label for="cep"></label>
        </div>

        <div class="input-field col s2">
          <input required="required" placeholder="Estado" id="estado" type="text" class="validate">
          <label for="estado"></label>
        </div>
    </div>

      <div class="row">

        <div class="input-field col s5">
          <textarea required="required" placeholder="Complemento" id="complemento" class="materialize-textarea"></textarea>
          <label for="complemento"></label>
        </div>

        <div class="input-field col s2">
          <input required="required" placeholder="Telefone" id="telefone" type="text" class="validate">
          <label for="telefone"></label>
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
  name: 'CadastrarAluno',
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