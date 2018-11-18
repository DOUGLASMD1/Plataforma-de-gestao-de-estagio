<template>

<login-template>

<center>
        <h4>Bem vindo ao Sigest</h4>
</center>

    <div class="row">
    <form class="col s12" action="#" method="POST">
      <div class="row">
        <div class="input-field col s4 push-s4">
          <input required="required" placeholder="E-mail" id="first_name" type="text" class="validate">
          <label for="first_name"></label>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s4 push-s4">
          <input required="required" placeholder="Senha" id="password" type="password" class="validate">
          <label for="password"></label>
        </div>
      </div>
  
        <a type="submit" class=" col s4 push-s4 waves-effect waves-light btn">Entrar</a><br>

        <br><a class=" col s3 push-s4" href="#">Esqueci minha senha</a>

    </form>
  </div>
  </login-template>

</template>

<script>
import LoginTemplate from '@/templates/LoginTemplate'

export default {
  name: 'Login',
  data () {
    return {
    }
  }, components:{
      LoginTemplate
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>