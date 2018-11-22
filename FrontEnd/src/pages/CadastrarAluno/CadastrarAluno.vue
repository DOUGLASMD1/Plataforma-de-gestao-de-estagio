<template>

<site-coordenador-template>

<div class="row">
  <h3> Cadastro de Aluno </h3>

    <form class="col s12" action="" method="POST">
      <div class="row">

        <div class="input-field col s2">
          <input required="required" placeholder="RGA do aluno" v-model="rga" type="text" class="validate">
          <label for="rga"></label>
        </div>

        <div class="input-field col s2">
          <input required="required" placeholder="CPF do aluno" v-model="cpf" type="text" class="validate">
          <label for="cpf"></label>
        </div>

        <div class="input-field col s2">
          <input required="required" placeholder="RG do aluno" v-model="rg" type="text" class="validate">
          <label for="rg"></label>
        </div>

        <div class="input-field col s2">
          <input required="required" placeholder="Nome do aluno" v-model="nome" type="text" class="validate">
          <label for="nome"></label>
        </div>

        <div class="input-field col s2">
          <input required="required" placeholder="Email" v-model="email" type="text" class="validate">
          <label for="email"></label>
        </div>

        <div class="input-field col s2">
          <input required="required" placeholder="Senha do aluno" v-model="senha" type="text" class="validate">
          <label for="senha"></label>
        </div>

      </div>

    Endereço do aluno: <br>
    <div class="row">

        <div class="input-field col s2">
          <input required="required" placeholder="Rua" v-model="rua" type="text" class="validate">
          <label for="rua"></label>
        </div>

        <div class="input-field col s2">
          <input required="required" placeholder="numero" v-model="numero" type="text" class="validate">
          <label for="numero"></label>
        </div>

        <div class="input-field col s2">
          <input required="required" placeholder="Bairro" v-model="bairro" type="text" class="validate">
          <label for="bairro"></label>
        </div>

        <div class="input-field col s2">
          <input required="required" placeholder="Cidade" v-model="cidade" type="text" class="validate">
          <label for="cidade"></label>
        </div>

        <div class="input-field col s2">
          <input required="required" placeholder="CEP" v-model="cep" type="text" class="validate">
          <label for="cep"></label>
        </div>

        <div class="input-field col s2">
          <input required="required" placeholder="Estado" v-model="estado" type="text" class="validate">
          <label for="estado"></label>
        </div>
    </div>

      <div class="row">

        <div class="input-field col s5">
          <textarea required="required" placeholder="Complemento" v-model="complemento" class="materialize-textarea"></textarea>
          <label for="complemento"></label>
        </div>

        <div class="input-field col s2">
          <input required="required" placeholder="Telefone" v-model="telefone" type="text" class="validate">
          <label for="telefone"></label>
        </div>

      </div>
  
        <a v-on:click="cadastrarAluno()" type="submit" class=" col s2 waves-effect waves-light btn">Cadastrar</a>
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
      rga:'',
      semestre:'',
      curso:'',
      cpf:'',
      rg:'',
      nome:'',
      email:'',
      password:'',
      rua:'',
      numero:'',
      bairro:'',
      cidade:'',
      cep:'',
      estado:'',
      complemento:'',
      telefone:''
    }
  },
  components:{
      SiteCoordenadorTemplate
  }, 
  methods:{
    cadastrarAluno(){
      //console.log('Ok');
      this.$http.post(this.urlApi+`register-aluno`,{
        Rga: this.rga,
        SemestreAtual: this.semestre,
        Curso: this.curso,
        cpf: this.cpf,
        rg: this.rg,
        nome: this.nome,
        email: this.email,
        password: this.password,
        rua: this.rua,
        numero: this.numero,
        bairro: this.bairro,
        cidade: this.cidade,
        cep: this.cep,
        estado: this.estado,
        complemento: this.complemento,
        telefone: this.telefone
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