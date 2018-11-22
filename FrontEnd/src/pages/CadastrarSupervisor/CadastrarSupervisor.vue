<template>

<site-coordenador-template>

<div class="row">
  <h3> Cadastro de Supervisor </h3>

    <form class="col s12" action="" method="POST">
      <div class="row">

        <div class="input-field col s2">
          <input placeholder="Nome do Supervisor" v-model="supervisor" type="text" class="validate">
          <label for="supervisor"></label>
        </div>

        <div class="input-field col s2">
          <input placeholder="CPF" v-model="cpf" type="text" class="validate">
          <label for="cpf"></label>
        </div>

        <div class="input-field col s2">
          <input placeholder="RG" v-model="rg" type="text" class="validate">
          <label for="rg"></label>
        </div>

        <div class="input-field col s2">
          <input placeholder="Cargo" v-model="cargo" type="text" class="validate">
          <label for="cargo"></label>
        </div>

        <div class="input-field col s2">
          <input placeholder="Área de Atuação" v-model="areaAtuacao" type="text" class="validate">
          <label for="areaAtuacao"></label>
        </div>

        <div class="input-field col s2">
          <input placeholder="Email" v-model="email" type="text" class="validate">
          <label for="email"></label>
        </div>

      </div>

      <div class="row">

      	<div class="input-field col s2">
          <input placeholder="Senha" v-model="senha" type="text" class="validate">
          <label for="senha"></label>
        </div>

      </div>

Empresa: <br>
	<div class="row">

        <div class="input-field col s2">
          <input placeholder="Nome da empresa" v-model="nome_empresa" type="text" class="validate">
          <label for="nome_empresa"></label>
        </div>

        <div class="input-field col s2">
          <input placeholder="CNPJ" v-model="cnpj" type="text" class="validate">
          <label for="cnpj"></label>
        </div>

        <div class="input-field col s2">
          <input placeholder="Rua" v-model="rua" type="text" class="validate">
          <label for="rua"></label>
        </div>

        <div class="input-field col s2">
          <input placeholder="Bairro" v-model="bairro" type="text" class="validate">
          <label for="bairro"></label>
        </div>

        <div class="input-field col s2">
          <input placeholder="Cidade" v-model="cidade" type="text" class="validate">
          <label for="cidade"></label>
        </div>

        <div class="input-field col s2">
          <input placeholder="CEP" v-model="cep" type="text" class="validate">
          <label for="cep"></label>
        </div>

    </div>


    <div class="row">

    	<div class="input-field col s2">
          <input placeholder="Estado" v-model="estado" type="text" class="validate">
          <label for="estado"></label>
        </div>

        <div class="input-field col s2">
          <input placeholder="Complemento" v-model="complemento" type="text" class="validate">
          <label for="complemento"></label>
        </div>

        <div class="input-field col s2">
          <input placeholder="Número" v-model="numero" type="text" class="validate">
          <label for="numero"></label>
        </div>

        <div class="input-field col s2">
          <input placeholder="Telefone" v-model="telefone" type="text" class="validate">
          <label for="telefone"></label>
        </div>

        <div class="input-field col s2">
          <input placeholder="Representante" v-model="representante" type="text" class="validate">
          <label for="representante"></label>
        </div>

        <div class="input-field col s2">
          <input placeholder="Ramo" v-model="ramo" type="text" class="validate">
          <label for="ramo"></label>
        </div>

      </div>
  
        <a v-on:click="cadastrarSupervisor()" type="submit" class=" col s2 waves-effect waves-light btn">Cadastrar</a>
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
        supervisor:'',
        cpf:'',
        rg:'',
        cargo:'',
        areaAtuacao:'',
        email:'',
        senha:'',
        nome_empresa:'',
        cnpj:'',
        rua:'',
        bairro:'',
        cidade:'',
        cep:'',
        estado:'',
        complemento:'',
        numero:'',
        telefone:'',
        representante:'',
        ramo:''
    }
  }, 
  components:{
      SiteCoordenadorTemplate
  }, 
  methods:{
    cadastrarSupervisor(){
      //console.log('Ok');
      this.$http.post(this.urlApi+`register-supervisor`,{
        cargo:this.cargo,
        areaAtuacao:this.areaAtuacao,
        cpf:this.cpf,
        rg:this.rg,
        nome:this.supervisor,
        email:this.email,
        password:this.senha,
        cnpj:this.cnpj,
        nomeEmpresa:this.nome_empresa,
        nomeRepre:this.representante,
        ramo:this.ramo,
        rua:this.rua,
        numero:this.numero,
        bairro:this.bairro,
        cidade:this.cidade,
        cep:this.cep,
        estado:this.estado,
        complemento:this.complemento,
        telefone:this.telefone,
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