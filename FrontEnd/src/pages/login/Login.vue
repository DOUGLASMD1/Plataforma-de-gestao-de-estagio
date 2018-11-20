<template>

<login-template>

<center>
        <h4>Bem vindo ao Sigest</h4>
</center>

    <div class="row">
    <form class="col s12" action="#" method="POST">
      <div class="row">
        <div class="input-field col s4 push-s4">
          <input required="required" placeholder="E-mail" v-model="email" type="text" class="validate">
          <label for="email"></label>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s4 push-s4">
          <input required="required" placeholder="Senha" v-model="password" type="password" class="validate">
          <label for="password"></label>
        </div>
      </div>
  
        <a v-on:click="login()" type="submit" class=" col s4 push-s4 waves-effect waves-light btn">Entrar</a><br>

        <br><a class=" col s3 push-s4" href="#">Esqueci minha senha</a>

    </form>
  </div>
  </login-template>

</template>

<script>
import LoginTemplate from '@/templates/LoginTemplate'
import axios from 'axios'

export default {
  name: 'Login',
  data () {
    return {
      email: '',
      password: ''
    }
  },
  components:{
      LoginTemplate
  }, 
  methods:{
    login(){
      console.log('Ok');
      axios.post(`http://127.0.0.1:8000/api/login`,{
        email: this.email,
        password: this.password
      })
    .then(response => {
      //console.log(response)
      if(response.data.token){
        console.log('login com sucesso')
        sessionStorage.setItem('usuario', JSON.stringify(response.data));
        this.$router.push('/');

      }else if(response.data.status == false){
        console.log('Login não existe')
        alert('Login invalido')
      }else{
        console.log('Erros de validação')
        let erros = ''
        for(let erro of Object.values(response.data)){
          erros += erro + "";
        }
        alert(erros)
      }
      

    })
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