<template>
    <div class="row bg-light px-2" id="nav">
        <div class="nav">
            <div class="d-flex align-content-center">
                <router-link class="nav-link" to="/">
                    <img src="@/assets/glpiprincipal.png" class="img-fluid" alt="">
                </router-link>
            </div>

            <div class="row align-content-center">
                <router-link class="nav-link" to="/">
                    Principal
                </router-link>
            </div>

            <div class="row align-content-center">
                <router-link class="nav-link" to="/Chamado">
                    Chamados
                </router-link>
            </div>

            <div class="row align-content-center">
                <router-link class="nav-link" to="/dashboard">
                    Dashboard
                </router-link>
            </div>

            <div class="row align-content-center">
                <router-link class="nav-link " to="/notifications">
                    Notificações
                </router-link>
            </div>

            <div class="row align-content-center">
                <router-link class="nav-link" to="/settings">
                    Configuração
                </router-link>
            </div>

            <div v-if="getUser.name" class="row align-content-center">
                <div  class="dropdown text-end">
                    <span class="dropdown-toggle" type="button" @click="is_selecting = true">
                         <img
                            :src="avatar_url"
                            class="avatar d-inline-block"
                            alt=""
                        >
                    </span>

                    <div class="dropdown-menu" :class="getCurrentDropdown" @click="is_selecting = false">
                        <button class="dropdown-item" type="button">Editar perfil</button>
                        <button class="dropdown-item" type="button" @click="logout()">
                            Sair
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
    name: 'NavigationBar',
    data() {
        return {
            avatar_url: '',
            is_selecting: false,
        };
    },

    computed: {
        ...mapGetters(['getUser']),
        getCurrentDropdown() {
            if (this.is_selecting) {
                return 'd-block';
            }

            return '';
        }
    },

    mounted() {
        if (this.getUser.name) {
            this.getAvatar();
        }
    },

    watch: {
        getUser() {
            if (this.getUser.name) {
                this.getAvatar();
            }
        },
    },

    methods: {
        ...mapActions(['resetUserState']),
        async getAvatar() {
            await this.$http.get(`https://api.github.com/users/${this.getUser.username}`)
            .then( response => {
                if (response.status == 200 ){
                    this.avatar_url = response.data.avatar_url;
                }
            })
            .catch( error => {
                console.log(error);
            });
        },

        logout() {
            this.resetUserState();
            this.$router.push('/', {name: 'login'})
        }
    }
}
</script>

<style scoped>
    .nav {
        display: grid;
        grid-template-columns: 150px 100px 100px 100px 100px 100px 200px;
        column-gap: 10px;
        justify-content: space-between;
        align-content: center;
        max-width: 1200px;
        margin: auto;
        /* background-color: #037682; */
    }

    .nav div a {
        font-weight: bold;
        color: #2c3e50;
    }

    .nav div a.router-link-exact-active {
        color: #42b983;
    }

    .avatar {
      width: 20%;
      border-radius: 50%;
      margin-right: 0 ;
  }
</style>