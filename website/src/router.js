import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from './components/Login.vue'
import Cadastro from './components/Cadastro.vue'
import Principal from './components/Principal.vue'
import Chamado from './components/Chamado.vue'
import AdminPanel from './components/Admin/Admin.vue'

Vue.use(VueRouter)

const routes = [{
        path: '/',
        name: 'login',
        component: Login
    },
    {
        path: '/cadastro',
        name: 'cadastro',
        component: Cadastro
    },
    {
        path: '/principal',
        name: 'principal',
        component: Principal,
        props: true,
    },
    {
        path: '/chamado',
        name: 'chamado',
        component: Chamado,
        props: true,
    },
    {
        path: '/admin',
        name: 'admin',
        component: AdminPanel,
        props: true,
    },
]

const router = new VueRouter({
    mode: 'history',
    // base: 'http://localhost:8080',
    routes
})

export default router