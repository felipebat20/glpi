import Vue from 'vue';
import VueRouter from 'vue-router';
import Login from '../components/Login.vue';
//Chamados
import Cadastro from '../components/Admin/Cadastro.vue';
import Principal from '../components/User/Principal.vue';
import UsersPanel from '../components/Admin/Users.vue';
import Chamado from '../components/Chamados/Chamado.vue';
import EditCall from '../components/Chamados/EditarChamado.vue';
import AdminPanel from '../components/Admin/Admin.vue';
import Technician from '../components/Technician/Technician.vue';

Vue.use(VueRouter)

const routes = [{
        path: '/',
        name: 'login',
        component: Login
    },
    {
        path: '/admin/users/cadastro',
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
        path: '/chamado/editar',
        name: 'EditarChamado',
        component: EditCall,
        props: true,
    },
    {
        path: '/admin',
        name: 'admin',
        component: AdminPanel,
        props: true,
    },
    {
        path: '/admin/users',
        name: 'users',
        component: UsersPanel,
        props: true,
    },
    {
        path: '/technician',
        name: 'technician',
        component: Technician,
        props: true,
    },
]

const router = new VueRouter({
    mode: 'history',
    // base: 'http://localhost:8080',
    routes
})

export default router