import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/pages/home/Home'
import CoordenadorHome from '@/pages/home/CoordenadorHome'
import Login from '@/pages/login/Login'
import CadastrarVagas from '@/pages/CadastrarVagas/CadastrarVagas'
import CadastrarRegulamento from '@/pages/CadastrarRegulamento/CadastrarRegulamento'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/coordenador',
      name: 'coordenador',
      component: CoordenadorHome
    },
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
    {
      path: '/coordenador/cadastrar_vagas',
      name: 'CadastrarVagas',
      component: CadastrarVagas
    },
    {
      path: '/coordenador/cadastrar_regulamento',
      name: 'CadastrarRegulamento',
      component: CadastrarRegulamento
    }
  ]
})
