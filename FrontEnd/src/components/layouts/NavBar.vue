<template>
<nav class="blue">
    <div class="nav-wrapper">
        <a :href = "url || '#'" class="brand-logo">{{ logo || 'UFMS' }}</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <li><a href="#">Avisos</a></li>
          <li><a href="#">Documentos Pendentes</a></li>
          <li><a href="#">Documentos Analisados</a></li>
          <li><a href="#">Consultas</a></li>
          <li><a href="#">Supervisores</a></li>
        </ul>
    </div>
  </nav>
</template>

<script>
export default {
  name: 'NavBar',
  props:['logo','url'],
  data () {
    return {

    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
