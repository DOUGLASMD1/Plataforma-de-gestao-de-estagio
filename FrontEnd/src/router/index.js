import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/pages/home/Home'
import CoordenadorHome from '@/pages/home/CoordenadorHome'
import SupervisorHome from '@/pages/home/SupervisorHome'
import Login from '@/pages/login/Login'
import CadastrarVagas from '@/pages/Vagas/CadastrarVagas'
import EditarVagas from '@/pages/Vagas/EditarVagas'
import CadastrarAluno from '@/pages/CadastrarAluno/CadastrarAluno'
import CadastrarSupervisor from '@/pages/CadastrarSupervisor/CadastrarSupervisor'
import CadastrarRegulamento from '@/pages/CadastrarRegulamento/CadastrarRegulamento'
import EditarFrequencia from '@/pages/Empresas/EditarFrequencia'
import Frequencia from '@/pages/Empresas/Frequencia'
import AprovarVaga from '@/pages/VagasAluno/AprovarVaga'
import CandidatarVaga from '@/pages/VagasAluno/CandidatarVaga'

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
      path: '/supervisor',
      name: 'SupervisorHome',
      component: SupervisorHome
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
      path: '/coordenador/cadastrar_aluno',
      name: 'CadastrarAluno',
      component: CadastrarAluno
    },
    {
      path: '/coordenador/cadastrar_supervisor',
      name: 'CadastrarSupervisor',
      component: CadastrarSupervisor
    },
    {
      path: '/coordenador/cadastrar_regulamento',
      name: 'CadastrarRegulamento',
      component: CadastrarRegulamento
    },
    {
      path: '/supervisor/editar_vaga',
      name: 'EditarVagas',
      component: EditarVagas
    },
    {
      path: '/frequencia',
      name: 'Frequencia',
      component: Frequencia
    },
    {
      path: '/candidatar_vaga',
      name: 'CandidatarVaga',
      component: CandidatarVaga
    },
    {
      path: '/supervisor/Frequencia',
      name: 'EditarFrequencia',
      component: EditarFrequencia
    },
    {
      path: '/supervisor/aprovar_vaga',
      name: 'AprovarVaga',
      component: AprovarVaga
    }
  ]
})
