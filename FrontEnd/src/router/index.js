import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/pages/home/Home'
import Login from '@/pages/login/Login'
import cadastro_Usuario from '@layouts/cadastro_usuario/cadastro_Usuario'
import cadastro_Esuario from '@layouts/cadastro_empresa/cadastro_Empresa'
import cadastro_Supervisor from '@layouts/cadastro_supervisor/cadastro_Supervisor'
import cadastro_Vagas from '@layouts/cadastro_vagas/cadastro_Vagas'

Vue.use(Router)

export default new Router({
  mode: 'history',  
  routes: [
    {
      path: '/',
      name: 'Home',
      component: Home
    },
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
    {
    	path:'/cadastro_usuario',
    	name: 'cadastro_Usuario',
    	component: cadastro_Usuario 
    },
    {
    	path:'/cadastro_empresa',
    	name:'cadastro_Empresa',
    	component: cadastro_Empresa
    },
    {
    	path:'/cadastro_supervisor',
    	name:'cadastro_Supervisor',
    	component: cadastro_Supervisor
    },

    {
    	path:'/cadastro_vagas',
    	name:'cadastro_Vagas',
    	component: cadastro_Vupervisor
    }
  ]
})
