import Vue from 'vue';
import VueRouter from 'vue-router';
import Login from '../components/Login.vue';
//Chamados
import Cadastro from '../components/Admin/Cadastro.vue';
import Principal from '../components/Common/MainPanel.vue';
import UsersPanel from '../components/Admin/Users.vue';
import NotFound from '../components/Common/NotFound.vue';
import Chamado from '../components/Chamados/Chamado.vue';
import EditCall from '../components/Chamados/EditarChamado.vue';
import AdminPanel from '../components/Admin/Admin.vue';
import Technician from '../components/Technician/Technician.vue';

import AuthenticationMiddleware from './middleware/authentication';

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        redirect: '/login'
    },

    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            authenticated: false,
        }
    },

    {
        path: '*',
        component: NotFound,
        meta: {
            authenticated: false,
        }
    },

    {
        path: '/admin/users/cadastro',
        name: 'cadastro',
        component: Cadastro,
    },

    {
        path: '/cadastro',
        name: 'cadastro',
        component: Cadastro,
    },

    {
        path: '/home',
        name: 'principal',
        component: Principal,
        meta: {
            authenticated: true,
        }
    },

    {
        path: '/chamado',
        name: 'chamado',
        component: Chamado,
        meta: {
            authenticated: true,
        }
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
    routes
})

router.beforeEach(AuthenticationMiddleware);

export default router